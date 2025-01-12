<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Http\Controllers\StrayController;

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

// ログイン済みユーザー専用ルート   ---@guestと@authを使うからいらなそう
// Route::middleware('auth')->group(function () {   ---@guestと@authを使うからいらなそう
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create_post'); // 新規投稿作成フォーム
    Route::post('posts/create', [App\Http\Controllers\PostController::class, 'store'])->name('create_post.store'); // 新規投稿作成

    Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show_post'); // 投稿詳細

    // プロフィール
    // Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

    // Shelters関連
    // Route::get('/shelters', [App\Http\Controllers\ShelterController::class, 'index_shelter'])->name('shelters.index_shelter');
    // Route::get('/shelters/{id}', [App\Http\Controllers\ShelterController::class, 'show_shelter'])->name('shelters.show_shelter');
    // Route::get('/shelters/create', [App\Http\Controllers\ShelterController::class, 'create_shelter'])->name('shelters.create_shelter');
    // Route::post('/shelters', [App\Http\Controllers\ShelterController::class, 'store_shelter'])->name('shelters.store_shelter');
// });   ---@guestと@authを使うからいらなそう

// Auth::routes();

// Pets関連
Route::get('/pets/create', [App\Http\Controllers\PetController::class, 'show_create_pet'])->name('create_pet.show'); //ペット新規登録フォーム
Route::post('/pets/create', [App\Http\Controllers\PetController::class, 'store_create_pet'])->name('create_pet.store'); //ペット新規登録
Route::get('/pets/{id}/edit', [App\Http\Controllers\PetController::class, 'edit'])->name('pets.edit'); //ペット情報変更フォーム
Route::put('/pets/{id}', [App\Http\Controllers\PetController::class, 'update'])->name('pets.update'); //ペット情報変更
Route::delete('/pets/{id}', [App\Http\Controllers\PetController::class, 'destroy'])->name('pets.destroy'); //ペット情報削除
Route::get('/api/subcategories/{category}', [App\Http\Controllers\PetController::class, 'getSubcategories'])->name('getSubcategories'); //いい感じのプルダウンにするためのルート

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Strays関連
Route::get('/strays', [StrayController::class, 'index'])->name('strays.index'); // 一覧表示ページ(仮)
Route::get('/strays/create', [StrayController::class, 'create'])->name('strays.create'); // 迷子新規登録フォーム
Route::get('/strays/show', [App\Http\Controllers\StrayController::class, 'show'])->name('strays.show');  //新規登録表示
Route::post('/strays', [StrayController::class, 'store'])->name('strays.store'); // データを保存するルート

Route::get('/strays/{id}/edit', [StrayController::class, 'edit'])->name('strays.edit'); // 編集ページ表示
Route::put('/strays/{id}', [StrayController::class, 'update'])->name('strays.update'); // 更新処理
Route::delete('/strays/{id}', [StrayController::class, 'destroy'])->name('strays.destroy');

//↓仮のやつなのであとで消します：AYAKA
// Route::get('/posts', function () { return view('/posts/index_post'); });
// Route::get('/posts/create', function () { return view('/posts/create_post'); });
Route::get('/posts/edit', function () { return view('/posts/edit_post'); });
Route::get('/posts/show', function () { return view('/posts/show_post'); });

// Route::get('/pets', function () { return view('/pets/create_pet'); });
// Route::get('/pets/edit', function () { return view('pets/edit_pet'); });
Route::get('/pets/show', function () { return view('pets/show_pet'); });
Route::get('/pets/mypage', function () { return view('pets/mypage_pet'); });
Route::get('/pets/hidden', function () { return view('/pets/hidden_pet'); });

Route::get('/favorites', function () { return view('/favorites/index_favorite'); });

Route::get('/mypage', function () { return view('/pets/mypage_pet'); });
// ↑これはなおp
//↑ここまで！
