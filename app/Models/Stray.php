<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stray extends Model
{
    use HasFactory;

     // 変更可能なカラムを指定
    //  protected $fillable = ['body', 'address', 'image_at', 'status', 'name', 'date', 'sex', 'weight', 'height'];
    protected $fillable = [
        'status',         // 探しています or 見かけました
        'name',    // ペットの名前
        'area_id',  // エリア
        'address',        // エリア詳細
        'date',           // 日付
        'pet_subcategory_id', // ペットカテゴリID
        'sex',            // 性別
        'age',            // 年齢
        'weight',         // 体重
        'height',         // 体長
        'body',           // 備考
    ];


     // リレーションを設定
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function area()
    // {
    //     return $this->belongsTo(Area::class);
    // }

    // public function pet_subcategory()
    // {
    //     return $this->belongsTo(Pet_subcategory::class);
    // }

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
