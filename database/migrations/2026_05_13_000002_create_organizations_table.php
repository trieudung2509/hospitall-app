<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_name');
            $table->string('org_type')->nullable();
            $table->boolean('status')->default(1);
            $table->string('contact_person')->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->string('contact_email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
