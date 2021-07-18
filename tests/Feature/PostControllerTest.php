<?php

namespace Tests\Feature;

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

    #ログイン状態のテスト
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
        ->get(route('posts.create'));

        $response->assertStatus(200)
        ->assertViewIs('posts.create');
    }

}
