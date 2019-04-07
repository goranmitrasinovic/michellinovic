<?php

use Illuminate\Database\Seeder;

class ShoppingListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoppingLists = factory(\App\ShoppingList::class, 1)->create([
            'product_id' => $this->getRandomProductId()
        ]);
    }

    private function getRandomProductId() {
        $product = \App\Product::inRandomOrder()->first();
        return $product->id;
    }
}
