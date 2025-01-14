<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $areas = Area::all();

        return view('users.edit_user', compact('user', 'areas'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'accountname' => 'nullable|string|max:255', // ユーザー名
            'email' => 'nullable|string|email|max:255|unique:users', // メールアドレス
            'address' => 'nullable|exists:areas,id', // エリア
            'password' => 'nullable|string|min:8', // パスワード
        ]);
        $user = Auth::user();

        //情報更新
        $user->name = $request->accountname ? : $user->name;
        $user->email = $request->email ? : $user->email;
        $user->password = Hash::make($request->password);
        $user->area_id = $request->address ? : $user->area_id;

        //更新した情報をDBに保存
        $user -> save();
        
        //更新後、マイページにリダイレクト
        return redirect('pets.mypage');
    }
}
