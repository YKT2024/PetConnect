<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shelter;

class ShelterController extends Controller
{
    public function index()
    {
        // 投稿一覧（全ユーザー共通で同じ投稿を取得）
        $shelters = Shelter::with('area')->get();

        return view('shelters.index_shelter', compact('shelters'));
    }
}
