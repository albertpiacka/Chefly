<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Conversation;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = Message::create([
            'text' => $request->text,
            'conversation_id' => $request->conversation_id,
            'sender_name' => $request->sender_name,
            'receiver_name' => $request->receiver_name,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
        ]);

        event(new MessageSent($message));
    }
}
