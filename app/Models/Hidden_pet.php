<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hidden_pet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pet_subcategory_id'];

}
