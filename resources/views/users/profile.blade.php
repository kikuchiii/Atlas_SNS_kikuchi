@extends('layouts.login')

@section('content')
<img class="rogin-image" src="./images/icon1.png" width="50" height="50"></p>
{!! Form::open(['url' => 'users/update','class' => 'profile']) !!} <!--post/createにフォームの値を送る-->
<div class="form-list">
    <div class="ct-block">
      {{ Form::label('user name') }} <!--フォームの中でフォームの項目名と構成部品（チェックボックス、ラジオボタンなど）を関連付けるためのタグ-->
      <input type="text" name="username" value="{{Auth::user()->username}}" >
    </div>
    <div class="ct-block">
      {{ Form::label('mail adress') }}
      <input type="text" name="mail" value="{{Auth::user()->mail}}" >
    </div>
    <div class="ct-block">
      {{ Form::label('password') }}
      <input type="password" name="password" >
    </div>
    <div class="ct-block">
      {{ Form::label('password confirm') }}
      <input type="password" name="password confirm" value="" >
    </div>
    <div class="ct-block">
      {{ Form::label('bio') }}
      <input type="text" name="bio" value="{{ Auth::user()->bio }}" >
    </div>
    <div class="ct-block">
      {{ Form::label('icon images') }}
      <input type="file" name="image" value="" >
      <form method='POST'  action="/store" enctype="multipart/form-data"><!--ファイルを扱うときに記載する-->
    </div>
    @csrf
    {{ Form::submit('更新', ['type'=>'submit']) }}
  </div>
    {!! Form::close() !!}
@endsection
