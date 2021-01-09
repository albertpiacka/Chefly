<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'title',
        'text',
        'slug',
        'image',
        'user_id'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get author of blog post
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get comments of this post
     */
    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }

    /**
     * Get number of likes on this post
     */
    public function likes()
    {
        return $this->hasMany('App\Like')->latest();
    }

    /**
     * Get number of bookmarks on this post
     */
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark')->latest();
    }

    /**
     * Post has many tags
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

}
