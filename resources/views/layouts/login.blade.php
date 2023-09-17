<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <!--IEブラウザ対策-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="description" content="ページの内容を表す文章" />
            <title></title>
            <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
            <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
            <!--スマホ,タブレット対応-->
            <meta name="viewport" content="width=device-width,initial-scale=1" />
            <!--サイトのアイコン指定-->
            <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
            <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
            <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
            <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
            <!--iphoneのアプリアイコン指定-->
            <link rel="apple-touch-icon-precomposed" href="画像のURL" />
            <!--OGPタグ/twitterカード-->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="js/script.js"></script>
        </head>
        <body>
            <header>
                <div id = "head">
                <h1><a href="/top"><img src="{{ asset('./images/atlas.png') }}" class="example1"></a></h1>
                <div id="">
                <div class ="rogin-menu">
                    <p class= "roginuser"> {{ Auth::user()->username }} さん</p>
                    <input id="check-a" type="checkbox" class="check">
                    <label class="label "for="check-a"></label>
                    <div class="text">
                            <p class="child-link">
                                <a href="/top">HOME</a>
                            </p>
                            <p class="child-link">
                                <a href="/profile" class="profile-edit">プロフィール編集</a>
                            </p>
                            <p class="child-link">
                                <a href="/logout">ログアウト</a>
                            </p>
                    </div>
                    <img class="rogin" src="{{ asset('./images/icon3.png ') }}" width="50" height="50"></p>
                </div>
            </header>
            <div id="row">
            <div id="container">
                @yield('content')
                </div >
                <div id="side-bar">
                    <div id="confirm">
                        <p class="rogin-user">{{ Auth::user()->username }}さんの</p>
                        <div class="follow-count">
                            <p class="follow-text">フォロー数</p>
                            <p class="count">{{ Auth::user()->follows()->count() }}名</p>
                        </div>
                        <button type="button" class="btn btn-primary"><a href="/follow-list">フォローリスト</a></button>
                        <div class="follower-count">
                            <p class="follow-text">フォロワー数</p>
                            <p class="count">{{ Auth::user()->followers()->count() }}名</p>
                        </div>
                        <button type="button" class="btn btn-primary"><a href="/follower-list">フォロワーリスト</a></button>
                    </div>
                    <button type="button" name="search" class="btn btn-primary"><a href="/search">ユーザー検索</a></button>
                </div>
            </div>
            <footer>
            </footer>
            <script src="JavaScriptファイルのURL"></script>
            <script src="JavaScriptファイルのURL"></script>
        </body>
</html>
