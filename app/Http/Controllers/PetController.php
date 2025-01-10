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
            'birth_year' => 'nullable|integer|min:1900|max:2025' . date('Y'), // 誕生年
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
        try {
            Pet::create([
                'user_id' => Auth::id(),
                'name' => $request->input('accountname'),
                'pet_category_id' => $request->input('select_pettype'),
                'pet_subcategory_id' => $request->input('select_pettype2'),
                'pet_breed' => $request->input('select_pettype3'),
                'birth_year' => $request->input('birth_year'),
                'birth_month' => $request->input('birth_month'),
                'sex' => $request->input('petssex'),
                'pick_up_date' => $request->input('pickupday'),
                'image_at' => $imagePath,
                'body' => $request->input('introduce'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Pet registration failed: ' . $e->getMessage());
            return back()->with('error', 'ペット情報の登録に失敗しました。');
        }

        // 新規登録後のリダイレクト先を /home に設定
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $pet = Pet::with('pet_category', 'pet_subcategory')->findOrFail($id);
        $categories = Pet_category::all();
        $subcategories = Pet_subcategory::all();

        return view('pets.edit_pet', compact('pet', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());

        $request->validate([
            'accountname' => 'nullable|string|max:255', // ペットの名前
            'select_pettype' => 'nullable|exists:pet_categories,id', // ペットカテゴリ１
            'select_pettype2' => 'nullable|exists:pet_subcategories,id', // ペットカテゴリ2
            'select_pettype3' => 'nullable|string|max:255', // ペットの種類
            'birth_year' => 'nullable|integer|min:1900|max:2025' . date('Y'), // 誕生年
            'birth_month' => 'nullable|integer|min:1|max:12', // 誕生月
            'petssex' => 'nullable|string|in:オス,メス,その他', // 性別
            'pickupday' => 'nullable|date', // お迎え日
            'introduce' => 'nullable|string|max:200', // 紹介文
            'photo-input' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 写真
        ]);

        //指定したIDの情報をDBから取得
        $pet = Pet::findOrFail($id);

        //情報更新
        $pet->name = $request->accountname;
        $pet->pet_category_id = $request->select_pettype ? : $pet->pet_category_id;
        $pet->pet_subcategory_id = $request->select_pettype2 ? : $pet->pet_subcategory_id;
        $pet->pet_breed = $request->select_pettype3;
        $pet->birth_year = $request->birth_year;
        $pet->birth_month = $request->birth_month;
        $pet->sex = $request->petssex ? : $pet->sex;
        $pet->pick_up_date = $request->pickupday;
        $pet->body = $request->introduce;

      //画像ファイルのアップロード
        $imagePath = null;
        if ($request->hasFile('photo-input')) {
          $imagePath = $request->file('photo-input')->store('pets/img', 'public');
          $pet->image_at = $imagePath;
        }

      //更新したpet情報をDBに保存
        $pet->save();

      //更新後、マイページにリダイレクト
      return redirect('/pets/mypage');
      //ほんとは↓の感じにしたいけどまだルートできてないからできない：太田メモ
      //return redirect()->route('mypage');
    }

    function destroy($id)
    {
        $pet = Pet::find($id);

        $pet -> delete();

        return redirect('/pets/mypage');
        // return redirect()->route('pets.index');
    }

}
