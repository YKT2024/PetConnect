<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'area_id');
    }

    public function shelters()
    {
        return $this->hasMany(Shelter::class, 'area_id');
    }
}
