<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 認証機能（ログイン・新規登録）
Auth::routes();

// ログイン済みユーザー用ルート（会員）
Route::middleware('auth')->group(function () {
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts'); // 投稿一覧
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile'); // プロフィール
});

// ビジター用ルート（未ログイン）
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index'); // ビジター用投稿一覧
Route::get('/', function () {
    return view('auth.login'); // ログインページ
});