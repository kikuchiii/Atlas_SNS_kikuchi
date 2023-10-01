@extends('layouts.login')

@section('content')
    <div class="followuser3">
        <div class="title">
            <h2>follower List</h2>
        </div>

        <div class="follow">
            @foreach ($followed as $followed)
                @if ( Auth::user()->isFollowed($followed->id))
                <tr>
                    <p class="follow_content"><td><a href="/user/{{ $followed->id }}/yourprofile"><img src="{{ asset('./images/icon3.png ') }}" width="50" height="50" class="followed"></a></p></td>
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
                <p class="follower"><a href="/user/{{ $followed->id }}/yourprofile"><img src="{{ asset('./images/icon3.png ') }}" width="50" height="50"></a></p>
                <div class="content2">
                    <h5 class="follower-user">{{ $followedpost->user->username }}</h5>
                    <p class ="follower-post-created_at">
                        {{ $followedpost->updated_at->format('Y-m-d G:i') }}
                    </p>
                </div>
                <p class="follower-post">{{ $followedpost->post }}</p>
            </div>
        @endforeach
        </li>
    </ul>
    <!--{!! Form::close() !!}-->
@endsection
