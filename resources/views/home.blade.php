<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetConnect</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container text-center">
        <img src="{{ asset('img/logo_yoko.png') }}" alt="PetConnectロゴ" class="logo">
        <h1>ようこそ!!</h1>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = '/posts';
        }, 1500); // 1.5秒後にリダイレクト
    </script>
    @endsection
</body>
</html>
