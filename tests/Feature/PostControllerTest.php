<?php

namespace Tests\Feature;

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
}
