<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateProgramStatusToStringValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First ensure the column is a string (it should already be according to previous migration but better be safe)
        Schema::table('programs', function (Blueprint $table) {
            $table->string('status', 20)->default('activated')->change();
        });

        // Update existing records
        DB::table('programs')->where('status', '1')->update(['status' => 'activated']);
        DB::table('programs')->where('status', '0')->update(['status' => 'inActived']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('programs')->where('status', 'activated')->update(['status' => '1']);
        DB::table('programs')->where('status', 'inActived')->update(['status' => '0']);
        DB::table('programs')->where('status', 'pending')->update(['status' => '0']);

        Schema::table('programs', function (Blueprint $table) {
            $table->string('status', 20)->default('1')->change();
        });
    }
}
