@extends('layouts.login')

@section('content')
    {!! Form::open(['url' => 'users/searching']) !!}
@csrf
    <div class="search-group">
    {!! Form::input('text', 'search', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
    @isset($search_result)<!--「もし検索ワードがあれば検索結果を表示する」というif文-->
     {{ $search_result }}
     @endif

    <button type="search"><img class="search-image" src="./images\search.png" width="50" height="50">
</button>
    {!! Form::close() !!}
</div>

<!--div 1人分のエリア-->
<div class="user_content">
    @foreach ($list as $list)
    <!--横幅を調整して中央に配置　-->
        <div class="username-area">
            <div class="user-image">
                @if ($list->id !== Auth::user()->id)
                    <tr>
                        <div class="user-container">
                            <!--ユーザー画像-->
                            <td><img class="mark" src="{{ asset('./images/icon3.png ') }}"></td>
                            <div class="usertext">
                                <div class="user-list">
                                    <!--ユーザーネーム-->
                                    <td class="user">{{ $list->username }}</td>
                                </div>
                            </div>
                            @if(Auth::user()->isFollowing($list->id))<!---->
                                <p class="follow-area">
                                    <!--フォロー切り替えボタン-->
                                    <form action="{{ route('search.unfollow', $list->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <td><button type="unfollow">フォロー解除</button></td>
                                    </form>
                                </p>
                            @else
                                <p class="follow-area">
                                    <form action="{{ route('search.follow', $list->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <td><button type="follow">フォローする</button></td>
                                    </form>
                                </p>
                            @endif
                        </div>
                    </tr>
                @endif
            </div>
        </div>
    @endforeach
</div>
<!--div-->
@endsection
