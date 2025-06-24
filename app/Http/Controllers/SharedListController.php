<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SharedLists;

class SharedListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
}
