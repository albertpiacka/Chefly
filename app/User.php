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
        'name', 'email', 'password', 'type',
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
        return $this->hasMany('App\Post');
    }

    /**
     * Get user's comments
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get number of likes of this author
     */
    public function likes()
    {
        return $this->hasMany('App\Like')->latest();
    }


    /**
     * Get number of likes of author's posts
     */
    public function postLikes()
    {
        return $this->hasManyThrough('App\Like', 'App\Post');
    }

    /**
     * Get number of user's followers
     */
    public function followers()
    {
        return $this->hasMany('App\Follow');
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
