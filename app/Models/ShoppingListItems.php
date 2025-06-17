<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingListItems extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'quantity', 'is_checked', 'shopping_list_id', 'category'];

    public function shoppingList()
    {
        return $this->belongsTo(ShoppingLists::class);
    }

    protected static function booted()
    {
        static::saved(function ($item) {
            $item->shoppingList->touch();
        });

        static::deleted(function ($item) {
            $item->shoppingList->touch();
        });
    }
}
