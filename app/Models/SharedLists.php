<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SharedLists extends Model
{
    use HasFactory;
    protected $fillable = ['shopping_list_id', 'owner_id', 'collaborator_id'];



    
}
