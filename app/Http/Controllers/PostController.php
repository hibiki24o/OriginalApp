<?php

namespace App;

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Report;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        if ($request->hasFile('post_image')) {
            $dir = 'image';
            $file_name = $request->file('post_image')->getClientOriginalName();
            $img = $request->file('post_image')->storeAs('public/' . $dir, $file_name);
            $post->post_img = $dir . '/' . $file_name;
        }
        $post->save();
        return redirect()->route('home');
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $latestPosts = Post::latest('created_at')->where('del_flg', 0)->get();

        $postsQuery = Post::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])
            ->where('del_flg', 0);

        $users = [];

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%{$keyword}%")->get();
            $userIds = $users->pluck('id')->toArray();

            $postsQuery->where(function ($query) use ($keyword, $userIds) {
                $query->where('content', 'LIKE', "%{$keyword}%")
                    ->orWhereIn('user_id', $userIds);
            });
        }

        $date = $request->input('date');
        if (!empty($date)) {
            $postsQuery->whereDate('created_at', '=', $date);
        }


        $posts = $postsQuery->get();

        if (Auth::user()->admin_flg == 1) {
            return redirect()->route('admin');
        }

        return view('home', [
            'posts' => $posts,
            'latestPosts' => $latestPosts,
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = $post->user;
        $comments = $post->comments;
        return view('show', ['post' => $post, 'user' => $user, 'comments' => $comments]);
    }

    public function postsCommentForm(Request $request, $id)
    {

        $post = Post::findOrFail($id); // コメントする投稿を取得

        $comment = new Comment([
            'comment_text' => $request->input('content'),
            'user_id' => Auth::id(),
            'post_id' => $id,
        ]);
        $post->comments()->save($comment);
        return redirect()->route('posts.show', ['id' => $id]);
    }

    public function postsComment($id)
    {
        $post = Post::findOrFail($id); // コメントする投稿を取得

        return view('comment', ['post_id' => $id]);
    }
}
