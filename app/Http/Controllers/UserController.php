<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        $user = Auth::user();
        $request->validate([
            'accountname' => 'nullable|string|max:255', // ユーザー名
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id, // メールアドレス
            'address' => 'nullable|exists:areas,id', // エリア
            'password' => 'nullable|string|min:8', // パスワード
        ]);

        if ($request->filled('accountname')) {
            $user->name = $request->accountname;
        }
    
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
    
        if ($request->filled('address')) {
            $user->area_id = $request->address;
        }
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        //更新した情報をDBに保存
        $user->save();
        
        //更新後、苦手ペット登録ページにリダイレクト
        return redirect()->route('hidden_pet.show');
    }
}
