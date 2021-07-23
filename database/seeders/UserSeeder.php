<?php

namespace Database\Seeders;

use Faker\Guesser\Name;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mail::fake();
        DB::table('users')->insert([
            'name' => Name::class,
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => Name::class,
            'email' => 'test2@test.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => Name::class,
            'email' => 'test3@test.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => Name::class,
            'email' => 'test4@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
