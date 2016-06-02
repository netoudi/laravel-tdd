<?php

namespace CodePress\CodeCategory\Testing;

use CodePress\CodeCategory\Models\Category;
use CodePress\CodeUser\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCategoriesTest extends \TestCase
{
    use DatabaseTransactions;

    protected function getUser()
    {
        return factory(User::class)->create();
    }

    public function test_can_visit_admin_categories_page()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/categories')
            ->see('Categories');
    }

    public function test_categories_listing()
    {
        Category::create(['name' => 'Category 1', 'active' => true]);
        Category::create(['name' => 'Category 2', 'active' => true]);
        Category::create(['name' => 'Category 3', 'active' => true]);
        Category::create(['name' => 'Category 4', 'active' => true]);

        $this->actingAs($this->getUser())
            ->visit('/admin/categories')
            ->see('Category 1')
            ->see('Category 2')
            ->see('Category 3')
            ->see('Category 4');
    }

    public function test_click_create_new_category()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/categories')
            ->click('New Category')
            ->seePageIs('/admin/categories/create')
            ->see('Create Category');
    }

    public function test_create_new_category()
    {
        $this->actingAs($this->getUser())
            ->visit('/admin/categories/create')
            ->type('Category Test', 'name')
            ->check('active')
            ->press('Submit')
            ->seePageIs('/admin/categories')
            ->see('Category Test');
    }

    public function test_edit_category()
    {
        $category = Category::create(['name' => 'Category Edit', 'active' => true]);

        $this->actingAs($this->getUser())
            ->visit('/admin/categories')
            ->see('Category Edit')
            ->see('Delete');

        $this->actingAs($this->getUser())
            ->visit('/admin/categories/edit/' . $category->id)
            ->see('Update Category')
            ->type('Category Edit Update', 'name')
            ->check('active')
            ->press('Submit')
            ->seePageIs('/admin/categories')
            ->see('Category Edit Update');
    }

    public function test_destroy_category()
    {
        $category = Category::create(['name' => 'Category Destroy', 'active' => true]);

        $this->actingAs($this->getUser())
            ->visit('/admin/categories')
            ->see('Category Destroy')
            ->see('Delete');

        $this->actingAs($this->getUser())
            ->visit('/admin/categories/destroy/' . $category->id)
            ->seePageIs('/admin/categories')
            ->dontSee('Category Destroy');
    }
}