@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register']) !!} <!--データ送り先の指定-->
<div class="register-background">
    <div class="container">

<h2>新規ユーザー登録</h2>

{{ Form::label('user name') }} <!--フォームの中でフォームの項目名と構成部品（チェックボックス、ラジオボタンなど）を関連付けるためのタグ-->
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('password') }}
{{ Form::text('password',null,['class' => 'input']) }}<!--id,-->

{{ Form::label('password comfirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('REGISTER') }}

<p class="back"><a href="/login">ログイン画面へ戻る</a></p>
@if ($errors->any())
    <p class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
</div>

@endif

{!! Form::close() !!}
</div>


@endsection
