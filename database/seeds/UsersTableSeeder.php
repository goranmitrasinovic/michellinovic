<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Goran Mitrasinovic',
            'email' => 'goran.mitrasinovic@dynabyte.se',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Michelle Anton',
            'email' => 'michelle.anton.swe@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
