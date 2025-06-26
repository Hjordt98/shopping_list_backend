<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoppingLists;
use Illuminate\Support\Facades\Log;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", ShoppingLists::class);

        $shoppingLists = auth()->user()->shoppingLists()->with('items')->get();
        return response()->json($shoppingLists);
    }

    /**
     * Store a newly created resource in storage.
     */             
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'string|max:255|required',
        ]);
    
        $this->authorize('create', ShoppingLists::class);

        // Create the shopping list for the authenticated user
        $list = $request->user()->shoppingLists()->create([
            'name'=>$validated['name'],
        ]);
        
        // Return the created list as JSOn with a 201 status (created)
        return response()->json($list, 201);
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
    public function update(Request $request, ShoppingLists $shoppingList)
    {
        $user = auth()->user();
        $isOwner = $user->id === $shoppingList->user_id;
        $isCollaborator = $shoppingList->collaborators()->where('users.id', $user->id)->exists();

        \Log::info('ShoppingListController@update authorization debug', [
            'user_id' => $user->id,
            'list_owner_id' => $shoppingList->user_id,
            'is_owner' => $isOwner,
            'is_collaborator' => $isCollaborator,
            'list_id' => $shoppingList->id,
            'list_name' => $shoppingList->name
        ]);

        $this->authorize('update', $shoppingList);

        //validate the request
        $validated = $request->validate([
            'name' => '',
        ]);

        // update the text
        $shoppingList->update([
            'name' => $validated['name'],
        ]);

        //Return the updated list
        return response()->json($shoppingList);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // find the list (don't restrict to user's lists yet)
        $shoppingList = ShoppingLists::findOrFail($id);

        $this->authorize('delete', $shoppingList);

        // delete the list
        $shoppingList->delete();
        
        // return a success message
        return response()->json(['message' => 'List deleted successfully']);
    }

    public function updateFavorite(Request $request, string $id)
    {
        // validate the request
        $validated = $request->validate([
            'favorite' => 'boolean',
        ]);

        $shoppingList = ShoppingLists::findOrFail($id);
        $this->authorize('update', $shoppingList);

        // update the favorite status
        $shoppingList->update([
            'is_favorite' => $validated['favorite'],
        ]);

        // return the updated list
        return response()->json($shoppingList);
    }


}
