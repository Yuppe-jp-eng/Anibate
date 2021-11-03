<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PostComment extends Model
{
    /**
     * コメントされた投稿を取得
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * コメントしたuserを取得
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }



}
