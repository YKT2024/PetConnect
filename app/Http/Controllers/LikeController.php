<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $user = auth()->user();

        if (!$user->likes->contains($post->id)) {
            $user->likes()->attach($post->id);
        }

        return redirect()->back()->with('message', 'ブックマークしました！');
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();

        if ($user->likes->contains($post->id)) {
            $user->likes()->detach($post->id);
        }

        return redirect()->back()->with('message', 'ブックマークを解除しました！');
    }
}
