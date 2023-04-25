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
    @isset($search_result)<!--「もし検索ワードがあれば検索結果を表示する」というif文-->
     {{ $search_result }}
     @endif
        </div>
    <button type="search"><img src="{{ asset('./images/post.png' ) }}"></button>
    {!! Form::close() !!}

@foreach ($list as $list)
@if ($list->id !== Auth::user()->id)
     <tr>
        <td><img class="mark" src="{{ asset('./images/icon3.png ') }}"></td>
        <td>{{ $list->username }}</td>
        @if(Auth::user()->isFollowing($list->id))<!---->
<form action="{{ route('search.unfollow', $list->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

        <td><button type="unfollow">フォロー解除</button></td>
</form>
        @else
    <form action="{{ route('search.follow', $list->id) }}" method="POST">
    {{ csrf_field() }}
        <td>><button type="submit">フォローする</button></td>
        </form>
@endif
    </tr>
    @endif
    @endforeach
</body>

@endsection
