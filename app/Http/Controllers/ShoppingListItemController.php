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
        $this->authorize('view', $shoppingList);
    
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

        // Check if the user can add items to this list
        $shoppingList = ShoppingLists::find($validated['shopping_list_id']);
        if (!$shoppingList) {
            return response()->json(['error' => 'Shopping list not found'], 404);
        }

        // check if the user can add items to this list
        $this->authorize('update', $shoppingList);

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
        $item = ShoppingListItems::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $shoppingList = ShoppingLists::find($item->shopping_list_id);
        if (!$shoppingList) {
            return response()->json(['error' => 'Shopping list not found'], 404);
        }

        $user = auth()->user();
        $isOwner = $user->id === $shoppingList->user_id;
        $isCollaborator = $shoppingList->collaborators()->where('users.id', $user->id)->exists();

        \Log::info('ShoppingListItemController@update authorization debug', [
            'user_id' => $user->id,
            'list_owner_id' => $shoppingList->user_id,
            'is_owner' => $isOwner,
            'is_collaborator' => $isCollaborator,
            'list_id' => $shoppingList->id,
            'list_name' => $shoppingList->name
        ]);

        $this->authorize('update', $shoppingList);

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
        if (!$shoppingList) {
            return response()->json(['error' => 'Shopping list not found'], 404);
        }

        // check if the user can delete the item
        $this->authorize('update', $shoppingList);

        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
