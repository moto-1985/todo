@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3"> 
            {{$task->user->name}}
        </div>
        <h4>タスクタイトル：{{$task->title}}</h4>
        <span class="ml-auto">
          <a href="{{route('task.edit', $task)}}"><button class="btn btn-primary">編集</button></a>
        </span>
        <span class="ml-2">
          <form method="post" action="{{route('task.destroy', $task)}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
          </form>
        </span>
    </div>
    <div class="card-body">
        <p class="card-text">
            タスク内容：{{$task->content}}
        </p>
        <p class="card-text">
            開始日：{{$task->start_date}}
        </p>
        <p class="card-text">
            終了日：{{$task->end_date}}
        </p>
        @if($task->attached_file_path)
        <div>
            (画像ファイル：{{$task->attached_file_path}})
        </div>
        <img src="{{ asset('storage/images/'.$task->attached_file_path)}}" 
        class="img-fluid mx-auto d-block" style="height:300px;">
        @endif
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$task->created_at->diffForHumans()}}
        </span>
    </div>
</div>

@endsection