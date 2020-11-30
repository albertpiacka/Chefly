<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'user_id', 'follower_id'
    ];

    /**
     * Get author of this like 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
