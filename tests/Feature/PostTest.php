<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    #null値を取った時にfalseを返す
    public function testIsLikedByNull()
    {
        $post = factory(Post::class)->create();

        $result = $post->isLikedBy(null);

        $this->assertFalse($result);
    }

    #いいねしているユーザーを引数に取った時にtrueを返すか
    public function testIsLikedByTheUser()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $post->likes()->attach($user);

        $result = $post->isLikedBy($user);

        $this->assertTrue($result);
    }

    #いいねしていないユーザーを引数に取った時にfalseを返すか
    public function testIsLikedByAnother()
    {
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $post->likes()->attach($another);

        $result = $post->isLikedBy($user);

        $this->assertFalse($result);
    }
}
