@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<div class="ml-2 mb-3">
    タスク一覧
</div>
{{$user->name}}さん、こんにちは！
@foreach ($tasks as $task)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <div class="media-body ml-3">
                            <a href="{{route('task.show', $task)}}">タイトル：{{ $task->title }}</a>
                            <div class="text-muted small"> 実施者：{{ $task->user->name }}</div>
                        </div>
                        <!-- <span class="ml-auto">
                            <a href="{{route('bookmark.update', $task)}}"><button class="btn btn-primary">ブックマーク</button></a>
                        </span> -->
                        <form class="" action="{{ route('bookmark.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task" value="{{ $task }}" />
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">ブックマーク</button>
                                <!-- <textarea class="form-control" name="content" rows="3" placeholder="ここにメモを入力"></textarea> -->
                            </div>
                        </form>
                        <div class="text-muted small ml-3">
                            <div> 投稿日 </div>
                            <div><strong> {{ $task->created_at->diffForHumans() }} </strong> </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p> タスク内容：{{ $task->content }} </p>
                    <p> 開始日：{{$task->start_date}} </p>
                    <p> 終了日：{{$task->end_date}} </p>
                    <p> 添付ファイル名：{{$task->attached_file_path}} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection