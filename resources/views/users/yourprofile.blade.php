@extends('layouts.login')

@section('content')

<ul>
  <div class="content2">
    <li>
      <div class="post-containner">
        <!--名前-->
        @foreach($profile as $profiles)
      print($profile);
        <!--変数値を表示する（$profilesは、$profile[x]からコピーしてきたデータが入っている)-->
        <div class="pf-area">
        <img class="profile2" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
        <p>name</p>
        <h5 class="follow-user">{{ $profile->username }}</h5>
      <div class="pf-area2">
        <p>bio</p>
        <p class="post">{{ $profile->bio }}</p>
<!--切り替えボタン-->
      @if(Auth::user()->isFollowing($profile->id))<!---->
        <form action="{{ route('search.unfollow', $profile->id) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <td><button type="unfollow">フォロー解除</button></td>
        </form>
      @else
        <form action="{{ route('search.follow', $profile->id) }}" method="POST">
          {{ csrf_field() }}
          <td>><button type="submit">フォローする</button></td>
        </form>
        @endif
      </div>
</div>
      @endforeach
      </div>
      </div>
      @foreach ($UserPosts as $UserPosts)
      <div class="post-list">
      <!--print($UserPosts);-->
      <!--変数値を表示する（$UserPostsは、$UserPosts[x]からコピーしてきたデータが入っている)-->
      <p>{{ $UserPosts->post }}</p>
          <p class ="post-created_at">
          {{ $UserPosts->created_at }}
          </p>
      </div>
      @endforeach


    </li>



  </ul>

@endsection
