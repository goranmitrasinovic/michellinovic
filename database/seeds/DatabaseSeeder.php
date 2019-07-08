<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompetitionsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ShoppingListsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EventsTableSeeder::class);

        // $users = factory(App\User::class,2)->create();
        // $events = factory(App\Event::class,2)->create();
        //
        // $users->first()->events()->sync($events);
    }
}
