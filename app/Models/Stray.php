<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stray extends Model
{
    use HasFactory;

     // 変更可能なカラムを指定
     protected $fillable = ['body', 'address', 'image_at', 'status', 'name', 'date', 'sex', 'weight', 'height'];

     // リレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function pet_subcategory()
    {
        return $this->belongsTo(Pet_subcategory::class);
    }
}
