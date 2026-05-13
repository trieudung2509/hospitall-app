<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
           'user_type'     => 'admin',
           'name'    => 'admin',
           'email'    => 'admin@example.com',
           'email_verified_at'    => date('Y-m-d H:i:s'),
           'password'    => Hash::make('123456'),
        ]);
        DB::table('languages')->insert([
            'name'    => 'English',
            'code'    => 'en',
            'rtl'    => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

        \App\Blog::factory()->count(800)->create();
    }
}
