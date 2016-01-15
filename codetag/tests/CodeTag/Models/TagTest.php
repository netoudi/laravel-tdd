<?php

namespace CodePress\CodeTag\Tests\Models;


use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\Tests\AbstractTestCase;

class TagsTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_check_if_a_tag_can_be_persisted()
    {
        $tag = Tag::create(['name' => 'Tag Test']);
        $this->assertEquals('Tag Test', $tag->name);

        $tag = Tag::all()->first();
        $this->assertEquals('Tag Test', $tag->name);
    }

}