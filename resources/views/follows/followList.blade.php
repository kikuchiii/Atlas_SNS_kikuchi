@extends('layouts.login')

@section('content')
<div class="followuser2">
  <div class="title">
    <h2>Folow List</h2>
  </div>
  <div class="follow">
      @foreach ($follow as $follow)
        @if ( Auth::user()->isFollowing($follow->id))
          <!--フォローユーザーネーム-->
          <p class="follow_content"><a href="/user/{{$follow->id}}/yourprofile"><img src="{{ asset('./images/icon3.png ') }}" width="50" height="50"></a></p>
        @endif
        <!--@endif-->
      @endforeach
  </div>
</div>
<!--フォローユーザーの投稿内容-->
<ul>
  <li>
    @foreach ($posts as $post)
      <div class="post-list">
        <img class="followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
        <div class="content2">
          <h5 class="follow-user">{{ $post->user->username }}</h5>
          <p class ="post-created_at">
            {{ $post->created_at }}
          </p>
        </div>
        <p class="post">{{ $post->post }}</p>
      </div>
    @endforeach
  </li>
</ul>
@endsection
