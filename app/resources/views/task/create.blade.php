@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">タスク登録</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if(empty($errors->first('image')))
                    <li>画像ファイルがあれば、再度、選択してください。</li>
                    @endif
                </ul>
            </div>
            @endif            
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form method="post" action="{{route('task.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{old('content')}}</textarea>
                </div>

                <div class="form-group">
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

                <div>
                    <button type="submit" class="btn btn-success">送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection