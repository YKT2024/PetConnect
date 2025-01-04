<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'image_at', 'image_path'];

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}