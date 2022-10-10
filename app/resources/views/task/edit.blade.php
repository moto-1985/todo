@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">投稿編集</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if(empty($errors->first('attached_file_path')))
                    <li>画像ファイルがあれば、再度、選択してください。</li>
                    @endif
                </ul>
            </div>
            @endif

            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif

            <form method="post" action="{{route('task.update', $task)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title', $task->title)}}" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea name="content" class="form-control" id="body" cols="30" rows="10">{{old('content', $task->content)}}</textarea>
                </div>

                <div class="form-group">
                    <div>   
                        @if($task->attached_file_path)
                        <img src="{{ asset('storage/images/'.$task->attached_file_path)}}" 
                        class="img-fluid rmx-auto d-block" style="height:200px;">
                        @endif
                    </div>
                    <label for="image">添付ファイル(１MBまで) </label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="attached_file_path">
                    </div>
                </div>

                <div class="form-group">
                    <label for="user">担当者</label>
                    <select class="form-control" id="user" name="user_id">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-daterange input-group" id="datepicker">
                    <div class="input-group-prepend">
                      <div class="input-group-text">開始日付</span>
                    </div>
                    <input type="text" class="input-sm form-control" name="start_date">

                    <div class="input-group-append">
                      <span class="input-group-text">終了日付</span>
                    </div>
                    <input type="text" class="input-sm form-control" name="end_date">
                </div>


                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</div>
    
@endsection