<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodeCommentsTable
{
    public function up()
    {
        Schema::create('codepress_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->foreign('post_id')->references('id')->on('codepress_posts');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('codepress_comments');
    }
}