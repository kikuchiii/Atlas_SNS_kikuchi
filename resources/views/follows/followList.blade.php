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
          <p class="follow_content"><a href="/user/{{$follow->id}}/yourprofile"><img src="{{ asset('storage/' . $follow->images) }}" width="50" height="50"></a></p>
        @endif
      @endforeach
  </div>
</div>
<!--フォローユーザーの投稿内容-->
<ul>
  <li>
    @foreach ($posts as $post)
      <div class="post-list">
        <p class="followUser"><a href="/user/{{ $post->user->id }}/yourprofile"><img src="{{ asset('storage/' . $post->user->images) }}" width="50" height="50"></a></p>
        <div class="content2">
          <h5 class="follow-user">{{ $post->user->username }}</h5>
          <p class ="post-created_at">
            {{ $post->updated_at->format('Y-m-d G:i') }}
          </p>
        </div>
        <p class="post">{{ $post->post }}</p>
      </div>
    @endforeach
  </li>
</ul>
@endsection
