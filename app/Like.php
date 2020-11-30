<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'user_id', 'post_id'
    ];

    /**
     * Get author of this like 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get author of blog post
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
