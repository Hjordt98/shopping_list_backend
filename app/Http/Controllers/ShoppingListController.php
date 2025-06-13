<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoppingLists;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingLists = auth()->user()->shoppingLists()->get();
        return response()->json($shoppingLists);
    }

    /**
     * Store a newly created resource in storage.
     */             
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => '',
        ]);

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
}
