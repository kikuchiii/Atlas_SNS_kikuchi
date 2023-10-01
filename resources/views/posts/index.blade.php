@extends('layouts.login')

@section('content')
  <div class="form-area">
    <div class="form">
      {!! Form::open(['url' => 'post/creation']) !!}
      @csrf
      <div class="form-group">
        <img class="mark" src="./images/icon3.png" alt="username" >
        {!! Form::textarea('newPost', null, ['class' => 'form-control', 'placeholder' => '投稿内容を入力してください', ]) !!}
      </div>
      <button type="submit"><img src="./images/post.png" alt="送信" class="send"/></button>
      {!! Form::close() !!}
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

  </div>
  <li>
    @foreach ($list as $list)
<div class="post-containner">
        <div class="content">
            @if (Auth::id() !== $list->user_id)
                @foreach ($follow as $follower)
                    @if ($follower->id == $list->user_id)
                        <img class="RoginUser" src="{{ asset('storage/' . $follower->images) }}" width="50" height="50">
                        @break
                    @endif
                @endforeach
            @else
                <img class="RoginUser" src="{{ asset('storage/' . Auth::user()->images) }}" width="50" height="50">
            @endif
            <div class="post-area">
                <h5 class="rogin-username">{{ $list->user->username }}</h5>
                <p class="post-updated_at">{{ $list->updated_at->format('Y-m-d G:i') }}</p>
            </div>
            <p class="top-post">{{ $list->post }}</p>
        </div>
        @if (Auth::id() == $list->user_id)
        <!-- 投稿の編集ボタン -->
        <div class="content3">
          <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
            <img class="edit" src="./images/edit.png" >
          </a>
          <!-- 投稿の削除ボタン -->
          <div class="trash">
            <a href ="/post/{{ $list->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')" >
              <img src="./images/trash-h.png">
              <img src="./images/trash.png" width="20" height="20">
            </a>
          </div>
        </div>
        @endif
      </div>
      @endforeach
    </li>
<!--モーダル-->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="/post/update" method="post">
      <textarea name="upPost" class="modal_post" cols="40" rows="4"></textarea>
      <input type="hidden" name="id" class="modal_id" value="">
<input type="image" class="submit_btn" src="./images/edit.png" value="更新" width="50" height="50">
      {{ csrf_field() }}
    </form>
    <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>


@endsection
