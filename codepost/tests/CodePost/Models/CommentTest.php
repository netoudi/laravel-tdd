<?php

namespace CodePress\CodePost\Tests\Models;


use CodePress\CodePost\Models\Comment;
use CodePress\CodePost\Models\Post;
use CodePress\CodePost\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Illuminate\View\Engines\CompilerEngine;
use Mockery as m;

class CommentTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_infject_validator_in_comment_model()
    {
        $comment = new Comment();
        $validator = m::mock(Validator::class);
        $comment->setValidator($validator);

        $this->assertEquals($comment->getValidator(), $validator);
    }

    public function test_should_check_if_it_is_valid_when_it_is()
    {
        $comment = new Comment();
        $comment->content = "Comment Content";

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with([
            'content' => 'required'
        ]);
        $validator->shouldReceive('setData')->with([
            'content' => 'Comment Content'
        ]);
        $validator->shouldReceive('fails')->andReturn(false);

        $comment->setValidator($validator);

        $this->assertTrue($comment->isValid());
    }

    public function test_should_check_if_it_is_invalid_when_it_is()
    {
        $comment = new Comment();
        $comment->content = '';

        $messageBag = m::mock('Illuminate\Support\MessageBag');

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with([
            'content' => 'required'
        ]);
        $validator->shouldReceive('setData')->with(['content' => '']);
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $comment->setValidator($validator);
        $this->assertFalse($comment->isValid());
        $this->assertEquals($messageBag, $comment->errors);
    }

    public function test_check_if_a_comment_can_be_persisted()
    {
        $post = Post::create(['title' => 'Post Test', 'content' => 'Post Content']);
        $comment = Comment::create(['content' => 'Content Test', 'post_id' => $post->id]);
        $this->assertEquals('Content Test', $comment->content);

        $comment = Comment::all()->first();
        $this->assertEquals('Content Test', $comment->content);
        $post = Comment::find(1)->post;
        $this->assertEquals('Post Test', $post->title);
    }

    public function test_can_validate_comment()
    {
        $comment = new Comment();
        $comment->content = "Comment Content";

        $factory = $this->app->make('Illuminate\Validation\Factory');
        $validator = $factory->make([], []);

        $comment->setValidator($validator);

        $this->assertTrue($comment->isValid());
        $comment->content = null;
        $this->assertFalse($comment->isValid());
    }

    public function test_can_force_delete_all_from_relationship()
    {
        $post = Post::create(['title' => 'Post test', 'content' => 'Content post']);
        Comment::create(['content' => 'Content Test 1', 'post_id' => $post->id]);
        Comment::create(['content' => 'Content Test 2', 'post_id' => $post->id]);

        $post->comments()->forceDelete();
        $this->assertCount(0, $post->comments()->get());
    }

    public function test_can_restore_deleted_all_from_relationship()
    {
        $post = Post::create(['title' => 'Post test', 'content' => 'Content post']);
        $comment1 = Comment::create(['content' => 'Content Test 1', 'post_id' => $post->id]);
        $comment2 = Comment::create(['content' => 'Content Test 2', 'post_id' => $post->id]);
        $comment1->delete();
        $comment2->delete();

        $post->comments()->restore();
        $this->assertCount(2, $post->comments()->get());
    }

}