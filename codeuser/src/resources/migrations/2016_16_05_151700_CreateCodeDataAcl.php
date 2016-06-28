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

        $permissionPublishPost = Permission::create([
            'name' => 'publish_post',
            'description' => 'Permission to publish posts that are in draft.'
        ]);

        $roleEditor->permissions()->save($permissionPublishPost);
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
