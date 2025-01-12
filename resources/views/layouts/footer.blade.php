<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PetConnect</title>
   {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')
</head>

@yield('content')

<footer>

    <div class="footer-icons">
        <a href="{{ route('posts.index_post') }}"><img class=icons src="{{ asset('img/footer_field.png')}}" alt="投稿一覧"></a>
        <a href="#"><img class=icons src="{{ asset('img/footer_search.png') }}" alt="検索"></a>
        <a href="#"><img class=icons src="{{ asset('img/footer_bookmark.png')}}" alt="ブックマーク"></a>
        <a href="{{ route('shelters.index') }}"><img class=icons src="{{ asset('img/footer_comment.png')}}" alt="コメント"></a>
        <a href="#"><img class=icons src="{{ asset('img/footer_mypage.png')}}" alt="マイぺージ"></a>
    </div>
    
</footer>