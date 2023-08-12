@extends('layouts.login')

@section('content')
    <img src="{{ asset('$user->$image')}}"
 alt="Uploaded Image" width="50" height="50">
{!! Form::open(['url' => 'users/update','class' => 'profile','files' => true]) !!} <!--post/createにフォームの値を送る-->
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
      <input type="password" name="password_confirmation" value="" >
    </div>
    <div class="ct-block">
      {{ Form::label('bio') }}
      <input type="text" name="bio" value="{{ Auth::user()->bio }}" >
    </div>
    <div class="ct-block">
      {{ Form::label('icon images') }}
      <div class="file_button">
        <div style="background: #fff; border-left: #fff solid 10px; border: #fceff2 solid 1px; font-size: 25px; color: #C0C0C0; padding: 5px; margin-inline: 20px;
    margin-block: -5px;">
        ファイルを選択</div>
      <input type="file" name="image">
      </div>
      <form method='POST' action="{{ route('users.update') }}" enctype="multipart/form-data" style="display:none"><!--ファイルを扱うときに記載する-->
      @csrf
<!---->
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

    @if (isset($imageName))
    <img src="{{ asset('storage/images/' . $imageName) }}" alt="Uploaded Image">
@endif
<!---->
    </div>
      {{ Form::submit('更新', ['type'=>'submit']) }}

</div>

{!! Form::close() !!}

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
