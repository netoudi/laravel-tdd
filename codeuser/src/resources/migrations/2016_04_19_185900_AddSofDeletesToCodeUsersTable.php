<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSofDeletesToCodeUsersTable
{
    public function up()
    {
        Schema::table('codepress_users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('codepress_users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
