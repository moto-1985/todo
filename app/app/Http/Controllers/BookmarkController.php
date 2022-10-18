<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskUser;
use DB;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::select('tasks.*')
        ->Join('task_users', 'task_users.task_id', '=', 'tasks.id')
        ->where('task_users.user_id', '=', \Auth::id())
        ->where('task_users.bookmark_flag', '=', 1)
        // ->toSql();
        ->get();
// dd($bookmarks);
        $user=auth()->user();
        return view('bookmark', compact('tasks', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        dd($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $task = $request->all();
        $task_arr = json_decode($task['task'], true);
        // トランザクションスタート
        DB::transaction(function () use($task_arr){

            TaskUser::insert(['task_id' => $task_arr['id'], 'user_id' => \Auth::id(), 'bookmark_flag' => 1]);
            // TaskUser::where('id', $posts['memo_id'])->update(['content' => $posts['content']]);
            // // 一旦メモとタグの紐付けを削除
            // MemoTag::where('memo_id', '=', $posts['memo_id'])->delete();
            // // 再度メモとタグの紐付け
            // if (!empty($posts['tags'])) {
            //     foreach($posts['tags'] as $tag) {
            //         MemoTag::insert(['memo_id' => $posts['memo_id'], 'tag_id' => $tag]);
            //     }
            // }
            // // 新規タグが入力されているかチェック
            // // もし、新しいタグの入力があれば、インサートして紐付ける
            // $tag_exists = Tag::where('user_id', '=', \Auth::id())->where('name', '=', $posts['new_tag'])->exists(); 
            // // 新規タグが既にtagsテーブルに存在するのかチェック
            // if( !empty($posts['new_tag']) && !$tag_exists ){
            //     // 新規タグが既に存在しなければ、tagsテーブルにインサート→IDを取得
            //     $tag_id = Tag::insertGetId(['user_id' => \Auth::id(), 'name' => $posts['new_tag']]);
            //     // memo_tagsにインサートして、メモとタグを紐付ける
            //     MemoTag::insert(['memo_id' => $posts['memo_id'], 'tag_id' => $tag_id]);
            // }
        });
        // トランザクションここまで
        return redirect( route('home') );

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
