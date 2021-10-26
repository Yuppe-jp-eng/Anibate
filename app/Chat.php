<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    /**
     * 送信userを取得
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable = ['content', 'room_id', 'user_id'];

}
