<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shelter;

class ShelterController extends Controller
{
    // public function index()
    // {
    //     // 投稿一覧（全ユーザー共通で同じ投稿を取得）
    //     $shelters = Shelter::with(['area', 'comments'])->get();

    //     return view('shelters.index_shelter', compact('shelters'));
    // }

    public function index(Request $request)
    {
        // クエリの初期化
        $query = Shelter::query();
    
        // 検索対象カラム
        $searchableColumns = ['body', 'address', 'shelter_name'];
    
        // リクエストから検索キーワードとフィルタを取得
        $search = $request->input('search'); // フォームの検索キーワード
        $filter = $request->input('filter', 'all'); // ラジオボタンの値
    
        // 検索条件の適用
        if ($search) {
            $query->where(function ($subQuery) use ($searchableColumns, $search) {
                foreach ($searchableColumns as $column) {
                    $subQuery->orWhere($column, 'LIKE', '%' . $search . '%'); // 部分一致検索
                }
    
                // 関連モデル（エリア）での検索
                $subQuery->orWhereHas('area', function ($query) use ($search) {
                    $query->where('area', 'LIKE', '%' . $search . '%');
                });
            });
        }
    
        // フィルタリング
        if ($filter === 'mine') {
            $query->where('user_id', auth()->id()); // 自分の投稿のみ
        }
    
        // データの取得（並び順を追加可能）
        $shelters = $query->with(['area', 'comments'])->orderBy('created_at', 'desc')->get();
    
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
// == 詳細ページ表示 ==
public function show($id)
{
    $shelter = Shelter::with('area')->findOrFail($id); // IDでデータを取得

    // コメントを取得
    $comments = $shelter->comments()->with('user')->get();

    // 自分の投稿かどうかを判定
    $isOwner = $shelter->user_id === auth()->id();

    // 詳細ページを返す
    return view('shelters.show_shelter', compact('shelter', 'comments','isOwner'));
}

// == 編集ページ表示 ==
public function edit($id)
{
    $shelter = Shelter::findOrFail($id); // IDで該当の投稿を取得
    $areas = Area::all(); // エリア一覧を取得

    // 自分の投稿かどうかを確認
    if ($shelter->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.'); // 他人の投稿の場合は403エラーを返す
    }

    return view('shelters.edit_shelter', compact('shelter', 'areas')); // 編集ページを返す
}

public function destroy($id)
{
    $shelter = Shelter::findOrFail($id);

    // 削除を実行
    $shelter->delete();

    return redirect()->route('shelters.index')->with('success', '避難所情報を削除しました。');
}


}