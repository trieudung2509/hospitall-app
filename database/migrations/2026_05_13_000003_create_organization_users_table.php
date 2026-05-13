<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationUsersTable extends Migration
{
    public function up()
    {
        Schema::create('organization_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('org_id');
            $table->boolean('status')->default(1);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('org_id')->references('id')->on('organizations');
            $table->unique(['user_id', 'org_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_users');
    }
}
