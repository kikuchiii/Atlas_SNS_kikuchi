@extends('layouts.login')

@section('content')
<h2>相手のプロフィール</h2>

<img class="followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">

<span>{{ $profile->username }}</span>


@if(Auth::user()->isFollowing($profile->id))<!---->
<form action="{{ route('search.unfollow', $profile->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

        <td><button type="unfollow">フォロー解除</button></td>
</form>
        @else
    <form action="{{ route('search.follow', $profile->id) }}" method="POST">
    {{ csrf_field() }}
        <td>><button type="submit">フォローする</button></td>
        </form>
@endif
    </tr>

{!! Form::open(['url' => 'users/update','class' => 'profile']) !!} <!--post/createにフォームの値を送る-->

{{ Form::label('username') }} <!--フォームの中でフォームの項目名と構成部品（チェックボックス、ラジオボタンなど）を関連付けるためのタグ-->
<input type="text" name="username" value="{{Auth::user()->username}}" >
{{ Form::label('mail adress') }}
<input type="text" name="mail" value="{{Auth::user()->mail}}" >
{{ Form::label('password') }}
<input type="text" name="password" value="{{ Auth::user()->password }}" >

{{ Form::label('password confirm') }}
<input type="text" name="password confirm" value="{{ Auth::user()->password }}" >

{{ Form::label('bio') }}
<input type="text" name="bio" value="{{ Auth::user()->bio }}" >

{{ Form::label('icon images') }}
<form method='POST'  action="/store" enctype="multipart/form-data"><!--ファイルを扱うときに記載する-->
  @csrf

{{ Form::submit('更新') }}
{!! Form::close() !!}
@endsection
