<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('referred_by')->nullable();
            $table->string('provider_id', 50)->nullable();
            $table->string('user_type')->default("customer");
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('verification_code')->nullable();
            $table->text('new_email_verificiation_code')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('device_token')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->string('address', 300)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->double('balance', 20,2)->defautlt(0.00);
            $table->tinyInteger('banned')->defautlt(0);
            $table->string('referral_code')->nullable();
            $table->integer('customer_package_id')->nullable();
            $table->integer('remaining_uploads')->default(0);
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
        Schema::dropIfExists('users');
    }
}
