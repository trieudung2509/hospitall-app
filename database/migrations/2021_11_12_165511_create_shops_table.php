<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("name")->nullable();
            $table->string("logo")->nullable();
            $table->longText("sliders")->nullable();
            $table->string("phone")->nullable();
            $table->string("address", 500)->nullable();
            $table->string("facebook")->nullable();
            $table->string("google")->nullable();
            $table->string("twitter")->nullable();
            $table->string("youtube")->nullable();
            $table->string("slug")->nullable();
            $table->string("meta_title")->nullable();
            $table->text("meta_description")->nullable();
            $table->text("pick_up_point_id")->nullable();
            $table->text("shipping_cost")->nullable();
            $table->float("delivery_pickup_latitude")->nullable();
            $table->float("delivery_pickup_longitude")->nullable();
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
        Schema::dropIfExists('shops');
    }
}
