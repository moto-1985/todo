<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;


class TaskController extends Controller
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
    public function create()
    {
        $users = DB::table('users')->get();
        // dd($users);
        return view('task.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:65535',
            'user_id'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'attached_file_path'=>'image|max:1024',
        ]);
        $task = new Task();
        $task->title = $inputs['title'];
        $task->content = $inputs['content'];
        $task->user_id = $inputs['user_id'];
        $task->attached_file_path = $inputs['attached_file_path'];
        $task->start_date = $inputs['start_date'];
        $task->end_date = $inputs['end_date'];
        if (request('attached_file_path')){
            $original = request()->file('attached_file_path')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('attached_file_path')->move('storage/images', $name);
            $task->attached_file_path = $name;
        }
        $task->save();
        return back()->with('message', 'タスクを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // これがあるとviewでちゃんとユーザの出しわけができている理由がわからない
        $user=auth()->user();
        return view('task.show', compact('task','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = DB::table('users')->get();
        return view('task.edit', compact('task','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:65535',
            'user_id'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'attached_file_path'=>'image|max:1024',
        ]);

        $task->title = $inputs['title'];
        $task->content = $inputs['content'];
        $task->user_id = $inputs['user_id'];
        $task->attached_file_path = $inputs['attached_file_path'];
        $task->start_date = $inputs['start_date'];
        $task->end_date = $inputs['end_date'];
                
        if(request('attached_file_path')){
            $original=request()->file('attached_file_path')->getClientOriginalName();
            $name=date('Ymd_His').'_'.$original;
            request()->file('attached_file_path')->move('storage/images', $name);
            $task->attached_file_path=$name;
        }

        $task->save();

        return back()->with('message', 'タスクを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('home')->with('message', 'タスクを削除しました');
    }
}
