<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">アドレス</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">ログイン</button>
    </form>
    <a href="{{ route('register') }}">新規登録</a>
    <br>
    <a href="{{ route('posts.index') }}">ログインせずに見る</a>
</body>
</html>
