@extends('layouts.login')

@section('content')
{!! Form::open(['url' => 'follows/followerList']) !!}
@foreach($followed_users as $followed_user)
<tr>
        <img class="mark" src="{{ asset('./images/icon3.png ') }}">
        <td>{{ $followed_users->username }}</td>
    </tr>
@endforeach
{!! Form::close() !!}

@endsection
