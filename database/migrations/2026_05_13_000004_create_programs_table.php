<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('banner')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('max_participants')->nullable();
            $table->dateTime('reg_open_time')->nullable();
            $table->dateTime('reg_close_time')->nullable();
            $table->string('status', 20)->default('activated');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('org_id')->references('id')->on('organizations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
