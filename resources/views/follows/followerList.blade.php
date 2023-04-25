@extends('layouts.login')

@section('content')
<!--{!! Form::open(['url' => 'follows/followerList']) !!}-->
@foreach ($followed as $followed)
@if ( Auth::user()->isFollowed($followed->id))
<tr>
        <img class="mark" src="{{ asset('./images/icon3.png ') }}">
        <td>{{ $followed->username }}</td>
        <td>{{ $followed->user_id }}</td>
        @endif
    </tr>
@endforeach
<!--{!! Form::close() !!}-->

@endsection
