<?php

namespace CodePress\CodeTag\Tests\Models;


use CodePress\CodePost\Models\Post;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Mockery as m;

class TagTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_tag_model()
    {
        $tag = new Tag();
        $validator = m::mock(Validator::class);
        $tag->setValidator($validator);

        $this->assertEquals($tag->getValidator(), $validator);
    }

    public function test_should_check_if_it_is_valid_when_it_is()
    {
        $tag = new Tag();
        $tag->name = "Tag Test";

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
        $validator->shouldReceive('setData')->with(['name' => 'Tag Test']);
        $validator->shouldReceive('fails')->andReturn(false);

        $tag->setValidator($validator);

        $this->assertTrue($tag->isValid());
    }

    public function test_should_check_if_it_is_invalid_when_it_is()
    {
        $tag = new Tag();
        $tag->name = "Tag Test";

        $messageBag = m::mock('Illuminate\Support\MessageBag');

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
        $validator->shouldReceive('setData')->with(['name' => 'Tag Test']);
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $tag->setValidator($validator);

        $this->assertFalse($tag->isValid());
        $this->assertEquals($messageBag, $tag->errors);
    }

    public function test_check_if_a_tag_can_be_persisted()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $this->assertEquals('Tag Test', $tag->name);

        $tag = Tag::all()->first();
        $this->assertEquals('Tag Test', $tag->name);
    }

    public function test_can_add_tags_to_posts()
    {
        $post = Post::create(['title' => 'My Post', 'content' => 'My content', 'slug' => 'my-post']);
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

    public function test_can_add_posts_to_tags()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $post1 = Post::create(['title' => 'My post 1', 'content' => 'My content 1', 'slug' => 'my-post-1']);
        $post2 = Post::create(['title' => 'My post 2', 'content' => 'My content 2', 'slug' => 'my-post-2']);

        $post1->tags()->save($tag);
        $post2->tags()->save($tag);

        $this->assertCount(1, Tag::all());
        $this->assertEquals('Tag Test', $post1->tags->first()->name);
        $this->assertEquals('Tag Test', $post2->tags->first()->name);
        $posts = Tag::find(1)->posts;
        $this->assertCount(2, $posts);
        $this->assertEquals('My post 1', $posts[0]->title);
        $this->assertEquals('My post 2', $posts[1]->title);
    }

    public function test_can_soft_deletes()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->delete();

        $this->assertEquals(true, $tag->trashed());
        $this->assertCount(0, Tag::all());
    }

    public function test_can_get_rows_deleted()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->delete();

        $tag = Tag::onlyTrashed()->get();
        $this->assertEquals(1, $tag[0]->id);
        $this->assertEquals('Tag Test', $tag[0]->name);
    }

    public function test_can_get_rows_deleted_and_activated()
    {
        $tag = Tag::create(['name' => 'Tag Test 1']);
        Tag::create(['name' => 'Tag Test 2']);
        $tag->delete();

        $tags = Tag::withTrashed()->get();
        $this->assertCount(2, $tags);
        $this->assertEquals(1, $tags[0]->id);
        $this->assertEquals('Tag Test 1', $tags[0]->name);
    }

    public function test_can_force_delete()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->forceDelete();
        $this->assertCount(0, Tag::all());
    }

    public function test_can_restore_rows_from_deleted()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $tag->delete();
        $tag->restore();

        $tag = Tag::find(1);
        $this->assertEquals(1, $tag->id);
        $this->assertEquals('Tag Test', $tag->name);
    }

}