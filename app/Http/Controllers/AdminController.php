<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Post;
use App\User;
use App\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function show($id)
    {
        if (auth()->user()->admin_flg) {
            // 管理者の場合の処理
            return view('admin');
            // } else {
            //     // 通常のユーザーの場合の処理
            //     return view('/home');
        }
    }

    public function edit()
    {
        $posts = Post::get();
        $user = Auth::id();
        $admin = $posts->where('user_id', $user);

        return view('mypage', ['posts' => $admin]);
    }

    // 管理者ページ
    public function admin()
    {
        // 違反報告数の多い投稿上位20件を取得
        $topReportedPosts = Post::select('posts.*', DB::raw('COUNT(reports.id) as report_count'))
            ->leftJoin('reports', 'posts.id', '=', 'reports.post_id')
            ->groupBy('posts.id')
            ->orderByDesc('report_count')
            ->limit(20)
            ->get();

        // 表示停止された投稿件数の多いユーザー上位10件を取得
        $topDisabledUsers = User::select('users.*', DB::raw('COUNT(posts.id) as disabled_count'))
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->where('posts.del_flg', 1) // 表示停止された投稿をフィルタリング
            ->groupBy('users.id')
            ->orderByDesc('disabled_count')
            ->limit(10)
            ->get();

        $reports = Report::all();

        return view('admin', [
            'topReportedPosts' => $topReportedPosts,
            'topDisabledUsers' => $topDisabledUsers,
            'reports' => $reports,
        ]);
    }

    // 投稿内容
    public function adminEdit(int $id)
    {

        $report = Report::where('post_id', $id)->first();
        $post = Post::find($id);

        $reportText = $report->report_text;

        $user = $report->user;
        $del_flg = $report->del_flg;

        return view('adminedit', [
            'report' => $report,
            'user' => $user,
            'post' => $post, // $post を渡す
            'reportText' => $reportText,
            'del_flg' => $del_flg
        ]);
    }

    // 非表示処理
    public function updateDelFlag(int $id)
    {
        $report = Report::find($id); // 選択されたレポートを取得

        if ($report) {
            $report->post->update(['del_flg' => 1]); // 関連する投稿のdel_flgを1に更新
        }

        return redirect()->route('admin');
    }

    // 編集画面
    public function editUpdate(Post $post)
    {
        return view('edit', ['post' => $post]);
    }

    //編集
    public function postsUpdate(Request $request, Post $post)
    {
        $post->content = $request->input('content');

        if (isset($request->post_img)) {

            $dir = 'image';
            $file_name = uniqid() . '.' . $request->file('post_img')->getClientOriginalExtension();
            $request->file('post_img')->storeAs('public/' . $dir, $file_name);
            $post->post_img = $dir . '/' . $file_name;
        }

        $post->save();

        return back();
    }

    // 削除機能
    public function deleteAdmin(Post $post)
    {
        $post->delete();
        return redirect()->route('home');
    }


    public function updateIcon(Request $request)
    {

        $user = Auth::user();
        if ($request->hasFile('icon_img')) {

            $dir = 'image';
            $file_name = uniqid() . '.' . $request->file('icon_img')->getClientOriginalExtension();
            $path = $request->file('icon_img')->storeAs('public/' . $dir, $file_name);
            $user->icon_img = $dir . '/' . $file_name;

            $user->save();
        }

        return redirect()->route('home');
    }

    // ユーザーアカウントの削除
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        return redirect()->route('login');
    }
}
