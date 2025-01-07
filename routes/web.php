<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;


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

// ログイン済みユーザー専用ルート
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create_post'); // 投稿作成
    Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show_post'); // 投稿詳細

    // プロフィール
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

    // Shelters関連
    Route::get('/shelters', [App\Http\Controllers\ShelterController::class, 'index_shelter'])->name('shelters.index_shelter');
    Route::get('/shelters/{id}', [App\Http\Controllers\ShelterController::class, 'show_shelter'])->name('shelters.show_shelter');
    Route::get('/shelters/create', [App\Http\Controllers\ShelterController::class, 'create_shelter'])->name('shelters.create_shelter');
    Route::post('/shelters', [App\Http\Controllers\ShelterController::class, 'store_shelter'])->name('shelters.store_shelter');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//↓仮のやつなのであとで消します：AYAKA
// Route::get('/posts', function () { return view('/posts/index_post'); });
Route::get('/posts/create', function () { return view('/posts/create_post'); });
Route::get('/posts/edit', function () { return view('/posts/edit_post'); });
Route::get('/posts/show', function () { return view('/posts/show_post'); });

Route::get('/pets', function () { return view('/pets/create_pet'); });
Route::get('/pets/edit', function () { return view('pets/edit_pet'); });
Route::get('/pets/show', function () { return view('pets/show_pet'); });
Route::get('/pets/mypage', function () { return view('pets/mypage_pet'); });
Route::get('/pets/hidden', function () { return view('/pets/hidden_pet'); });

Route::get('/strays', function () { return view('/strays/index_stray'); });
Route::get('/strays/create', function () { return view('/strays/create_stray'); });
Route::get('/strays/edit', function () { return view('/strays/edit_stray'); });
Route::get('/strays/show', function () { return view('/strays/show_stray'); });

Route::get('/favorites', function () { return view('/favorites/index_favorite'); });
//↑ここまで！