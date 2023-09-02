@extends('layouts.login')

@section('content')
  <div class="form-area">
    <div class="form">
      {!! Form::open(['url' => 'post/creation']) !!} <!--post/createにフォームの値を送る-->
      @csrf
      <div class="form-group">
        <img class="mark" src="./images/icon3.png" alt="username" >
        {!! Form::input('text', 'newPost', null, ['class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
      </div>
      <button type="submit"><img src="./images/post.png" alt="送信" class="send"/></button>
      {!! Form::close() !!}
    </div>
  </div>
  <li>
      <div class="post-containner">
        <div class="content">
          <img class="RoginUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
          <div class="post-area">
            <h5 class="follow-user">{{ $list->user->username }}</h5>
            <p class="post-created_at">{{ $list->created_at }}</p>
          </div>
          <p class="post">{{ $list->post }}</p>
        </div>
        <!-- 投稿の編集ボタン -->
        <div class="content3">
          <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
            <img class="edit" src="./images/edit.png" >
          </a>
          <!-- 投稿の削除ボタン -->
          <div class="trash">
            <a href ="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')" >
            <img src="./images/trash-h.png">
            </a>
          </div>
        </div>
      </div>
      <!--フォローユーザーの投稿内容-->
      @foreach ($posts as $post)
      <div class="post-list">
        <img class="Top-followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
        <div class="Top-content">
          <h5>{{ $post->user->username }}</h5>
          <p class ="post-created_at">
          {{ $post->created_at }}
          </p>
        </div>
        <p class="Top-post">{{ $post->post }}</p>
      </div>
  @endforeach
  </li>
<!--モーダル-->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="/post/update" method="post">
      <textarea name="upPost" class="modal_post" cols="40" rows="4"></textarea>
<input type="image" class="submit_btn" src="./images/edit.png" value="次へ" width="50" height="50">
      {{ csrf_field() }}
    </form>
    <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<!--ログインユーザー投稿-->
      <div class="post-containner2">
        <div class="content">
          <img class="RoginUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
          <div class="post-area">
            <h5 class="follow-user">{{ $list->user->username }}</h5>
            <p class="post-created_at">{{ $list->created_at }}</p>
          </div>
          <p class="post">{{ $list->post }}</p>
        </div>
        <!-- 投稿の編集ボタン -->
        <div class="content3">
          <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
            <img class="edit" src="./images/edit.png" >
          </a>
          <!-- 投稿の削除ボタン -->
          <div class="trash">
            <a href ="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')" >
            <img src="./images/trash-h.png">
            </a>
          </div>
        </div>
      </div>

@endsection
