<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Favorite;

class PostController extends Controller
{
    public function index()
    {
        // 投稿一覧（全ユーザー共通で同じ投稿を取得）
        $posts = Post::orderBy('created_at', 'desc')->get();

        // お気に入りした投稿を取得
        $userId = Auth::id();
        $favoritePosts = Favorite::where('user_id', $userId)->pluck('post_id');
        $favposts = Post::whereIn('id', $favoritePosts)->get();

        return view('posts.index_post', compact('posts', 'favposts'));
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

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit_post', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'introduce' => 'nullable|string|max:200', //本文
            'photo-input' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', //写真
        ]);

        //指定したIDの情報をDBから取得
        $post = Post::findOrFail($id);

        //情報更新
        $post->body = $request->introduce;

        //画像ファイルのアップロード
        $imagePath = null;
        if($request->hasFile('photo-input')) {
            $imagePath = $request->file('photo-input')->store('posts/img', 'public');
            $post->image_at = $imagePath;
        }

        //更新したpost情報をDBに保存
        $post->save();

        //更新後、マイページにリダイレクト
        return redirect('/pets/mypage');
    }

    function destroy($id)
    {
        $post = Post::find($id);

        $post -> delete();

        return redirect('/pets/mypage');
    }

    function show($id)
    {
        // dd($id);
        $post = Post::with('user.pet')->find($id);

        if (!$post) {
            abort(404, 'Post not found.');
        }

        // ユーザーのアイコンを取得
        $icon = $post->user->pet ? 'pets/img/' . $post->user->pet->image_at : null;
        
        return view('posts.show_post', ['post'=>$post, 'icon'=>$icon]);
    }
}