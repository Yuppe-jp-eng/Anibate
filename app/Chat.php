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

    /**
     * チャットとuser情報をオブジェクトで取得
     *
     */
    public function withUserInfo()
    {
        $chat = $this::with('user:id,name,profile_image')
        ->find($this->id);

        return $chat;

    }
    protected
    $fillable = ['content', 'room_id', 'user_id'];

}
