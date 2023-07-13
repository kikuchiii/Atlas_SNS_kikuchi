@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="add-content">
  <div class="add-title">
  <p class="add-sub-title"> <strong>{{ session('username') }} さん</strong>
  </p>
    <p class="add-text2"><strong>ようこそ！AtlasSNSへ！</strong></p>
  </div>
    <p class="add-text">ユーザー登録が完了いたしました。</p>
    <p class="add-text">早速ログインをしてみましょう。</p>
</div>
    <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
