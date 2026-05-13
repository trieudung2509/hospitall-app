<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('donation_records', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('program_id');
            $table->enum('status', ['Registered', 'Completed', 'Canceled'])->default('Registered');
            $table->timestamp('registration_time')->useCurrent();
            $table->dateTime('check_in_time')->nullable();
            $table->string('blood_type_verified')->nullable();
            $table->integer('blood_volume')->nullable();
            $table->text('health_status')->nullable();
            $table->text('failure_reason')->nullable();
            $table->text('notes')->nullable();
            $table->string('EmailConfirm')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('program_id')->references('id')->on('programs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donation_records');
    }
}
