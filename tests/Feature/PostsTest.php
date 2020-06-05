<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;
use App\User;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_list_of_posts_can_be_fetched_for_the_auth_user()
    {
        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $anotherPost = factory(Post::class)->create(['user_id' => $anotherUser->id]);

        $response = $this->get('/api/posts?api_token=' . $user->api_token);

        $response->assertJsonCount(1)
        ->assertJson([
            'data' => [
                [
                    'data' =>[
                        'post_id' => $post->id
                    ]
                ]
            ]
        ]);

    }

    /** @test */
    public function an_unauthorized_user_should_redirect_login()
    {
        $response = $this->post('/api/posts', array_merge($this->data(), ['api_token' => '']));

        $response->assertRedirect('/login');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function an_authenticated_user_can_add_a_post()
    {
        $response = $this->post('/api/posts', $this->data());

        $post = Post::first();

        $this->assertEquals('Test caption', $post->caption);
        $this->assertEquals('testimage', $post->image);

        $response->assertStatus(201);
        $response->assertJson([
            'data' =>[
                'post_id' => $post->id
            ]
        ]);
    }

    /** @test */
    public function fields_are_required()
    {
        collect(['caption', 'image'])
            ->each(function ($field) {
                $response = $this->post(
                    '/api/posts',
                    array_merge($this->data(), [$field => ''])
                );

                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Post::all());
            });
    }

    /** @test */
    public function a_post_can_be_retrieved()
    {
        $post = factory(Post::class)->create(['user_id' => $this->user->id]);

        $response = $this->get('/api/posts/' . $post->id . '?api_token=' . $this->user->api_token);

        $response->assertJsonFragment([
            'data' => [
                'post_id' => $post->id,
                'caption' => $post->caption,
                'image' => $post->image,
                'last_updated' => $post->updated_at->diffForHumans()
            ]
        ]);
    }

    /** @test */
    public function only_the_users_posts_can_be_retrieved()
    {
        $post = factory(Post::class)->create(['user_id' => $this->user->id]);

        $user = factory(User::class)->create();

        $response = $this->get('/api/posts/' . $post->id . '?api_token=' . $user->api_token);

        $response->assertStatus(403);
    }

    /** @test */
    public function a_post_can_be_patched()
    {
        $post = factory(Post::class)->create(['user_id' => $this->user->id]);

        $response = $this->patch('/api/posts/' . $post->id, $this->data());

        $post = $post->fresh();

        $this->assertEquals('Test caption', $post->caption);
        $this->assertEquals('testimage', $post->image);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'post_id' => $post->id
            ]
        ]);
    }

    // /** @test */
    // public function only_owner_can_patch()
    // {
    //     $post = factory(Post::class)->create();

    //     $anotherUser = factory(User::class)->create();

    //     $response = $this->patch('/api/posts/' . $post->id, array_merge($this->data(), ['api_token' => $anotherUser->api_token]));

    //     $response->assertStatus(403);
    // }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $post = factory(Post::class)->create(['user_id' => $this->user->id]);

        $response = $this->delete('/api/posts/' . $post->id, ['api_token' => $this->user->api_token]);

        $this->assertCount(0, Post::all());
        $response->assertStatus(204);
    }

    // /** @test */
    // public function only_owner_can_delete()
    // {
    //     $post = factory(Post::class)->create();

    //     $anotherUser = factory(User::class)->create();

    //     $response = $this->delete('/api/posts/' . $post->id, ['api_token' => $this->user->api_token]);

    //     $response->assertStatus(403);
    // }

    private function data()
    {
        return [
            'caption' => 'Test caption',
            'image' => 'testimage',
            'api_token' => $this->user->api_token,
        ];
    }
}
