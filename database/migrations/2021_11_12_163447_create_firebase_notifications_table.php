<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirebaseNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firebase_notifications', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->text("text")->nullable();
            $table->string("item_type")->nullable();
            $table->integer("item_type_id");
            $table->integer("receiver_id");
            $table->tinyInteger("is_read");
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
        Schema::dropIfExists('firebase_notifications');
    }
}
