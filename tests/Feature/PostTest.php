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
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->another_user = factory(User::class)->create();
        $this->post = factory(Post::class)
        ->create(['user_id' => $this->user->id]);
    }

    #null値を取った時にfalseを返す
    public function testIsLikedByNull()
    {
        $post = $this->post;

        $result = $post->isLikedBy(null);

        $this->assertFalse($result);
    }

    #いいねしているユーザーを引数に取った時にtrueを返すか
    public function testIsLikedByTheUser()
    {
        $post = $this->post;
        $user = $this->user;
        $post->likes()->attach($user);

        $result = $post->isLikedBy($user);

        $this->assertTrue($result);
    }

    #いいねしていないユーザーを引数に取った時にfalseを返すか
    public function testIsLikedByAnother()
    {
        $user = $this->user;
        $another = $this->another_user;
        $post = $this->post;
        $post->likes()->attach($another);

        $result = $post->isLikedBy($user);

        $this->assertFalse($result);
    }
}
