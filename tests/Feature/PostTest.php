<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testPostsPage(): void
    {
        $response = $this->get(route('posts-page'));

        $response->assertOk();
    }
    public function testCreatePostPage(): void
    {
        $this->authorized();

        $response = $this->get(route('create-post-page'));

        $response->assertOk();
    }

    public function testCreatePost(): void
    {
        $this->authorized();

        $body = [
            'title' => 'Title',
            'content' => 'Content',
        ];
        $response = $this->post(route('create-post'), $body);

        $response->assertRedirect();

        $this->assertDatabaseHas('posts', $body);
    }

    public function testShowPostPage(): void
    {
        $id = DB::table('posts')->insertGetId([
            'title' => 'Title',
            'content' => 'Content',
        ]);

        $response = $this->get(route('show-post-page', $id));

        $response->assertOk();
    }

    public function testShowPostPageNotFound(): void
    {

        $response = $this->get(route('show-post-page', 10));

        $response->assertNotFound();
    }
}
