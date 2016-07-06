<?php

namespace CodePress\CodePost\Testing;

use CodePress\CodePost\Models\Post;
use CodePress\CodeUser\Models\Role;
use CodePress\CodeUser\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminPostsTest extends \TestCase
{
    use DatabaseTransactions;

    protected function getUser()
    {
        $user = factory(User::class)->create();
        $user->roles()->save(Role::find(1)); //ROLE_ADMIN
        return $user;
    }

    public function test_can_visit_admin_posts_page()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/posts')
            ->see('Posts');
    }

    public function test_posts_listing()
    {
        Post::create(['title' => 'Post 1', 'content' => 'Post Content']);
        Post::create(['title' => 'Post 2', 'content' => 'Post Content']);
        Post::create(['title' => 'Post 3', 'content' => 'Post Content']);
        Post::create(['title' => 'Post 4', 'content' => 'Post Content']);

        $this->actingAs($this->getUser())
            ->visit('/admin/posts')
            ->see('Post 1')
            ->see('Post 2')
            ->see('Post 3')
            ->see('Post 4');
    }

    public function test_can_visit_admin_posts_deleted_page()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/posts/deleted')
            ->see('Posts Deleted');
    }

    public function test_posts_listing_deleted()
    {
        $post1 = Post::create(['title' => 'Post 1', 'content' => 'Post Content']);
        $post2 = Post::create(['title' => 'Post 2', 'content' => 'Post Content']);
        $post3 = Post::create(['title' => 'Post 3', 'content' => 'Post Content']);
        $post4 = Post::create(['title' => 'Post 4', 'content' => 'Post Content']);

        $post1->delete();
        $post2->delete();
        $post3->delete();
        $post4->delete();
        $post4->restore();

        $this->actingAs($this->getUser())
            ->visit('/admin/posts/deleted')
            ->see('Post 1')
            ->see('Post 2')
            ->see('Post 3')
            ->dontSee('Post 4');
    }

    public function test_click_create_new_post()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/posts')
            ->click('New Post')
            ->seePageIs('/admin/posts/create')
            ->see('Create Post');
    }

    public function test_create_new_post()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/posts/create')
            ->type('Post Test', 'title')
            ->type('Post Content', 'content')
            ->press('Submit')
            ->seePageIs('/admin/posts')
            ->see('Post Test');
    }

    public function test_edit_post()
    {
        $post = Post::create(['title' => 'Post Edit', 'content' => 'Post Content']);

        $this->actingAs($this->getUser())
            ->visit('/admin/posts')
            ->see('Post Edit')
            ->see('Delete');

        $this->actingAs($this->getUser())
            ->visit('/admin/posts/edit/' . $post->id)
            ->see('Update Post')
            ->see('Post Edit')
            ->see('Post Content')
            ->type('Post Edit Update', 'title')
            ->type('Post Content Update', 'content')
            ->press('Submit')
            ->seePageIs('/admin/posts')
            ->see('Post Edit Update');

        $post = Post::find($post->id);
        $this->assertEquals('Post Edit Update', $post->title);
        $this->assertEquals('Post Content Update', $post->content);
    }

    public function test_destroy_post()
    {
        $post = Post::create(['title' => 'Post Destroy', 'content' => 'Post Content']);

        $this->actingAs($this->getUser())
            ->visit('/admin/posts')
            ->see('Post Destroy')
            ->see('Delete');

        $this->actingAs($this->getUser())
            ->visit('/admin/posts/destroy/' . $post->id)
            ->seePageIs('/admin/posts')
            ->dontSee('Post Destroy');
    }
}