<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSofDeletesToCodeCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('codepress_comments', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('codepress_comments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
