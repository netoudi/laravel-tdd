<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSofDeletesToCodeTagsTable
{
    public function up()
    {
        Schema::table('codepress_tags', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('codepress_tags', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}