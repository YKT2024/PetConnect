<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // 変更可能なカラムを指定
    protected $fillable = ['name', 'pet_breed', 'birth_year', 'birth_month', 'sex', 'color', 'pick_up_date', 'image_at'];

    // リレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet_category()
    {
        return $this->belongsTo(Pet_category::class);
    }

    public function pet_subcategory()
    {
        return $this->belongsTo(Pet_subcategory::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
