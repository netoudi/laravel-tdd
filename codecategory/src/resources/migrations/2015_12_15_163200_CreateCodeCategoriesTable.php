<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodeCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('codepress_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable(true)->unsigned();
            $table->foreign('parent_id')->references('id')->on('codepress_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->boolean('active')->default(false);
            $table->integer('categorizable_id')->nullable();
            $table->string('categorizable_type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('codepress_categories', function (Blueprint $table) {
            $table->dropForeign('codepress_categories_parent_id_foreign');
        });
        Schema::drop('codepress_categories');
    }
}
