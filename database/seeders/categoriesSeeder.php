<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'fruits & vegetables',
            'dairy',
            'drinks',
            'cleaning',
            'household',
            'pets',
            'personal care',
            'health',
            'baby',
            'meat',
            'bakery',
            'frozen',
            'alcohol',
            'other',
        ];

        foreach ($categories as $category) {
            Categories::create(['name' => $category]);
        }
    }
}
