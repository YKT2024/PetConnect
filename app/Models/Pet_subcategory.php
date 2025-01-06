<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet_subcategory extends Model
{
    use HasFactory;

    public function pet_category()
    {
        return $this->belongsTo(Pet_category::class);
    }
}
