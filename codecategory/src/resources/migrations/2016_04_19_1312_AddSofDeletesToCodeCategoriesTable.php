<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSofDeletesToCodeCategoriesTable
{
    public function up()
    {
        Schema::table('codepress_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('codepress_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}