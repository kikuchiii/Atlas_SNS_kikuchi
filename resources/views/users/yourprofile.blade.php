@extends('layouts.login')

@section('content')

<ul>
  <li>
    <div class="pfcontainner">
    <img class="yp" src="{{ asset('storage/' . $profile->images) }}" width="50" height="50">
    <div class="your-profile">
      <p>name</p>
    <div class="your-name"><h5 class="yp-username">{{ $profile->username }}</h5></div>
    </div>
    <div class="yourprofile-content">
    <div class="yourprofile-primary">
    <div class="profile-bio"><p>bio</p></div>
    <div class="yourprofile-area">
    <p class="yourprofile-post">{{ $profile->bio }}</p>
    <!-- フォロ-・解除の切り替えボタン -->
    @if(Auth::user()->isFollowing($profile->id))<!---->
    <form action="{{ route('search.unfollow', $profile->id) }}" method="POST">
      {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <td><button type="unfollow">フォロー解除</button></td>
  </form>
  @else
  <form action="{{ route('search.follow', $profile->id) }}" method="POST">
    {{ csrf_field() }}
    <td>><button type="follow">フォローする</button></td>
  </form>
    @endif
    </div>
    </div>
    </div>
    @foreach ($UserPosts as $UserPosts)
    <div class="yourprofile-secondary">
      <img src="{{ asset('storage/' . $UserPosts->user->images) }}" width="50" height="50">
        <div class="pf-detail">
          <h5 class="yp-username">{{ $profile->username }}</h5>
          <p class ="post-created_at">
            {{ $UserPosts->updated_at->format('Y-m-d G:i') }}
          </p>
        </div>
        <p>{{ $UserPosts->post }}</p>
      </div>
    @endforeach
</div>
  </li>
</ul>
@endsection
