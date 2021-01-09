<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quickpost extends Model
{
    /**
     * Data which can be stored in database
     */
    protected $fillable = [
        'text',
        'user_id',
        'file',
    ];

    /**
     * Get author of quickpost
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
