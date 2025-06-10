<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingListItems extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'quantity', 'is_checked', 'shopping_list_id'];

    public function shoppingList()
    {
        return $this->belongsTo(ShoppingLists::class);
    }
}
