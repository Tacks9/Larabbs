<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;

use Auth;

class FavoritesController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    // 收藏
    public function store(Topic $topic)
    {
        // 用户不能对自己进行
        if ( ! Auth::user()->isfavoring($topic->id)) {
            Auth::user()->favorite($topic->id);
            $topic->increment('favorite_count'); // 收藏数量
        }
        return redirect()->to($topic->link());
    }

    // 取消收藏
    public function destroy(Topic $topic)
    {
        if (Auth::user()->isfavoring($topic->id)) {
            Auth::user()->unfavorite($topic->id);
            $topic->decrement('favorite_count'); // 收藏数量
        }
        return redirect()->to($topic->link());
    }
}
