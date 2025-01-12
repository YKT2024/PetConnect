<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stray;
use App\Models\Area;
use App\Models\Pet_Category;
use App\Models\Pet_Subcategory;

class StrayController extends Controller
{
// == 一覧表示 ==
public function index(Request $request)
{
    $query = Stray::query();

    $searchableColumns = ['name', 'body', 'address', 'date']; // 直接検索できるカラム
    $search = $request->input('search'); // フォームからの検索キーワード

    if ($search) {
        $query->where(function ($subQuery) use ($searchableColumns, $search) {
            foreach ($searchableColumns as $column) {
                $subQuery->orWhere($column, 'LIKE', '%' . $search . '%'); //あいまい検索
            }

            // リレーション先（エリアとカテゴリ）の検索条件を追加
            $subQuery->orWhereHas('area', function ($query) use ($search) {
                $query->where('area', 'LIKE', '%' . $search . '%'); // エリア名を検索
            });

            $subQuery->orWhereHas('pet_subcategory', function ($query) use ($search) {
                $query->where('subcategory', 'LIKE', '%' . $search . '%'); // カテゴリ名を検索
            });
        });
    }

    $strays = $query->with('area', 'pet_subcategory')->orderBy('created_at', 'desc')->get();

    return view('strays.index_stray', compact('strays'));
}


    // == 新規投稿 ==
    public function create()
    {
        $areas = Area::all();
        $categories = Pet_Category::all();
        $pet_subcategories = Pet_Subcategory::all();

        return view('strays.create_stray', compact('areas', 'categories', 'pet_subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|integer',
            'accountname' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'address_detail' => 'required|string',
            'date' => 'required|date',
            'select_pettype2' => 'required|exists:pet_subcategories,id',
            'petssex' => 'nullable|string',
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'introduce' => 'nullable|string|max:280',
            'photo' => 'nullable|image|max:2048', // 写真のバリデーション
        ]);
    
        $stray = new Stray();
        $stray->status = $validated['status'];
        $stray->name = $validated['accountname'];
        $stray->area_id = $validated['area_id'];
        $stray->address = $validated['address_detail'];
        $stray->date = $validated['date'];
        $stray->pet_subcategory_id = $validated['select_pettype2'];
        $stray->sex = $validated['petssex'];
        $stray->age = $validated['age'];
        $stray->weight = $validated['weight'];
        $stray->height = $validated['height'];
        $stray->body = $validated['introduce'];
        $stray->user_id = auth()->id(); 
    
        // 写真がアップロードされた場合の処理
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('strays_img'); // 保存先のフォルダ
            $fileName = time() . '_' . $request->file('photo')->getClientOriginalName(); // ファイル名の作成
            $request->file('photo')->move($destinationPath, $fileName); // ファイルを移動
    
            $stray->image_at = 'strays_img/' . $fileName; // パスをデータベースに保存
        }
    
        $stray->save();
    
        return redirect()->route('strays.index')->with('success', '投稿が完了しました！');
    }
    

    // == 投稿の編集 ==
    public function edit($id)
    {
        $stray = Stray::findOrFail($id); // 編集対象のデータを取得
        $areas = Area::all(); // エリアデータを取得
        $pet_subcategories = PetSubcategory::all(); // クラス名修正

        return view('strays.edit_stray', compact('stray', 'areas', 'pet_subcategories'));
    }

    public function update(Request $request, $id)
{
    $stray = Stray::findOrFail($id); // 編集対象のデータを取得

    $validated = $request->validate([
        'status' => 'required|integer',
        'accountname' => 'required|string|max:255',
        'area_id' => 'required|exists:areas,id',
        'address_detail' => 'required|string',
        'date' => 'required|date',
        'select_pettype2' => 'required|exists:pet_subcategories,id',
        'petssex' => 'nullable|string',
        'age' => 'nullable|integer',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'introduce' => 'nullable|string|max:280',
        'photo' => 'nullable|image|max:2048', // 写真のバリデーション
    ]);

    // データを更新
    $stray->update([
        'status' => $validated['status'],
        'name' => $validated['accountname'],
        'area_id' => $validated['area_id'],
        'address' => $validated['address_detail'],
        'date' => $validated['date'],
        'pet_subcategory_id' => $validated['select_pettype2'],
        'sex' => $validated['petssex'],
        'age' => $validated['age'],
        'weight' => $validated['weight'],
        'height' => $validated['height'],
        'body' => $validated['introduce'],
    ]);

    // 写真がアップロードされた場合
    if ($request->hasFile('photo')) {
        $destinationPath = public_path('strays_img'); // 保存先のフォルダ
        $fileName = time() . '_' . $request->file('photo')->getClientOriginalName(); // ファイル名の作成
        $request->file('photo')->move($destinationPath, $fileName); // ファイルを移動

        $stray->image_at = 'strays_img/' . $fileName; // パスをデータベースに保存
        $stray->save(); // データ保存（写真更新時のみ）
    }

    return redirect()->route('strays.index')->with('success', '情報を更新しました！');
}

    public function destroy($id)
    {
        $stray = Stray::findOrFail($id);
        $stray->delete();

        return redirect()->route('strays.index')->with('success', '情報を削除しました！');
    }
}
