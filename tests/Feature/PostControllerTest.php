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
        $post = factory(Post::class)->create();
        $response = $this->get(route('posts.show', compact('post')));
        $response->assertRedirect(route('login'));
    }
    #ログイン状態のテスト
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
        ->get(route('posts.create'));

        $response->assertStatus(200)
        ->assertViewIs('posts.create');
    }

    public function testAuthShow()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)
        ->get(route('posts.show', compact('post')));

        $response->assertStatus(200)
        ->assertViewIs('posts.show');

        
    }

}
