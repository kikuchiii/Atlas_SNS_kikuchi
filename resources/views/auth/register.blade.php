@extends('layouts.logout')

@section('content')
    {!! Form::open(['url' => '/register']) !!}
        <div class="register-background">
            <div class="container">
                <h2>新規ユーザー登録</h2>
                {{ Form::label('user name') }}
                {{ Form::text('username',null,['class' => 'input']) }}

                {{ Form::label('mail adress') }}
                {{ Form::text('mail',null,['class' => 'input']) }}

                {{ Form::label('password') }}
                {{ Form::password('password',null,['class' => 'input']) }}

                {{ Form::label('password comfirm') }}
                {{ Form::password('password_confirmation',null,['class' => 'input']) }}

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
            @endif
        </div>
    {!! Form::close() !!}
    </div>
@endsection
