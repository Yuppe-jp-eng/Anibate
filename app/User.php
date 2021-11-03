<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * userのフォロワーを取得
     */
    public function followers(): BelongsToMany
    {
        return $this->BelongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    /**
     * userのフォローを取得
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }
    /**
     * userが$userにフォローされているか
     */
    public function isFollowedBy(?User $user):bool
    {
        return $user
        ?(bool)$this->followers->where('id', $user->id)->count()
        :false;
    }

    /**
     * userのフォロワー数
     */
    public function getCountFollowersAttribute():int
    {
        return $this->followers()->count();
    }
    /**
     * userのフォロー数
     */
    public function getCountFollowingsAttribute():int
    {
        return $this->followings()->count();
    }

    /**
     * userの投稿を取得
     *  */
    public function posts():HasMany
    {
        return $this->hasMany('App\Post');
    }

    /**
     * userのコメントを取得
     */
    public function comments():HasMany
    {
        return $this->hasMany('App\PostComment');
    }

    /**
     * userの視聴済みアニメを取得
     */
    public function watched_animes():HasMany
    {
        return $this->hasMany('App\WatchedAnime');
    }
    /**
     * userのいいねした投稿を取得
     */

    public function likes():BelongsToMany
    {
        return $this->belongsToMany('App\Post', 'likes')->withTimestamps();
    }

    /**
     * userが参加している部屋を取得
     */
    public function rooms():BelongsToMany
    {
        return $this->belongsToMany('App\Room', 'user_rooms');
    }
}
