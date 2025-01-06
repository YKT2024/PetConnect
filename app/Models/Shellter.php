<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shellter extends Model
{
    use HasFactory;

    // 変更可能なカラムを指定
    protected $fillable = ['body', 'address', 'image_at', 'shelter_name', 'shelter_contact', 'evacuation_type'];

    // リレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
