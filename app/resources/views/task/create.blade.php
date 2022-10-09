@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">タスク登録</h1>
            <form enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <label for="body">内容</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">添付ファイル </label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <div class="form-group">
                    <label for="user">担当者</label>
                    <select class="form-control" id="user" name="user">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                </div>

                <div class="input-daterange input-group" id="datepicker">
                    <div class="input-group-prepend">
                      <div class="input-group-text">開始日付</span>
                    </div>
                    <input type="text" class="input-sm form-control" name="from">

                    <div class="input-group-append">
                      <span class="input-group-text">終了日付</span>
                    </div>
                    <input type="text" class="input-sm form-control" name="to">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection