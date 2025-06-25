<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ShoppingLists;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingLists>
 */
class ShoppingListsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'Party List',
                'Daily Groceries List',
                'Parents Grocery List',
                'Weekend Shopping list',
                'Holiday Shopping List',
                'Monthly Groceries List',
                'Car Maintenance List',
                'Gift Shopping List',
                'School Supplies List',
                'Work Lunch List'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
