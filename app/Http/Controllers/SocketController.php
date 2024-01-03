<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketController extends Controller implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }


    protected function formatDateForDisplay($date)
    {
        $carbonDate = Carbon::parse($date);

        if ($carbonDate->isToday()) {
            return 'Today';
        } elseif ($carbonDate->isYesterday()) {
            return 'Yesterday';
        } else {
            return $carbonDate->format('M d Y');
        }
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {

            User::where('token', $queryarray['token'])->update(['connection_id' => $conn->resourceId]);
        }
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {

        $data = json_decode($msg);

        if (isset($data->type)) {

            if ($data->type == 'request_load_list_user') {

                $user_data = User::where('id', '!=', $data->from_user_id)
                    ->orderBy('name', 'ASC')
                    ->get();

                // $sub_data =  getRecentMessages($user_data, $data->from_user_id);
                // dd($sub_data);

                $sub_data = array();

                foreach (getRecentMessages($user_data, $data->from_user_id) as $row) {
                    if($row['last_message']){
                            $hrefValue = null;
                        if (preg_match('/href=[\'"]?([^\'" >]+)/', $row['last_message'], $matches)) {
                            $hrefValue = isset($matches[1]) ? $matches[1] : null;
                            $last_message = Str::limit(strip_tags($hrefValue), 15, '...');
                        }else{
                            $last_message = Str::limit(strip_tags($row['last_message']), 15, '...');
                        }
                    }else{
                            $last_message = '';
                    }

                    $sub_data[] = array(
                        'name'          =>  $row['name'],
                        'id'            =>  $row['id'],
                        'status'        =>  $row['status'],
                        'user_image'    =>  $row['user_image'],
                        'unread_chat'   =>  $row['unread_chat'],
                        'last_message'  =>  $last_message,
                        'last_time'     =>  Carbon::parse($row['timestamp'])->diffForHumans(),
                        'type'          => $row['type'],
                        'message_status'=> $row['message_status'],
                        'from_user_id'  => $row['from_user_id'],
                    );
                }

                

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                $send_data['data'] = $sub_data;

                $send_data['response_load_list_user'] = true;

                // dd($send_data);

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_search_user') {
                
                $user_data = User::where('id', '!=', $data->from_user_id)
                ->orderBy('name', 'ASC')
                ->get();

                $sub_data = array();

                foreach (getRecentMessages($user_data, $data->from_user_id, $data->search_query) as $row) {
                    if($row['last_message']){
                            $hrefValue = null;
                        if (preg_match('/href=[\'"]?([^\'" >]+)/', $row['last_message'], $matches)) {
                            $hrefValue = isset($matches[1]) ? $matches[1] : null;
                            $last_message = Str::limit(strip_tags($hrefValue), 15, '...');
                        }else{
                            $last_message = Str::limit(strip_tags($row['last_message']), 15, '...');
                        }
                    }else{
                            $last_message = '';
                    }

                    $sub_data[] = array(
                        'name'          =>  $row['name'],
                        'id'            =>  $row['id'],
                        'status'        =>  $row['status'],
                        'user_image'    =>  $row['user_image'],
                        'unread_chat'   =>  $row['unread_chat'],
                        'last_message'  =>  $last_message,
                        'last_time'     =>  Carbon::parse($row['timestamp'])->diffForHumans(),
                        'type'          => $row['type'],
                        'message_status'=> $row['message_status'],
                        'from_user_id'  => $row['from_user_id'],
                    );
                }

                

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                $send_data['data'] = $sub_data;

                $send_data['response_search_user'] = true;

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_send_message') {
                //save chat message in mysql

                // dd($data);

                if($data->to_type == 'user'){
                    $to_user_id = $data->to_user_id; 
                    $to_group_id = null; 
                }

                if($data->to_type == 'group'){
                    $to_user_id = null; 
                    $to_group_id = $data->to_group_id; 
                }

            
                $data_message = [
                    'from_user_id'  => $data->from_user_id,
                    'to_user_id'    => $to_user_id,
                    'group_id'      => $to_group_id, 
                    'chat_message'  => $data->message,
                    'message_status'=> 'Not Send'
                ];

                // dd($data_message);

                $chat =  Chat::create($data_message);


                $chat_message_id = $chat->id;

                if($to_user_id){
                    $receiver_connection = User::select('connection_id')->where('id', $to_user_id)->get();
                }else{
                    $receiver_connection = [];
                }

                $sender_connection = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {

                        if(count($receiver_connection) > 0){
                            $receiver_connection_id = $receiver_connection[0]->connection_id;
                        }else{
                            $receiver_connection_id = null; 
                        }

                        if(count($sender_connection) > 0){
                            $sender_connection_id = $sender_connection[0]->connection_id;
                        }else{
                            $sender_connection_id = null; 
                        }


                    if ($client->resourceId == $receiver_connection_id || $client->resourceId == $sender_connection_id) {
                        $send_data['chat_message_id'] = $chat_message_id;

                        $send_data['message'] = convertUrlsToLinks($data->message);
                        $send_data['time']    = $chat->created_at->format('h:i A');

                        $send_data['from_user_id'] = $data->from_user_id;

                        $send_data['to_user_id']  = $to_user_id;
                        $send_data['to_group_id'] = $to_group_id;

                        if ($client->resourceId == $receiver_connection_id) {
                            Chat::where('id', $chat_message_id)->update(['message_status' => 'Send']);
                            $send_data['message_status'] = 'Send';
                        } else {
                            $send_data['message_status'] = $chat->message_status;
                        }

                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_chat_history') {

                // dd($data);

                if($data->to_type == 'user'){

                    $chat_data = Chat::select('id', 'from_user_id', 'to_user_id', 'group_id', 'chat_message', 'message_status', 'created_at')
                    ->where(function ($query) use ($data) {
                        $query->where('from_user_id', $data->from_user_id)->where('to_user_id', $data->to_user_id);
                    })
                    ->orWhere(function ($query) use ($data) {
                        $query->where('from_user_id', $data->to_user_id)->where('to_user_id', $data->from_user_id);
                    })
                    ->orderBy('id', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->created_at)->format('Y-m-d');
                    });

                }
                
                if($data->to_type == 'group'){

                    //// Group ///

                    $chat_data = Chat::select('id', 'from_user_id', 'to_user_id', 'group_id', 'chat_message', 'message_status', 'created_at')
                    ->where(function ($query) use ($data) {
                        $query->where('group_id', $data->to_user_id);
                    })
                    ->orderBy('id', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->created_at)->format('Y-m-d');
                    });


                }


                $send_data['chat_history'] = [];

                $jsonData = $chat_data->map(function ($groupedMessages, $date) {
                    return [
                        'date' => $this->formatDateForDisplay($date),
                        'messages' => $groupedMessages->map(function ($message) {
                            return [
                                'id'                => $message->id,
                                'from_user_id'      => $message->from_user_id,
                                'to_user_id'        => $message->to_user_id ?? null,
                                'to_group_id'       => $message->group_id ?? null,
                                'user_name'         => $message->user->name,
                                'chat_message'      => $message->chat_message,
                                'message_status'    => $message->message_status,
                                'time'              => $message->created_at->format('h:i A'),
                            ];
                        }),
                    ];
                })->values();


                $send_data['chat_history'] = $jsonData;

                $receiver_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $receiver_connection_id[0]->connection_id) {
                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'update_chat_status') {
                //update chat status


                Chat::where('id', $data->chat_message_id)->update(['message_status' => $data->chat_message_status]);

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['update_message_status'] = $data->chat_message_status;

                        $send_data['chat_message_id'] = $data->chat_message_id;

                        $client->send(json_encode($send_data));
                    }
                }
            }
            
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            User::where('token', $queryarray['token'])->update(['connection_id' => 0]);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()} \n";

        $conn->close();
    }
}
