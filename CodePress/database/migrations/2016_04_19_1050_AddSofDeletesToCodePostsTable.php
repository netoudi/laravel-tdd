<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSofDeletesToCodePostsTable
{
    public function up()
    {
        Schema::table('codepress_posts', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('codepress_posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}