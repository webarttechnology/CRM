<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(Request $request, $taskid = '')
    {
        if ($request->ajax()) {
            $comment = new \App\Models\Comment([
                'sale_id' => $request->get('task_id'),
                'comment_by' => Auth::user()->id,
                'message' => $request->get('message'),
                'date' => date('Y-m-d h:i:s', time())
            ]);

            $comment->save();
            
            $task = \App\Models\Developertask::where('id', $request->get('task_id'))->first();

            $sales = \App\Models\Sale::where('id', $task->sale_id)->first();

            $remark = 'New Comment has been posted '.$request->get('message');
                
            LogHistoryAdd($sales->client_id, $task->sale_id, Auth::id(), $remark);

            echo 1;

        } else {
            $sales = \App\Models\Sale::where('id', $taskid)->first();
            $comment = \App\Models\Comment::where('sale_id', $taskid)->get();
            $taskid = $taskid;
            return view('admin.message.message', compact('comment', 'taskid', 'sales'));
        }
    }

    public function getMessage(Request $request)
    {
        if ($request->ajax()) {


                $comment = Comment::where('sale_id', $request->task_id)
                ->orderBy('id')
                ->get();

            $html = '';
            foreach ($comment as $val) {

                $file_url = $val->file;

                // Define the pattern to match the dynamic number
                $pattern = '/\/\d+_/';
                $replacement = '/'; // Replace the dynamic number with a forward slash

                $remove_number_result = preg_replace($pattern, $replacement, $file_url);

                $fil_path = url('/admin/comment/').'/';

                $file_name = str_replace($fil_path, '', $remove_number_result);

                $extension = pathinfo($file_name, PATHINFO_EXTENSION);

        
                $filenameWithoutExtension = pathinfo($file_name, PATHINFO_FILENAME);

                $trancate_extra_word = Str::limit($filenameWithoutExtension, 10, '...').'.'.$extension;

                $html = $html . '<ul class="m-b-0" id="message">';
                if ($val->id == Auth::user()->id) {
                      if($val->message){
                        $html = $html . '<li class="clearfix">
                        <div class="message-data">
                            <span class="message-data-time">' . date('d-m-Y h:i:s', strtotime($val->date)) . '</span>
                        </div>
                        <div class="message other-message ">' . $val->message . '</div>
                        <div class="">' . '(' . $val->user->name . ')' . '</div>
                       </li>';
                      }else{

                        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'webp'){
                            
                            $html = $html .'<li class="clearfix">
                            <span class="d-block">'.date('d-m-Y h:i:s', strtotime($val->date)).'</span>
                            <div class="upload-img" data-id="'.$val->id.'">
                             <a href="'.$val->file.'" target="_blank"> 
                               <img src="'.$val->file.'" alt="File Preview" style="max-width: 100%;">
                            </a>
                            </div>
                            <div class="d-flex">
                            <span>'.$val->user->name.'</span>
                            <span style="margin-left: 20px"><i class="fas fa-download file-download" data-id="'.$val->id.'"></i></span>
                            </div>
                            </li>';

                        }elseif($extension == 'pdf'){
                            $html = $html . '<li class="clearfix">
                            <span class="d-block">'.date('d-m-Y h:i:s', strtotime($val->date)).'</span>
                            <div class="zip-pdf-file d-table">
                            <div class="d-flex bg-white p-3 border rounded">
                            <a href="'.$val->file.'" class="d-flex text-black" target="_blank"> 
                            <div><i class="fas fa-file-pdf"></i></div>
                            <div class="px-3">'.$trancate_extra_word.'</div>
                            </a>
                            <div><i class="fas fa-download file-download" data-id="'.$val->id.'"></i></div>
                            </div>
                            </div>
                            <div>
                            <span>'.$val->user->name.'</span>
                            </div>
                            </li>';
                        }elseif($extension == 'zip'){
                            $html = $html . '<li class="clearfix">
                            <span class="d-block">'.date('d-m-Y h:i:s', strtotime($val->date)).'</span>
                            <div class="zip-pdf-file d-table file-download" data-id="'.$val->id.'">
                            <div class="d-flex bg-white p-3 border rounded">
                            <div><i class="fas fa-file-archive"></i></div>
                            <div class="px-3">'.$trancate_extra_word.'</div>
                            <div><i class="fas fa-download"></i></div>
                            </div>
                            </div>
                            <div>
                            <span>'.$val->user->name.'</span>
                            </div>
                            </li>';
                        }
                      }
                    
                } else {
                    if($val->message){
                        $html = $html . '<li class="clearfix">
                        <div class="message-data ">
                            <span class="message-data-time">' . date('d-m-Y h:i:s', strtotime($val->date)) . '</span>
                        </div>
                        <div class="message my-message ">' . $val->message . '</div>  
                        <div class="">' . '(' . $val->user->name . ')' . '</div>
                    </li>';
                    }else{

                        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'webp'){

                            $html = $html . '<li class="clearfix">
                            <span class="d-block">'.date('d-m-Y h:i:s', strtotime($val->date)).'</span>
                            <div class="upload-img">
                            <a href="'.$val->file.'" target="_blank"> 
                               <img src="'.$val->file.'" alt="File Preview" style="max-width: 100%;">
                            </a>
                            </div>
                            <div class="d-flex">
                            <span>'.$val->user->name.'</span>
                            <span style="margin-left: 20px"><i class="fas fa-download file-download" data-id="'.$val->id.'"></i></span>
                            </div>
                            </li>';

                        }elseif($extension == 'pdf'){
                            $html = $html . '<li class="clearfix">
                            <span class="d-block">'.date('d-m-Y h:i:s', strtotime($val->date)).'</span>
                            <div class="zip-pdf-file d-table">
                            <div class="d-flex bg-white p-3 border rounded">
                            <a href="'.$val->file.'" class="d-flex text-black" target="_blank"> 
                            <div><i class="fas fa-file-pdf"></i></div>
                            <div class="px-3">'.$trancate_extra_word.'</div>
                            </a>
                            <div><i class="fas fa-download file-download" data-id="'.$val->id.'"></i></div>
                            </div>
                            </div>
                            <div>
                            <span>'.$val->user->name.'</span>
                            </div>
                            </li>';
                        }elseif($extension == 'zip'){
                            $html = $html . '<li class="clearfix">
                            <span class="d-block">'.date('d-m-Y h:i:s', strtotime($val->date)).'</span>
                            <div class="zip-pdf-file d-table file-download" data-id="'.$val->id.'">
                            <div class="d-flex bg-white p-3 border rounded">
                            <div><i class="fas fa-file-archive"></i></div>
                            <div class="px-3">'.$trancate_extra_word.'</div>
                            <div><i class="fas fa-download"></i></div>
                            </div>
                            </div>
                            <div>
                            <span>'.$val->user->name.'</span>
                            </div>
                            </li>';
                        }

                    }
                   
                }
                $html = $html .'</ul>';
                
            }

            echo $html;
        }
    }


    public function upload_file_comment(Request $request)
    {

        // dd($request->all());

        $validator   =  Validator::make($request->all(), [
            'file'             => 'required|file|mimes:jpeg,png,jpg,webp,pdf,zip|max:2048',
            'task_id'          => 'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
        }

        if(isset($request->file)){
            $file = $request->file('file');
            $new_file = rand().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('admin/comment');
            $file->move($destinationPath, $new_file);
            $image = url('/').'/admin/comment/'.$new_file;
        }else{
            $image = null;
        }

        $data  = [
            'sale_id'       => $request->task_id,
            'comment_by'    => Auth::user()->id,
            'file'          => $image,
            'date'          => date('Y-m-d h:i:s', time())
        ];

        Comment::create($data);

        return response()->json(['status' => 'success', 'message'=> 'File upload successfully!']);

    }

    public function download_file(Request $request)
    {
        
        $comment = Comment::find($request->id);

        $file_url = $comment->file;

        $fil_path = url('/admin/comment/').'/';

        $pattern = '/\/\d+_/';
        $replacement = '/'; // Replace the dynamic number with a forward slash

        $remove_number_result = preg_replace($pattern, $replacement, $file_url);

        $fil_path = url('/admin/comment/').'/';

        $file_name = str_replace($fil_path, '', $remove_number_result);

        $data = [
            'url'   => $file_url,
            'name'  => $file_name,
        ];

        return response()->json(['status' => 'success', 'data'=> $data ]);

    }

}
