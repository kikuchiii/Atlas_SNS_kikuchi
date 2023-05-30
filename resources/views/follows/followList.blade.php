@extends('layouts.login')

@section('content')
 <div class="title">
    <h2>Folow List</h2>
    </div>
@foreach ($list as $list)
<!--@if ($list->id !== Auth::user()->id)-->
@if ( Auth::user()->isFollowing($list->id))
<!--ログインユーザーがフォローしているユーザーの名前を取得-->
 <!--変数は投稿からリレーションを経由する -->
 <div class="follow">
     <tr>
        <td><a href="/user/{{$list->id}}/yourprofile"><img src="{{ asset('./images/icon3.png ') }}"></a></td>
        <td>{{ $list->username }}</td>
        <td>{{ $list->user_id }}</td>
        </div>
        @endif
    </tr>
    <!--@endif-->
    @endforeach
<div class="post">

    @foreach ($posts as $post)
<img class="followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
<div class="post-text">
    {{ $post->id }}
    {{ $post->user->username }}
    {{ $post->post }}
    </div>
    <p class ="post-created_at">
    {{ $post->created_at }}
    </p>


     @endforeach
</div>

@endsection

<!--5行目の先頭　$list->id !==-->
