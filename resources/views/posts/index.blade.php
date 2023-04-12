@extends('layouts.login')

@section('content')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>3章CRUD実装-課題-</title>
  </head>
  <body>
<h2>機能を実装していきましょう。</h2>
<div class="page-header">新しく投稿をする</div>
{!! Form::open(['url' => 'post/creation']) !!} <!--post/createにフォームの値を送る-->
@csrf
<div class="form-group">
<img class="mark" src="./images/icon3.png" alt="username">
{!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
        </div>
 <button type="submit"><img src="./images/post.png" alt="送信" /></button>
{!! Form::close() !!}
    </div>
    <tr>
    <td></td>
    </tr>
    <h2>admin</h2>
     <button type="submit"><img src="./images/post.png" alt="送信" /></button>
    @foreach ($list as $list)
    {{ $list->id }}
    {{ $list->user_id }}
    {{ $list->post }}
    {{ $list->created_at }}
    <a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">削除</a>
    @endforeach
</body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
