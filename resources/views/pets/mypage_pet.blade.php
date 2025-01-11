@extends('layouts.footer')

  @section('css')
  {{-- css --}}
  <link rel="stylesheet" href="{{ asset('css/index_post.css') }}">
  <link rel="stylesheet" href="{{ asset('css/mypage_pet.css') }}">
  @endsection
{{-- </head> --}}

    @section('content')
    <header>
    @auth
    <div class="top">
        <a href="#"><img src="{{ asset('img/return.png')}}" alt=""></a>
        <p>マイページ</p>
        <a href="#"><img src="{{ asset('img/setting.png')}}" alt=""></a>
    </div>
    </header>

    <div class="container">
        <div class="pet_img">
            <img src="{{ asset('img/lion.jpg') }}" alt="ペット">
        </div>
    </div>

    <hr>

    <div class="pet_profile">
        <p>あゆちゃん</p>
        <p>29さい</p>
    </div>

    <div class="pet_comment">
        <p>穏やかな人間です</p>
    </div>

    <div  id="all-container" class="all_container">
    @php
        // ダミーデータ: 投稿画像のURLを仮で定義
        $dummyPosts = [
            'https://via.placeholder.com/200x150?text=1',
            'https://via.placeholder.com/200x150?text=2',
            'https://via.placeholder.com/200x150?text=3',
            'https://via.placeholder.com/200x150?text=4',
            'https://via.placeholder.com/200x150?text=5',
            'https://via.placeholder.com/200x150?text=6',
        ];
    @endphp

    {{-- ダミーデータで投稿画像を表示 --}}
    @foreach ($dummyPosts as $index => $post)
        {{-- 1段目（1番目と2番目） --}}
        @if ($index == 0 || $index == 1)
            @if ($index == 0)
                <div class="row"> {{-- 新しい行の開始 --}}
            @endif
            <img src="{{ asset('img/test1.jpg')}}" alt="ダミー画像">
            @if ($index == 1)
                </div> {{-- 行の終了 --}}
            @endif

        {{-- 2段目（3番目） --}}
        @elseif ($index == 2)
            <div class="row1">
                <img src="{{ asset('img/test1.jpg')}}" alt="ダミー画像">
            </div>

        {{-- 3段目（4番目と5番目） --}}
        @elseif ($index == 3 || $index == 4)
            @if ($index == 3)
                <div class="row">
            @endif
            <img src="{{ asset('img/test1.jpg')}}" alt="ダミー画像">
            @if ($index == 4)
                </div>
            @endif

        {{-- 4段目（6番目） --}}
        @elseif ($index == 5)
            <div class="row1">
                <img src="{{ asset('img/test1.jpg')}}" alt="ダミー画像">
            </div>
        @endif
    @endforeach
</div>
@else

<div class="guest">
    <div class="guest_top">
        <img src="{{ asset('img/logo_yoko.png')}}" alt="ロゴ">
    </div>
    <p>マイページは登録者のみご利用いただけます。</p>
    <a href="#">新規登録はこちら</a>
</div>

@endauth

@endsection
