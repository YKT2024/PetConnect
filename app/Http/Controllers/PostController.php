<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Pet;
use App\Models\Favorite;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // 検索キーワードを取得
        $search = $request->input('search');

        // 投稿クエリの初期化
        $query = Post::query();

        // 検索条件を適用
        if ($search) {
            $query->where('body', 'LIKE', '%' . $search . '%'); // 本文の部分一致検索
        }

        // 投稿を取得
        $posts = $query->orderBy('created_at', 'desc')->get();

        // お気に入りの投稿を取得
        $userId = Auth::id();
        $favoritePosts = Favorite::where('user_id', $userId)->pluck('post_id');
        $favposts = Post::whereIn('id', $favoritePosts)->get();

        // ビューにデータを渡す
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
        if ($request->hasFile('photo-input')) {
            $imagePath = $request->file('photo-input')->store('posts/img', 'public');
            $post->image_at = $imagePath;
        }

        //更新したpost情報をDBに保存
        $post->save();

        //更新後、マイページにリダイレクト
        return redirect('/pets/mypage');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect('/pets/mypage');
    }

    public function show($id)
    {
        // dd($id);
        $post = Post::with('user.pet')->find($id);

        if (!$post) {
            abort(404, 'Post not found.');
        }

        // コメントを取得
        $comments = $post->comments()->with('user')->get();

        // ユーザーのアイコンを取得
        $userId = Post::where('id', $id)->pluck('user_id');
        $icon = Pet::where('user_id', $userId)->value('image_at');    

        return view('posts.show_post', ['post' => $post, 'icon' => $icon, 'comments' => $comments]);
    }
}