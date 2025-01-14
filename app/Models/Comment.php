<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // フォームから受け取るデータを指定
    protected $fillable = ['body', 'user_id', 'post_id', 'shelter_id', 'stray_id'];

    // リレーションを設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function stray()
    {
        return $this->belongsTo(Stray::class);
    }
}
