<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                if ($val->id == Auth::user()->id) {
                    $html = $html . '<li class="clearfix">
                    
                        <div class="message-data ">
                            <span class="message-data-time">' . date('d-m-Y h:i:s', strtotime($val->date)) . '</span>
                        </div>
                        <div class="message other-message ">' . $val->message . '</div>
                        <div class="">' . '(' . $val->user->name . ')' . '</div>
                    </li>';
                } else {
                    $html = $html . '<li class="clearfix">
                        <div class="message-data ">
                            <span class="message-data-time">' . date('d-m-Y h:i:s', strtotime($val->date)) . '</span>
                        </div>
                        <div class="message my-message ">' . $val->message . '</div>  
                        <div class="">' . '(' . $val->user->name . ')' . '</div>
                    </li>';
                }
            }

            // dd($html);

            echo $html;
        }
    }
}
