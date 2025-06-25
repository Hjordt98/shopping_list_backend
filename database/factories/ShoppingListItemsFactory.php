<?php

namespace Database\Factories;

use App\Models\ShoppingLists;
use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingListItems>
 */
class ShoppingListItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shopping_list_id' => ShoppingLists::factory(),
            'name' => fake()->randomElement([
                'Milk',
                'Bread',
                'Eggs',
                'Cheese',
                'Butter',
                'Chicken',
                'Apples',
                'Bananas',
                'Rice',
                'Pasta',
                'Soap',
                'Shampoo'
            ]),
            'quantity' => fake()->numberBetween(1, 10),
            'category_id' => fake()->numberBetween(1, 14),
            'price_per_unit' => fake()->randomFloat(2, 0.1, 100),
            'is_favorite' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
