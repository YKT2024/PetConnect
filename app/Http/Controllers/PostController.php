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

    public function create()
    {
        return view('posts.create_post');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'introduce' => 'nullable|string|max:200', // 本文
            'photo-input' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 写真
        ]);

        // 画像の保存処理
        $imagePath = null;
        if ($request->hasFile('photo-input')) {
            $imagePath = $request->file('photo-input')->store('posts/img', 'public');
        }

        // 投稿情報の保存
        $posts = Post::create([
            'body' => $request->input('introduce'),
            'user_id' => Auth::id(),
            'image_at' => $imagePath
        ]);

        // リダイレクト先：
        return redirect('/pets/mypage');
    }
}