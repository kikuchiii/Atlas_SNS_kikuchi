@extends('layouts.login')

@section('content')
@foreach ($list as $list)
<!--@if ($list->id !== Auth::user()->id)-->
@if ( Auth::user()->isFollowing($list->id))
<!--ログインユーザーがフォローしているユーザーの名前を取得-->
 <!--変数は投稿からリレーションを経由する -->
     <tr>
        <td><a href="/yourprofile"><img src="{{ asset('./images/icon3.png ') }}"></td>
        <td>{{ $list->username }}</td>
        <td>{{ $list->user_id }}</td>
        @endif
    </tr>
    <!--@endif-->
    @endforeach
@endsection

<!--5行目の先頭　$list->id !==-->
