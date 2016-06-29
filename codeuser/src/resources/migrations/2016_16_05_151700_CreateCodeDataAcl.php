<?php

use CodePress\CodeUser\Models\Permission;
use CodePress\CodeUser\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreateCodeDataAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::create(['name' => Role::ROLE_ADMIN]);
        $roleEditor = Role::create(['name' => Role::ROLE_EDITOR]);
        $roleRedactor = Role::create(['name' => Role::ROLE_REDACTOR]);

        $permissionAccessUsers = Permission::create([
            'name' => 'access_users',
            'description' => 'Permission to access the area users.'
        ]);

        $permissionAccessRoles = Permission::create([
            'name' => 'access_roles',
            'description' => 'Permission to access the area roles.'
        ]);

        $permissionAccessPermissions = Permission::create([
            'name' => 'access_permissions',
            'description' => 'Permission to access the area permissions.'
        ]);

        $permissionAccessCategories = Permission::create([
            'name' => 'access_categories',
            'description' => 'Permission to access the area categories.'
        ]);

        $permissionAccessTags = Permission::create([
            'name' => 'access_tags',
            'description' => 'Permission to access the area tags.'
        ]);

        $permissionAccessPosts = Permission::create([
            'name' => 'access_posts',
            'description' => 'Permission to access the area posts.'
        ]);

        $permissionPublishPost = Permission::create([
            'name' => 'publish_post',
            'description' => 'Permission to publish posts that are in draft.'
        ]);

        $roleAdmin->permissions()->save($permissionAccessUsers);
        $roleAdmin->permissions()->save($permissionAccessRoles);
        $roleAdmin->permissions()->save($permissionAccessPermissions);
        $roleAdmin->permissions()->save($permissionAccessCategories);
        $roleAdmin->permissions()->save($permissionAccessTags);
        $roleAdmin->permissions()->save($permissionAccessPosts);
        $roleAdmin->permissions()->save($permissionPublishPost);

        $roleEditor->permissions()->save($permissionAccessPosts);
        $roleEditor->permissions()->save($permissionPublishPost);

        $roleRedactor->permissions()->save($permissionAccessPosts);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //...
    }
}
