<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'user_id', 'post_id'
    ];

    /**
     * Get user who made this bookmark 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get post which has this bookmark
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
