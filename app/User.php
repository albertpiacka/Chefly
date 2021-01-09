<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'about', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get posts of user
     */
    public function posts()
    {
        return $this->hasMany('App\Post')->with('user', 'likes', 'comments');
    }

    /**
     * Get user's comments
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get user's likes
     */
    public function likes()
    {
        return $this->hasMany('App\Like')->latest();
    }


    /**
     * Get likes of user's posts 
     */
    public function postLikes()
    {
        return $this->hasManyThrough('App\Like', 'App\Post');
    }

    /**
     * Get user's bookmarks
     */
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark')->latest()->with('post');
    }

    /**
     * 
     * Above is everything regarding posts
     * Below is everything regarding quickposts
     * 
     * 
     */

    /**
     * Get quickposts of user
     */
    public function quickposts()
    {
        return $this->hasMany('App\Quickpost')->with('user', 'likes', 'comments');
    }

    /**
     * 
     * Above is everything regarding quickposts
     * Below is everything regarding following, messages and conversations
     * 
     * 
     */

    /**
     * Get user's followers
     */
    public function followers()
    {
        return $this->hasMany('App\Follow');
    }

    /**
     * Get users who is user following
     */
    public function following()
    {
        return $this->hasMany('App\Follow', 'follower_id')->with('user.posts', 'user.comments');
    }

    /**
     * Get user's conversations
     */
    public function conversations()
    {
        return $this->belongsToMany('App\Conversation')->with('users', 'messages');
    }

    /**
     * Get user's messages
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
    
}
