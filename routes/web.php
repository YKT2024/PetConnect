<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.register_auth'); // register.blade.phpを表示
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
