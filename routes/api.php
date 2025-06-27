<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\ShoppingListItemController;    
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SharedListController;

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

    Route::post('/shopping-list-items', [ShoppingListItemController::class, 'store']);

    Route::patch('/shopping-lists/{id}/favorite', [ShoppingListController::class, 'updateFavorite']);

    Route::get('/categories', [CategoriesController::class, 'index']);

    Route::post('/shared-lists/add-collaborator/{listId}', [SharedListController::class, 'addCollaborator']);

    Route::get('/shopping-lists/{listId}/collaborators', [SharedListController::class, 'getCollaborators']);

    Route::delete('/shared-lists/remove-collaborator/{listId}', [SharedListController::class, 'removeCollaborator'])->name('remove-collaborator');

    Route::get('/shared-lists/shared-with-me', [SharedListController::class, 'sharedWithMe']);

    Route::get('/shared-lists/shared-by-me', [SharedListController::class, 'sharedByMe']);

    Route::get('/shared-lists/collaborators', [SharedListController::class, 'getCollaboratorsForAllLists']);

});


