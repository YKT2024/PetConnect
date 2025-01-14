<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;

    // 変更可能なカラムを指定
    protected $fillable = [
        'user_id', 
        'body', 
        'address', 
        'area_id', 
        'image_at', 
        'shelter_name', 
        'shelter_contact', 
        'evacuation_type'
    ];

    // リレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function pet_subcategory()
    {
        return $this->belongsTo(PetSubcategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
