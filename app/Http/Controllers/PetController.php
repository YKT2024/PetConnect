<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet_category;
use App\Models\Pet_subcategory;
use App\Models\Pet;


class PetController extends Controller
{
    public function show_create_pet()
    {
        //categoryとsubcategoryの情報
        $categories = Pet_category::all();
        $subcategories = Pet_subcategory::all();

        return view('pets.create_pet', compact('categories', 'subcategories'));
    }

    public function store_create_pet(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'accountname' => 'required|string|max:255', // ペットの名前
            'select_pettype' => 'required|exists:pet_categories,id', // ペットカテゴリ１
            'select_pettype2' => 'required|exists:pet_subcategories,id', // ペットカテゴリ2
            'select_pettype3' => 'nullable|string|max:255', // ペットの種類
            'birth_year' => 'nullable|integer|min:1900|max:' . date('Y'), // 誕生年
            'birth_month' => 'nullable|integer|min:1|max:12', // 誕生月
            'petssex' => 'nullable|string|in:オス,メス,その他', // 性別
            'pickupday' => 'nullable|date', // お迎え日
            'introduce' => 'nullable|string|max:200', // 紹介文
            'photo-input' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 写真
        ]);

        // 画像の保存処理
        $imagePath = null;
        if ($request->hasFile('photo-input')) {
            $imagePath = $request->file('photo-input')->store('pets/img', 'public');
        }

        // ペット情報の保存
        Pet::create([
            'user_id' => Auth::id(),
            'name' => $validated['accountname'],
            'pet_category_id' => $validated['select_pettype'],
            'pet_subcategory_id' => $validated['select_pettype2'],
            'pet_breed' => $validated['select_pettype3'] ?? null,
            'birth_year' => $validated['birth_year'] ?? null,
            'birth_month' => $validated['birth_month'] ?? null,
            'sex' => $validated['petssex'] ?? null,
            'pick_up_date' => $validated['pickupday'] ?? null,
            'image_at' => $imagePath,
            'body' => $validated['introduce'] ?? null,
        ]);

        // 新規登録後のリダイレクト先を /home に設定
        return redirect()->route('home');
    }
}
