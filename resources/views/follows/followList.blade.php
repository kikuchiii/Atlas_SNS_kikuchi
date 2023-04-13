@extends('layouts.login')

@section('content')
@foreach ($list as $list)

@if ($list->id !== Auth::user()->id)
<!--ログインユーザーがフォローしているユーザーの名前を取得-->
 <!--変数は投稿からリレーションを経由する -->
     <tr>
        <img class="mark" src="{{ asset('./images/icon3.png ') }}">
        <td>{{ $list->username }}</td>
        <td>{{ $list->user_id }}</td>
    </tr>
    <!--@endif-->
    @endforeach
@endsection
