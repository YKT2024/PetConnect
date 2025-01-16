<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Shelter;
use App\Models\Stray;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pet;

class CommentController extends Controller
{
    // コメント削除
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // コメントがログイン中のユーザーのものか確認
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'コメントを削除しました！');
    }

    // Shelter 用コメント保存
    public function storeForShelter(Request $request, $shelterId)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:150',
        ]);

        // コメントを作成して保存
        Comment::create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'shelter_id' => $shelterId,
        ]);

        // ユーザーのアイコンを取得
        $userId = Shelter::where('id', $shelterId)->pluck('user_id');
        $icon = Pet::where('user_id', $userId)->value('image_at');
        // 投稿者名を取得
        $userName = User::where('id', $userId)->value('name');

        return redirect()->route('shelters.show', $shelterId)->with('success', 'コメントを投稿しました！');
    }

    // Stray 用コメント保存
    public function storeForStray(Request $request, $strayId)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:150',
        ]);

        // コメントを作成して保存
        Comment::create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'stray_id' => $strayId,
        ]);

        return redirect()->route('strays.show', $strayId)->with('success', 'コメントを投稿しました！');
    }
}
