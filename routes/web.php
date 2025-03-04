<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Http\Controllers\StrayController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\CommentController;

//== Ayakaさん！、以下のルートはログインするための仮です == //

// GETルート（ログインフォーム表示用）
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// POSTルート（ログイン処理用）
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login');

// ログイン後のホームページ
Route::get('/home', function () {
    return view('home'); // ホームページのビュー
})->name('home');

// 認証機能（ログイン・新規登録）
Auth::routes(['register' => false, 'login' => false]); // デフォルトルートを無効化

// カスタムログイン・新規登録ルート
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register');

// 新規登録用のGETルート
Route::get('/register', function () {
    $areas = Area::all();
    return view('auth.register_auth', compact('areas')); // register.blade.phpを表示
})->name('register');

// 投稿一覧（全ユーザー共通）
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index_post');

// ビジター用ルート（未ログイン）
Route::get('/', function () {
    return view('auth.login_auth'); // ログインページ
});

Route::get('/users/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');

// ログイン済みユーザー専用ルート   ---@guestと@authを使うからいらなそう
// Route::middleware('auth')->group(function () {   ---@guestと@authを使うからいらなそう

// posts関連
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create_post'); // 新規投稿作成フォーム
Route::post('posts/create', [App\Http\Controllers\PostController::class, 'store'])->name('create_post.store'); // 新規投稿作成
Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show_post'); // 投稿詳細
Route::get('/posts/{id}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit'); // 投稿編集フォーム
Route::put('/posts/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update'); // 投稿編集
Route::delete('/posts/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy'); // 投稿削除
Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show'); //投稿詳細
Route::post('/posts/{id}/comments', [CommentController::class, 'storeForPost'])->name('posts.comments.store'); //コメント用

    // プロフィール
    // Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

// Shelters関連
    Route::get('/shelters', [ShelterController::class, 'index'])->name('shelters.index'); //投稿一覧表示
    Route::get('/shelters/create', [App\Http\Controllers\ShelterController::class, 'create_shelter'])->name('shelters.create'); //避難所新規登録フォーム
    Route::get('/shelters/{id}', [ShelterController::class, 'show'])->name('shelters.show'); // 詳細を表示
    Route::get('/shelters/{id}/edit', [ShelterController::class, 'edit'])->name('shelters.edit'); //編集ページ表示
    Route::put('/shelters/{id}', [ShelterController::class, 'update'])->name('shelters.update'); // 更新処理
    Route::post('/shelters', [App\Http\Controllers\ShelterController::class, 'store_shelter'])->name('shelters.store'); //避難所新規登録
    Route::post('/shelters/{id}/comments', [CommentController::class, 'storeForShelter'])->name('shelters.comments.store'); //コメント用
    Route::delete('/shelters/{id}', [ShelterController::class, 'destroy'])->name('shelters.destroy');

// Pets関連
Route::get('/pets/create', [App\Http\Controllers\PetController::class, 'show_create_pet'])->name('create_pet.show'); //ペット新規登録フォーム
Route::post('/pets/create', [App\Http\Controllers\PetController::class, 'store_create_pet'])->name('create_pet.store'); //ペット新規登録
Route::get('/pets/{id}/edit', [App\Http\Controllers\PetController::class, 'edit'])->name('pets.edit'); //ペット情報変更フォーム
Route::put('/pets/{id}/update', [App\Http\Controllers\PetController::class, 'update'])->name('pets.update'); //ペット情報変更
Route::delete('/pets/{id}', [App\Http\Controllers\PetController::class, 'destroy'])->name('pets.destroy'); //ペット情報削除
Route::get('/api/subcategories/{category}', [App\Http\Controllers\PetController::class, 'getSubcategories'])->name('getSubcategories'); //いい感じのプルダウンにするためのルート
Route::get('/pets/mypage', [App\Http\Controllers\PetController::class, 'showMypage'])->name('pets.mypage'); //マイページ
Route::get('/pets/hidden', [App\Http\Controllers\PetController::class, 'show_hidden_pet'])->name('hidden_pet.show'); //苦手ペット新規登録フォーム
Route::post('/pets/hidden', [App\Http\Controllers\PetController::class, 'store_hidden_pet'])->name('hidden_pet.store'); //苦手ペット新規登録

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Strays関連
    Route::get('/strays', [StrayController::class, 'index'])->name('strays.index'); // 一覧表示ページ
    Route::get('/strays/create', [StrayController::class, 'create'])->name('strays.create'); // 迷子新規登録フォーム
    Route::get('/strays/show', [App\Http\Controllers\StrayController::class, 'showCreate'])->name('strays.showCreate'); // 新規登録表示
    Route::post('/strays', [StrayController::class, 'store'])->name('strays.store'); // データを保存するルート
    Route::get('/strays/{id}/edit', [StrayController::class, 'edit'])->name('strays.edit'); // 編集ページ表示
    Route::put('/strays/{id}', [StrayController::class, 'update'])->name('strays.update'); // 更新処理
    Route::delete('/strays/{id}', [StrayController::class, 'destroy'])->name('strays.destroy');
    Route::get('/strays/{id}', [StrayController::class, 'show'])->name('strays.show'); // 詳細を表示
    Route::post('/strays/{id}/comments', [CommentController::class, 'storeForStray'])->name('strays.comments.store'); //コメント用

// ブックマークに使う関連
Route::post('/posts/{post}/favorite', [App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/posts/{post}/favorite', [App\Http\Controllers\FavoriteController::class, 'destroy'])->name('favorites.destroy');

// かわいいねに使う関連
Route::post('/posts/{post}/like', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
Route::delete('/posts/{post}/like', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy');

// コメント削除用
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


//↓仮のやつなのであとで消します：AYAKA
// Route::get('/pets/show', function () { return view('pets/show_pet'); });
// Route::get('/pets/hidden', function () { return view('/pets/hidden_pet'); });

// Route::get('/shelters', function () { return view('/shelters/index_shelter'); });
Route::get('/strays/show', function () { return view('/strays/show_stray'); });
// ↑これはなおp
//↑ここまで！


///  1/12にCanaが作りました↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
Route::get('/shelters/edit', function () { return view('/shelters/edit_shelter'); });
// 邪魔なら消してください↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
//  1/12にCanaが作りました↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
Route::get('/shelters/show', function () { return view('/shelters/show_shelter'); });
// 邪魔なら消してください↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
