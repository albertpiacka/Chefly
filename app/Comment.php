<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'text', 'post_id'
    ];

    /**
     * Get author of comment
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get post which has comment
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
