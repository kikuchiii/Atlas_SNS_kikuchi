@extends('layouts.login')

@section('content')
<div class="followuser">
  <div class="title">
    <h2>Folow List</h2>
  </div>
  <div class="follow">
      @foreach ($follow as $follow)
        <!--@if ($follow->id !== Auth::user()->id)-->
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
        <div class="content2">
          <img class="followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
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

<!--5行目の先頭　$list->id !==-->
