@extends('layouts.login')

@section('content')
<div class="followuser">
 <div class="title">
    <h2>follower List</h2>
 </div>

  <div class="follow">
<!--{!! Form::open(['url' => 'follows/followerList']) !!}-->
@foreach ($followed as $followed)
@if ( Auth::user()->isFollowed($followed->id))
<tr>
        <td><a href="/user/{{ $followed->id }}/yourprofile"><img src="{{ asset('./images/icon3.png ') }}" class="followed"></a></td>
        @endif
    </tr>
@endforeach
  </div>
</div>
<!--フォロワーの投稿内容-->
<ul>
 <li>
@foreach ($followedposts as $followedpost)
 <div class="post-list">
        <div class="content2">
                <img class="follower" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
<h5 class="follow-user">{{ $followedpost->user->username }}</h5>
    <p class="follower-post">{{ $followedpost->post }}</p>

        <p class ="follower-post-created_at">
    {{ $followedpost->created_at }}
        </p>
        </div>
</div>
     @endforeach
 </li>
</ul>
<!--{!! Form::close() !!}-->

@endsection
