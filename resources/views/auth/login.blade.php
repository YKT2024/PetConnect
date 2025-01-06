<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <img class=logo src="{{ asset('img/logo_yoko.png')}}" alt="ロゴ">
    <div class="information">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" id="email" name="email" value="" placeholder="    アドレス" required>
        <br>
        <input type="password" id="password" name="password" value="" placeholder="    パスワード" required>
        <br>
        <button type="submit">ログイン</button>
    </form>
    <hr>
    <div class="reguster"><a href="{{ route('register') }}">新規登録</a></div>
    <br>
    <div class="non_login"><a href="{{ route('posts.index') }}">ログインせずに見る</a></div>
    </div>
</body>
</html>
