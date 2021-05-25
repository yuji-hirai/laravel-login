<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ホーム画面</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sign.css') }}" rel="stylesheet">

</head>
<html>
<body>
<div class="container">
    <div class="mt-5">

            <x-alert type="success" :session="session('success')"/>

            <h3>プロフィール</h3>
        <ul>
            <li>名前：{{ Auth::user()->name }}</li>
            <li>メールアドレス：{{ Auth::user()->email }}</li>
        </ul>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn-danger btn">ログアウト</button>
        </form>
    </div>
</div>

</body>
</html>
