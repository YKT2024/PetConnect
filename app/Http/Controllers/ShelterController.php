<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shelter;

class ShelterController extends Controller
{
    public function index()
    {
        // 投稿一覧（全ユーザー共通で同じ投稿を取得）
        $shelters = Shelter::with('area')->get();

        return view('shelters.index_shelter', compact('shelters'));
    }

    public function create_shelter()
    {
        $areas = Area::all();

        return view('shelters.create_shelter', compact('areas'));
    }

    public function store_shelter(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'introduce' => 'nullable|string|max:200', // 本文
            'address' => 'nullable|string|max:200', //住所詳細
            'area_id' => 'required|integer|exists:areas,id', //エリアId
            'shelter_name' => 'nullable|string|max:100', //避難所名
            'status' => 'nullable|boolean' //避難タイプ
        ]);

        // 避難所情報の保存
        try {
            Shelter::create([
                'user_id' => Auth::id(),
                'shelter_name' => $request->input('shelter_name'),
                'area_id' => $request->input('area_id'),
                'address' => $request->input('address'),
                'evacuation_type' => $request->input('status'),
                'body' => $request->input('introduce'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Shelter registration failed: ' . $e->getMessage());
            return back()->with('error', '避難所情報の登録に失敗しました。');
        }

        // 避難所一覧にリダイレクト
        return redirect('/shelters/index');
    }
}
