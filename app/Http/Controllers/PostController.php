<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    // 投稿一覧を表示する
    public function index()
    {
        if (Auth::check()) {
            // ログイン済みユーザー
            $posts = Post::all(); // 全ての投稿を取得
            return view('posts.index', compact('posts'));
        }

        // ビジター（未ログインユーザー）
        $posts = Post::where('category', 'pet_showcase')->get(); // 「ペット自慢」カテゴリーのみ取得
        return view('posts.index', compact('posts'));
    }
}
