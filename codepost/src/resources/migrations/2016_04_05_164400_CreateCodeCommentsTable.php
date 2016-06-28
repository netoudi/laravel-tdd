<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodeCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('codepress_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('codepress_posts')->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('codepress_comments', function (Blueprint $table) {
            $table->dropForeign('codepress_comments_post_id_foreign');
        });
        Schema::drop('codepress_comments');
    }
}
