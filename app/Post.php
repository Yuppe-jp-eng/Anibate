<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    protected $fillable = [
        'title',
        'body',
        'episode',
        'comments_allowed'
    ];
    /**
     * 投稿userを取得
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
    /**
     * 投稿をいいねしたuserを取得
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    #userがいいねしているかの確認
    public function isLikedBy(?User $user):bool
    {
        return $user
        ?(bool)$this->likes->where('id', $user->id)->count()
        :false;
    }
    /**
     * 投稿のいいね数を取得
     */
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    /**
     * 投稿に対するコメントの取得
     */
    public function post_comments():HasMany
    {
        return $this->hasMany('App\PostComment');
    }
    
    #投稿に結びついたコメントとコメントに結びついたUserを配列で取得
    public function get_comments_with_user(int $post_id):Object
    {
        $comments = PostComment::with('user')
        ->where('post_id', $post_id)
        ->orderByDesc('created_at')
        ->get();

        return $comments;
    }
}


