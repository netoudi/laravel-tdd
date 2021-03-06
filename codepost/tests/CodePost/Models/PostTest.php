<?php

namespace CodePress\CodePost\Tests\Models;


use CodePress\CodeCategory\Models\Category;
use CodePress\CodePost\Models\Post;
use CodePress\CodePost\Tests\AbstractTestCase;
use CodePress\CodeTag\Models\Tag;
use Illuminate\Validation\Validator;
use Mockery as m;

class PostTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_infject_validator_in_post_model()
    {
        $post = new Post();
        $validator = m::mock(Validator::class);
        $post->setValidator($validator);

        $this->assertEquals($post->getValidator(), $validator);
    }

    public function test_should_check_if_it_is_valid_when_it_is()
    {
        $post = new Post();
        $post->title = "Post Test";
        $post->content = "Post Content";

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $validator->shouldReceive('setData')->with([
            'title' => 'Post Test',
            'content' => 'Post Content'
        ]);
        $validator->shouldReceive('fails')->andReturn(false);

        $post->setValidator($validator);

        $this->assertTrue($post->isValid());
    }

    public function test_should_check_if_it_is_invalid_when_it_is()
    {
        $post = new Post();
        $post->title = "Post Test";

        $messageBag = m::mock('Illuminate\Support\MessageBag');

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $validator->shouldReceive('setData')->with(['title' => 'Post Test']);
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $post->setValidator($validator);
        $this->assertFalse($post->isValid());
        $this->assertEquals($messageBag, $post->errors);
    }

    public function test_check_if_a_post_can_be_persisted()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Post Content']);
        $this->assertEquals('Post Test', $post->title);
        $this->assertEquals('Post Content', $post->content);

        $post = Post::all()->first();
        $this->assertEquals('Post Test', $post->title);
    }

    public function test_can_validate_post()
    {
        $post = new Post();
        $post->title = "Post Test";
        $post->content = "Post Content";

        $factory = $this->app->make('Illuminate\Validation\Factory');
        $validator = $factory->make([], []);

        $post->setValidator($validator);

        $this->assertTrue($post->isValid());
        $post->title = null;
        $this->assertFalse($post->isValid());
    }

    public function test_can_slug()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Post Content']);
        $this->assertEquals($post->slug, "post-test");

        $post = Post::create(['title' => 'Post Test', 'content' => 'Post Content']);
        $this->assertEquals($post->slug, "post-test-1");

        $post = Post::findBySlug("post-test-1");
        $this->assertInstanceOf(Post::class, $post);
    }

    public function test_can_add_categories_to_posts()
    {
        $post = Post::create(['title' => 'My Post', 'content' => 'My content']);
        $category1 = Category::create(['name' => 'Category 1', 'active' => true]);
        $category2 = Category::create(['name' => 'Category 2', 'active' => true]);

        $category1->posts()->save($post);
        $category2->posts()->save($post);

        $this->assertCount(1, Post::all());
        $this->assertEquals('My Post', $category1->posts->first()->title);
        $this->assertEquals('My Post', $category2->posts->first()->title);
        $categories = Post::find(1)->categories;
        $this->assertCount(2, $categories);
        $this->assertEquals('Category 1', $categories[0]->name);
        $this->assertEquals('Category 2', $categories[1]->name);
    }

    public function test_can_add_tags_to_posts()
    {
        $post = Post::create(['title' => 'My Post', 'content' => 'My content']);
        $tag1 = Tag::create(['name' => 'Tag 1']);
        $tag2 = Tag::create(['name' => 'Tag 2']);

        $tag1->posts()->save($post);
        $tag2->posts()->save($post);

        $this->assertCount(1, Post::all());
        $this->assertEquals('My Post', $tag1->posts->first()->title);
        $this->assertEquals('My Post', $tag2->posts->first()->title);
        $tags = Post::find(1)->tags;
        $this->assertCount(2, $tags);
        $this->assertEquals('Tag 1', $tags[0]->name);
        $this->assertEquals('Tag 2', $tags[1]->name);
    }

    public function test_can_add_comments()
    {
        $post = Post::create(['title' => 'Post tes', 'content' => 'Content post']);
        $post->comments()->create(['content' => 'Comment 1']);
        $post->comments()->create(['content' => 'Comment 2']);

        $comments = Post::find(1)->comments;
        $this->assertCount(2, $comments);
        $this->assertEquals('Comment 1', $comments[0]->content);
        $this->assertEquals('Comment 2', $comments[1]->content);
    }

    public function test_can_soft_deletes()
    {
        $post = Post::create(['title' => 'Post test', 'content' => 'Content post']);
        $post->delete();

        $this->assertEquals(true, $post->trashed());
        $this->assertCount(0, Post::all());
    }

    public function test_can_get_rows_deleted()
    {
        $post = Post::create(['title' => 'Post test', 'content' => 'Content post']);
        $post->delete();

        $post = Post::onlyTrashed()->get();
        $this->assertEquals(1, $post[0]->id);
        $this->assertEquals('Post test', $post[0]->title);
    }

    public function test_can_get_rows_deleted_and_activated()
    {
        $post = Post::create(['title' => 'Post test 1', 'content' => 'Content post 1']);
        Post::create(['title' => 'Post test 2', 'content' => 'Content post 2']);
        $post->delete();

        $posts = Post::withTrashed()->get();
        $this->assertCount(2, $posts);
        $this->assertEquals(1, $posts[0]->id);
        $this->assertEquals('Post test 1', $posts[0]->title);
    }

    public function test_can_force_delete()
    {
        $post = Post::create(['title' => 'Post test 1', 'content' => 'Content post 1']);
        $post->forceDelete();
        $this->assertCount(0, Post::all());
    }

    public function test_can_restore_rows_from_deleted()
    {
        $post = Post::create(['title' => 'Post test', 'content' => 'Content post']);
        $post->delete();
        $post->restore();

        $post = Post::find(1);
        $this->assertEquals(1, $post->id);
        $this->assertEquals('Post test', $post->title);
    }

}