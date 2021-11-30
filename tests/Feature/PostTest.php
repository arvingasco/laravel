<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No memes found!');
    }

    public function testSee1MemeWhenThereIs1WithoutComments() {
        $this->createDummyBlogPost();

        $response = $this->get('/posts');

        $response->assertSeeText('New Title');
        $response->assertSeeText('No comments');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title'
        ]);
    }

    public function testSee1MemeWithComments() {
        $this->createDummyBlogPost();
        BlogPost::factory()->hasComment(4)->create();

        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');
    }

    public function testStoreValid() {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters',
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this -> assertEquals(session('status'), 'Meme was successfully created!');
    }

    public function testStoreFail() {
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors') -> getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid() {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed',
        ];

        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Meme was successfully updated!');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title',
        ]);
    }

    public function testDelete() {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);
        $post = BlogPost::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->actingAs($user)
            ->delete("/posts/{$post -> id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Meme was successfully deleted.');
        $this->assertSoftDeleted('blog_posts', $post->getAttributes());
    }

    private function createDummyBlogPost($userId = null): BlogPost {
        return BlogPost::factory()->newTitle()->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);
    }
}
