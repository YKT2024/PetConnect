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

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')
                ->withTimestamps();
    }

    public function favoritedBy()
    {
    return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')
                ->withTimestamps();
    }

    public function likedBy()
    {
    return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')
                ->withTimestamps();
    }

}