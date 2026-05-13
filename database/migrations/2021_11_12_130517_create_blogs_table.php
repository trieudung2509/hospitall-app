<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id");
            $table->string("title");
            $table->string("slug");
            $table->string("short_description")->nullable();
            $table->text('description', 3000)->nullable();
            $table->integer("banner")->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer("status")->default(0);
            $table->dateTime('published_date')->nullable();
            $table->dateTime('post_modified')->nullable();
            $table->string("meta_title")->nullable();
            $table->integer("meta_img")->nullable();
            $table->string("meta_description")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->timestamps();
            $table->softDeletes("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
