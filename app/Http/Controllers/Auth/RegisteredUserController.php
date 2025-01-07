<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {

        
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|integer|exists:areas,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'area_id' => $request->input('address'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        // 新規登録後のリダイレクト先を /home に設定
        return redirect('/home');
    }
}
