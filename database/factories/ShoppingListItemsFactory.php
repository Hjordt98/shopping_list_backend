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
                'Shampoo',
                'Toilet Paper', 
                'Hand Sanitizer',
                'Disinfectant Spray',
                'Bleach',
                'Vinegar',
                'Baking Soda',
                'Baking Powder',
                'Cereal',
                'Yogurt',
                'Orange Juice',
                'Apple Juice',
                'Grapes',
                'Strawberries',
                'Blueberries',
                'Pineapple',
                'Mango',
                'Kiwi',
                'Watermelon',
                'Cantaloupe',
                'Peaches',
                'Pears',
                'Nectarines',
                'Tomatoes',
                'Carrots',
                'Potatoes',
                'Onions',
                'Garlic',
                'Lettuce',
                'Cucumber',
                'Bell Peppers',
                'Broccoli',
                'Spinach',
                'Green Beans',
                'Corn',
                'Paper Towels',
                'Dish Soap',
                'Laundry Detergent'
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
