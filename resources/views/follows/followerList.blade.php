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

@foreach ($followedposts as $followedpost)
<img class="follower" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
<div class="post-text">
    {{ $followedpost->id }}
    {{ $followedpost->user->username }}
    {{ $followedpost->post }}
    </div>
    <p class ="post-created_at">
    {{ $followedpost->created_at }}
    </p>


     @endforeach
</div>
<!--{!! Form::close() !!}-->

@endsection
