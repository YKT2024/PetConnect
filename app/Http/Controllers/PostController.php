<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // 投稿一覧（全ユーザー共通で同じ投稿を取得）
        $posts = Post::all();

        return view('posts.index_post', compact('posts'));
    }
}