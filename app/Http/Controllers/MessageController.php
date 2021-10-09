<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\Message;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function inbox()
    {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = ' Inbox';
        $title = 'Inbox';

        $inbox = Inbox::where('inboxes.created_by', $user->user_id)->orWhere('inboxes.to_id', $user->user_id)
                        ->leftJoin('users as sender', 'inboxes.created_by','=','sender.user_id')
                        ->leftJoin('users as receiver', 'inboxes.to_id', '=', 'receiver.user_id')
                        ->select('inboxes.*', 'sender.name as sender_name', 'receiver.name as receiver_name',
                                'sender.user_id as sender_id', 'receiver.user_id as receiver_id',
                                'sender.profile_img as sender_img','receiver.profile_img as receiver_img')
                        ->get();

        return view('inbox', $data, compact('pageName', 'title', 'inbox'));
    }

    public function send_message(Request $request, $user_id)
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }

        $request->validate([
            'message' => 'required',
        ]);

        $inbox = Inbox::where('created_by', $user->user_id)->where('to_id', $user_id)->first();

        if (!$inbox) {
            $inbox = Inbox::where('created_by', $user_id)->where('to_id', $user->user_id)->first();
            if (!$inbox) {
                $inbox = new Inbox;

                $inbox->created_by = $user->user_id;
                $inbox->to_id = $user_id;

                $inbox->save();
            }
            // else{

            // }
        }
        // else
        // {

        // }

        $message = new Message;
        $message->inbox_id = $inbox->id;
        $message->from = $user->user_id;
        $message->to = $user_id;
        $message->message = $request->message;

        $query = $message->save();

        if ($query) {
            return back()->with('success', 'Message Sent Successfully.');
        } else {
            return back()->with('fail', 'something went wrong.');
        }
    }

    public function chat_box($id)
    {

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $user,
                'roles' =>  UserRole::all()
            ];
        }
        $pageName = ' Chat';
        $title = 'Chat Box';

        $inbox = Inbox::where('inboxes.id', $id)
        ->leftJoin('users as sender', 'inboxes.created_by','=','sender.user_id')
                        ->leftJoin('users as receiver', 'inboxes.to_id', '=', 'receiver.user_id')
                        ->select('inboxes.*', 'sender.name as sender_name', 'receiver.name as receiver_name',
                                'sender.user_id as sender_id', 'receiver.user_id as receiver_id',
                                'sender.profile_img as sender_img','receiver.profile_img as receiver_img',
                                'sender.username as sender_username','receiver.username as receiver_username')
                        ->first();
        // return $inbox;

        $messages = Message::where('messages.inbox_id', $inbox->id)->orderBy('messages.created_at')->get();

        return view('chat-box', $data, compact('inbox', 'messages', 'pageName', 'title'));
    }

    public function userlist()
    {
        $users = User::where('user_id', '!=', session('LoggedUser'))->orderBy('user_id', 'DESC')->get();

        if (request()->ajax()) {
            return response()->json($users, 200);
        }
        return abort(404);
    }

    public function user_message($user_id = null)
    {
        // if (!request()->ajax()) {
        //     return abort(404);
        // }

        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('from', session('LoggedUser'));
            $query->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('from', $user_id);
            $query->where('to', session('LoggedUser'));
        })->get();

        return response()->json($messages, 200);
    }
}
