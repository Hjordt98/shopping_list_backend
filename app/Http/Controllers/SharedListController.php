<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SharedLists;
use App\Models\ShoppingLists;

class SharedListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sharedLists = SharedLists::with('shoppingList.user', 'shoppingList.items')
        ->where('collaborator_id', auth()->id())
        ->get();

        return response()->json($sharedLists, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addCollaborator(Request $request, string $listId)
    {
        // validate the request
        $validated = $request->validate([
        'collaborator_email' => 'required|string|email|max:100'
        ]);

        // find the list and check if it belongs to the user
        $shoppingList = auth()->user()->shoppingLists()->findOrFail($listId);

        // find the collaborator
        $collaborator = User::where('email', $validated['collaborator_email'])->first();

        // check if the collaborator exists
        if (!$collaborator) {
            return response()->json(['message' => 'Collaborator not found'], 404);
        }

        // check if the collaborator is already a collaborator of the list
        if ($shoppingList->collaborators->contains($collaborator)) {
            return response()->json(['message' => 'Collaborator already exists'], 400);
        }

        // create a new shared list
        $sharedList = SharedLists::create([
            'shopping_list_id' => $shoppingList->id,
            'collaborator_id' => $collaborator->id,
        ]);

        return response()->json(['message' => 'Collaborator added successfully'], 200);
    }

    public function getCollaborators(string $listId)
    {
        $shoppingList = auth()->user()->shoppingLists()->findOrFail($listId);

        $collaborators = $shoppingList->collaborators;

        return response()->json($collaborators, 200);
    }

    public function removeCollaborator(Request $request, string $listId)
    {
        $validated = $request->validate([
            'collaborator_email' => 'required|string|email|max:100'
        ]);

        $shoppingList = auth()->user()->shoppingLists()->findOrFail($listId);

        $collaborator = User::where('email', $validated['collaborator_email'])->first();

        if (!$collaborator) {
            return response()->json(['message' => 'collaborator not found'], 404);
        }

        $sharedList = SharedLists::where('shopping_list_id', $shoppingList->id)->where('collaborator_id', $collaborator->id)->first();

        if (!$sharedList) {
            return response()->json(['message' => 'collaborator not found on this list'], 404);           
        }

        $sharedList->delete();

        return response()->json(['message' => 'collaborator removed successfully'], 200);
    }

    public function sharedWithMe()
    {
        $sharedLists = SharedLists::with('shoppingList.user', 'shoppingList.items')
        ->where('collaborator_id', auth()->id())
        ->get();

        return response()->json($sharedLists, 200);
    }

    public function sharedByMe() {
        $lists = ShoppingLists::with('collaborators')
        ->where('user_id', auth()->id())
        ->has('collaborators')
        ->get();

        return response()->json($lists, 200);
    }
}
