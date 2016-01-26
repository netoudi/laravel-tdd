<?php

namespace CodePress\CodeTag\Testing;

use CodePress\CodeTag\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTagsTest extends \TestCase
{
    use DatabaseTransactions;

    public function test_can_visit_admin_tags_page()
    {
        $this->visit('/admin/tags')
            ->see('Tags');
    }

    public function test_tags_listing()
    {
        Tag::create(['name' => 'Tag 1']);
        Tag::create(['name' => 'Tag 2']);
        Tag::create(['name' => 'Tag 3']);
        Tag::create(['name' => 'Tag 4']);

        $this->visit('/admin/tags')
            ->see('Tag 1')
            ->see('Tag 2')
            ->see('Tag 3')
            ->see('Tag 4');
    }

    public function test_click_create_new_tag()
    {
        $this->visit('/admin/tags')
            ->click('New Tag')
            ->seePageIs('/admin/tags/create')
            ->see('Create Tag');
    }

    public function test_create_new_tag()
    {
        $this->visit('/admin/tags/create')
            ->type('Tag Test', 'name')
            ->press('Submit')
            ->seePageIs('/admin/tags')
            ->see('Tag Test');
    }

    public function test_edit_tag()
    {
        $category = Tag::create(['name' => 'Tag Edit']);

        $this->visit('/admin/tags')
            ->see('Tag Edit')
            ->see('Delete');

        $this->visit('/admin/tags/edit/' . $category->id)
            ->see('Update Tag')
            ->type('Tag Edit Update', 'name')
            ->press('Submit')
            ->seePageIs('/admin/tags')
            ->see('Tag Edit Update');
    }

    public function test_destroy_category()
    {
        $category = Tag::create(['name' => 'Tag Destroy']);

        $this->visit('/admin/tags')
            ->see('Tag Destroy')
            ->see('Delete');

        $this->visit('/admin/tags/destroy/' . $category->id)
            ->seePageIs('/admin/tags')
            ->dontSee('Tag Destroy');
    }
}