<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingLists extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ShoppingListItems::class, 'shopping_list_id');
    }
}
