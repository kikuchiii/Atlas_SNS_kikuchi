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
    @foreach ($list as $lists)
      <div class="post-containner">
        <div class="content">
          <div class="content2">
            <img class="followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
            <p class="username"><h5>{{ $list->user->username }}</h5></p>
            <p class="post-created_at">{{ $list->created_at }}</p>
          </div>
          <p class="post">{{ $list->post }}</p>
        </div>
        <!-- 投稿の編集ボタン -->
        <div class="content3">
          <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}"><img src="./images/edit.png" class="edit"></a>
          <!-- 投稿の削除ボタン -->
          <div class="trash">
            <a href ="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')" >
            <img src="./images/trash-h.png">
            <img src="./images/trash-h.png">
            </a>
          </div>
        </div>
      </div>
      @endforeach
      <!--フォローユーザーの投稿内容-->
      @foreach ($posts as $post)
      <div class="post-list">
        <div class="content2">
          <img class="followUser" src="{{ asset('./images/icon3.png ') }}" width="50" height="50">
          <h5>{{ $post->user->username }}</h5>
          <p class ="post-created_at">
          {{ $post->created_at }}
          </p>
        </div>
        <p class="post">{{ $post->post }}</p>
      </div>
  @endforeach
  </li>
<!--モーダル-->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="/post/update" method="post">
      <textarea name="upPost" class="modal_post"></textarea>
      <input type="text" name="id" class="modal_id" value="">
      <input type="submit" value="更新">
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
@endsection
