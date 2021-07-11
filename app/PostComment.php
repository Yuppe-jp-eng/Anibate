<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PostComment extends Model
{
    #Postとの関係
    public function post(): BelongsTo
    {
        return $this->belongsTo('App\Post');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }



}
