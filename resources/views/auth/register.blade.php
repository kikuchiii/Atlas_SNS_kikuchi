@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register']) !!} <!--データ送り先の指定-->
<div class="container">
<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }} <!--フォームの中でフォームの項目名と構成部品（チェックボックス、ラジオボタンなど）を関連付けるためのタグ-->
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}<!--id,-->

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::close() !!}
</div>


@endsection
