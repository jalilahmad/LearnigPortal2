<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $fillable = [
        'user_id',
        'episode_id'
    ];

}
