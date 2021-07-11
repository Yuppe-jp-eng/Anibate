<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchedAnime extends Model
{
    protected $fillable = [
        'user_id',
        'broadcast_season',
        'title',
        'memo',
        'season',
    ];
}
