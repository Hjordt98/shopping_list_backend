<?php

namespace Database\Seeders;

use App\Models\ShoppingLists;
use App\Models\ShoppingListItems;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoppingListItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shoppingLists = ShoppingLists::all();

        foreach($shoppingLists as $shoppingList) {
            ShoppingListItems::factory(5)->create([
                'shopping_list_id' => $shoppingList->id,
            ]);
        }
    }
}
