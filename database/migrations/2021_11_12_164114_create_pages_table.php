<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->string("title")->nullable();
            $table->string("slug")->nullable();
            $table->longText("content")->nullable();
            $table->text("meta_title")->nullable();
            $table->string("meta_description")->nullable();
            $table->string("keywords")->nullable();
            $table->string("meta_image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
