<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodeUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codepress_users_roles', function (Blueprint $table) {
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('codepress_users');
            $table->integer('role_id');
            $table->foreign('role_id')->references('id')->on('codepress_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('codepress_users_roles');
    }
}
