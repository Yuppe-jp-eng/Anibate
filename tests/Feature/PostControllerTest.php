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
        $response = $this->actingAs($this->user)
        ->get(route('posts.create'));

        $response->assertStatus(200)
        ->assertViewIs('posts.create');
    }

    public function testStore()
    {
        $post_data = [
            'title' => '涼宮ハルヒの憂鬱',
            'episode' => '3話',
            'body' => 'とっても面白かったですね',
            'comments_allowed' => true,
            'user_id' => $this->user->id
        ];

        $url = route('posts.store');

        $response = $this->actingAs($this->user)
        ->post($url, $post_data);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302); #リダイレクト確認

        $response->assertRedirect('/');

        $this->assertDatabaseHas('posts', [
            'title' => '涼宮ハルヒの憂鬱'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewIs('top');

        $response->assertSeeText($post_data['title']);
    }

    public function testAuthShow()
    {
        $post = $this->post;

        $response = $this->actingAs($this->user)
        ->get(route('posts.show', compact('post')));

        $response->assertStatus(200)
        ->assertViewIs('posts.show');
    }

    public function testAuthEdit()
    {
        $response = $this->actingAs($this->user)
        ->get(route('posts.edit', ['post' => $this->post]));

        $response->assertStatus(200)
        ->assertViewIs('posts.edit');
    }

    public function testAuthUpdata()
    {
        $post_data = [
            'title' => '涼宮ハルヒの憂鬱',
            'body' => 'とっても面白かったですね。特にあのシーンは感動しました。',
        ];

        $url = route('posts.update', ['post' => $this->post]);

        $response = $this->actingAs($this->user)
        ->put($url, $post_data);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response -> assertRedirect('/');

        $this->assertDatabaseHas('posts', ['body' => $post_data['body']]);
    }

}
