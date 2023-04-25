@extends('layouts.login')

@section('content')
<h2>新規ユーザー登録</h2>
{!! Form::open(['url' => 'users/update']) !!} <!--post/createにフォームの値を送る-->

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
