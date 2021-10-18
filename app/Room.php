<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Room extends Model
{
    /**
     * room参加者を取得
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany('App\User', 'user_rooms');
    }

    /**
     * room内チャットを取得
     */
    public function chats(): HasMany
    {
        return $this->hasMany('App\Chat');
    }
}
