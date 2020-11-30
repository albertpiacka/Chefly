<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'text',
        'conversation_id',
        'sender_name',
        'receiver_name',
        'sender_id',
        'receiver_id',
    ];

    /**
     * Get author of message 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get conversation which message message belongs to
     */
    public function conversation()
    {
        return $this->belongsTo('App\Conversation');
    }
}
