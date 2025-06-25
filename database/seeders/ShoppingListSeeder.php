<?php

namespace Database\Seeders;

use App\Models\ShoppingLists;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoppingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Uses factory to generate random data
            ShoppingLists::factory(5)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
