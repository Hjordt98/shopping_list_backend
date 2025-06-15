<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\ShoppingListItemController;


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/shopping-lists', [ShoppingListController::class, 'index']);

    Route::post('/shopping-lists', [ShoppingListController::class,'store']);

    Route::patch('/shopping-lists/{shoppingList}', [ShoppingListController::class, 'update']);

    Route::delete('/shopping-lists/{id}', [ShoppingListController::class, 'destroy']);

    Route::get('/shopping-lists/{shoppingList}/items', [ShoppingListItemController::class, 'index']);

    Route::delete('/shopping-list-items/{id}', [ShoppingListItemController::class, 'destroy']);

    Route::patch('/shopping-list-items/{id}', [ShoppingListItemController::class, 'update']);
});
