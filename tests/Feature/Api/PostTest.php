<?php
// tests/Feature/Api/PostTest.php

namespace Tests\Feature\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/posts', [
                'title' => 'Test Post',
                'content' => 'This is test content',
                'category' => 'tech',
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Post created successfully'
            ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'user_id' => $user->id
        ]);
    }

    public function test_unauthenticated_user_cannot_create_post()
    {
        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'content' => 'This is test content',
            'category' => 'tech',
        ]);

        $response->assertStatus(401);
    }

    public function test_user_can_view_posts_list()
    {
        $user = User::factory()->create();
        Post::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/posts');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'content', 'user']
                ],
                'meta' => ['current_page', 'last_page', 'total']
            ]);
    }

    public function test_user_can_update_own_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/posts/{$post->id}", [
                'title' => 'Updated Title',
                'content' => 'Updated content',
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Post updated successfully'
            ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title'
        ]);
    }

    public function test_user_cannot_update_others_post()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1, 'sanctum')
            ->putJson("/api/posts/{$post->id}", [
                'title' => 'Updated Title',
            ]);

        $response->assertStatus(403);
    }
}
