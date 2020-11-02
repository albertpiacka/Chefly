<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get author of blog post
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get author of blog post
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
