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
{!! Form::open(['url' => 'post/create']) !!}
@csrf
<div class="form-group">
{!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
        </div>
 <button type="submit"><img src="post.png" alt="送信" /></button>
{!! Form::close() !!}
    </div>
    <tr>
    <td></td>
    </tr>
</body>

@endsection
