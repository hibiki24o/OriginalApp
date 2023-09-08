<?php

namespace App\Http\Controllers;

use App\Post;
use App\Report;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
    public function index()
    {
        if (Auth::user()->admin_flg == 1) {
            return redirect()->route('admin');
        }
        $latestPosts = Post::latest('created_at')->get()->where('del_flg', 0);


        $posts = Post::with('user')->get()->where('del_flg', 0);
        return view('home', ['posts' => $posts, 'latestPosts' => $latestPosts]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $searchOption = $request->input('search_option');

        $query = Post::query();

        if ($searchOption === 'users') {
            $query->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        if ($searchOption === 'text') {
            $query->where('content', 'like', '%' . $keyword . '%');
        }

        if ($searchOption === 'date') {
            $date = $request->input('date');
            $query->whereDate('created_at', '>=', $date);
        }

        $posts = $query->get();
        return view('search_results', compact('posts'));
    }
}
