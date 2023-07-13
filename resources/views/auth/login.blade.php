@extends('layouts.logout')

@section('content')
<div class="login-container">
  {!! Form::open() !!}
      <div class="title">
        <p>AtlasSNSへようこそ</p>
      </div>
      <div class="ct-block">
        {{ Form::label('mail adress') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
      </div>
      <div class="ct-block">
        {{ Form::label('password') }}
        {{ Form::password('password',['class' => 'input']) }}
      </div>
      {{ Form::submit('LOGIN',['class' => 'login']) }}
      <p class="new"><a href="/register">新規ユーザーの方はこちら</a></p>
  {!! Form::close() !!}
</div>
@endsection
