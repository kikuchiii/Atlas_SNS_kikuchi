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
    {!! Form::open(['url' => 'users/searching']) !!}
@csrf
    <div class="form-group">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
        </div>
    <button type="submit"><img src="./images/post.png" alt="送信" /></button>
    {!! Form::close() !!}
    </div>
@foreach ($list as $list)
@if ($list->id !== Auth::user()->id)
     <tr>
        <img class="mark" src="./images/icon3.png" alt="username">
        <td>{{ $list->username }}</td>
    </tr>
    @endif
    @endforeach
</body>

@endsection
