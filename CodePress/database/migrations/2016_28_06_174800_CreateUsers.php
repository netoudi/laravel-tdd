<?php

use CodePress\CodeUser\Models\Role;
use CodePress\CodeUser\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::where('name', Role::ROLE_ADMIN)->first();

        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@codepress.com',
            'password' => bcrypt(123456),
        ]);

        $admin->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
