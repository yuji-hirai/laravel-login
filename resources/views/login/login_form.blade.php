<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ログインフォーム</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sign.css') }}" rel="stylesheet">

</head>

<body class="text-center">

<main class="form-signin">
    <form method="post" action="{{ route('login') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <x-alert type="danger" :session="session('danger')"/>

        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ old('email') }}" autofocus>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="{{ old('password') }}">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>
</main>



</body>
</html>
