<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SharedLists extends Model
{
    use HasFactory;
    protected $fillable = ['shopping_list_id', 'collaborator_id'];


    public function shoppingList()
    {
        return $this->belongsTo(ShoppingLists::class, 'shopping_list_id');
    }

    public function collaborator()
    {
        return $this->belongsTo(User::class, 'collaborator_id');
    }
}
