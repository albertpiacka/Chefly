<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'name',
        'user_one',
        'user_two',
    ];

    /**
     * Get users of conversation 
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get messages for conversation
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
