<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Competition;
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
        // $users = factory(App\User::class, 5)->create();
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
        // $users = factory(App\User::class,5)->create();

    }
}
