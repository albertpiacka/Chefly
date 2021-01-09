<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = ['tag'];

    /**
     * Tag belongs to many posts
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
