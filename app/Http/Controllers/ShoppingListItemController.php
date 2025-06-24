<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingLists;
use App\Models\ShoppingListItems;

class ShoppingListItemController extends Controller
{
    /**
     * Display a listing of the items for a specific shopping list.
     */
    public function index(ShoppingLists $shoppingList)
    {
        // Ensure the list belongs to the authenticated user
        if ($shoppingList->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json($shoppingList->items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'shopping_list_id' => 'required|integer',
            'category_id' => 'required|integer',
            'is_favorite' => 'sometimes|boolean',
            'price_per_unit' => 'sometimes|numeric|min:0'
        ]);

        //create the item to the list
        $item = ShoppingListItems::create([
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'shopping_list_id' => $validated['shopping_list_id'],
            'category_id' => $validated['category_id'],
            'is_favorite' => $validated['is_favorite'],
            'price_per_unit' => $validated['price_per_unit']
        ]);

        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the item
        $item = ShoppingListItems::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Get the shopping list and verify ownership
        $shoppingList = ShoppingLists::find($item->shopping_list_id);
        if (!$shoppingList || $shoppingList->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate the request
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer|min:1',
            'is_checked' => 'sometimes|boolean',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'is_favorite' => 'sometimes|boolean',
            'price_per_unit' => 'sometimes|numeric|min:0'
        ]);

        // Update the item
        $item->update($validated);

        // Return the updated item
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ShoppingListItems::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $shoppingList = ShoppingLists::find($item->shopping_list_id);
        if (!$shoppingList || $shoppingList->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
