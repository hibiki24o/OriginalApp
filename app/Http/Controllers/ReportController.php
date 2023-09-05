<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Report;
use App\Comment;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post = Post::find($request['post']);
        return view('reports.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = new Report();
        $report->user_id = auth()->id();
        $report->post_id = $request->post_id;
        $report->report_text = $request->report_text;

        // Post モデルから content カラムの値を取得
        $post = Post::find($request->post_id);
        $report->content = $post->content;

        $report->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Post::find($id);

        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $post = $request->input('report');
        // $request = Post::findOrFail($post);

        // $report = new Report();
        // $report->user_id = auth()->id();
        // $report->post_id = $post;
        // $report->report_text = $request->input('report_text');
        // $report->del_flg = 1;

        // $report->save();
        // return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
