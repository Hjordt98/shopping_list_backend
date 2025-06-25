<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            UserSeeder::class,
        ]);

        // 2. Development data (using factories)
        $this->call([
            ShoppingListSeeder::class,
            ShoppingListItemsSeeder::class,
        ]);
    }
}
