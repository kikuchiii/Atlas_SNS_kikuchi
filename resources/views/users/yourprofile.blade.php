@extends('layouts.login')

@section('content')

<ul>
  <li>
    <div class="pfcontainner">
      <!--名前-->
      <!--変数値を表示する（$profilesは、$profile[x]からコピーしてきたデータが入っている)-->
    <img class="yp" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
    <div class="your-profile">
      <p>name</p>
    <div class="your-name"><h5 class="yp-username">{{ $profile->username }}</h5></div>
    </div>
    <div class="yourprofile-primary">
    <div class="profile-bio"><p>bio</p></div>
    <div class="yourprofile-area">
    <p class="yourprofile-post">{{ $profile->bio }}</p>
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
    <div class="yourprofile-secondary">
      @foreach ($UserPosts as $UserPosts)
        <div class="pf-detail">
          <h5 class="yp-username">{{ $profile->username }}</h5>
          <p class ="post-created_at">
            {{ $UserPosts->updated_at->format('Y-m-d G:i') }}
          </p>
        </div>
        <p>{{ $UserPosts->post }}</p>
    @endforeach
</div>
</div>
  </li>
</ul>
@endsection
