<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>
<body>
    <h1>投稿一覧</h1>

    <!-- ログイン状態に応じた表示 -->
    @auth
        <p>こんにちは、{{ Auth::user()->name }} さん！</p>
        <a href="/dashboard">ダッシュボードに戻る</a>
    @endauth

    @guest
        <p>このページはビジターとして閲覧中です。</p>
        <a href="/login">ログインする</a>
        <a href="/register">新規登録</a>
    @endguest

    <!-- 投稿データを表示 -->
    <ul>
        @foreach ($posts as $post)
            <li>
                <strong>{{ $post->title }}</strong><br>
                {{ $post->content }}
            </li>
        @endforeach
    </ul>
</body>
</html>
