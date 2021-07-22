<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class PostControllerTest extends TestCase
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

    public function testAnimeIndex()
    {
        $title = "ナルト";
        $response = $this->get(route('title_index', ['title' => $title]));
        $response->assertStatus(200)
        ->assertViewIs('posts.anime_index');
    }


    #非ログイン状態のテスト
    public function testGuestCreate()
    {
        $response = $this->get(route('posts.create'));

        $response->assertRedirect(route('login'));
    }

    public function testGuestShow()
    {
        $post = $this->post;
        $response = $this->get(route('posts.show', compact('post')));
        $response->assertRedirect(route('login'));
    }

    public function testGuestEdit()
    {
        $post = $this->post;
        $response = $this->get(route('posts.edit', compact('post')));
        $response->assertRedirect(route('login'));
    }
    #ログイン状態のテスト
    public function testAuthCreate()
    {
        $user = $this->user;

        $response = $this->actingAs($user)
        ->get(route('posts.create'));

        $response->assertStatus(200)
        ->assertViewIs('posts.create');
    }

    public function testAuthShow()
    {
        $user = $this->user;
        $post = $this->post;

        $response = $this->actingAs($user)
        ->get(route('posts.show', compact('post')));

        $response->assertStatus(200)
        ->assertViewIs('posts.show');
    }

    public function testAuthEdit()
    {
        $this->withoutExceptionHandling();
        $user = $this->user;

        $post = $this->post;

        $response = $this->actingAs($user)
        ->get(route('posts.edit', ['post' => $this->post->id]));

        $response->assertStatus(200)
        ->assertViewIs('posts.edit');
    }


}
