<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodePermissionsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codepress_permissions_roles', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('codepress_permissions');
            $table->integer('role_id')->unsigned();
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
        Schema::table('codepress_permissions_roles', function (Blueprint $table) {
            $table->dropForeign('codepress_permissions_roles_permission_id_foreign');
            $table->dropForeign('codepress_permissions_roles_role_id_foreign');
        });
        Schema::drop('codepress_permissions_roles');
    }
}
