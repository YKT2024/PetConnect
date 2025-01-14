@extends('layouts.footer')

  @section('css')
  {{-- css --}}
  <link rel="stylesheet" href="{{ asset('css/index_post.css') }}">
  <link rel="stylesheet" href="{{ asset('css/mypage_pet.css') }}">
  
  @endsection

    @section('content')
    <header>
    @auth
    <div class="top">
        <a href="#"><img src="{{ asset('img/return.png')}}" alt=""></a>
        <p>マイページ</p>
        <a href="{{ route('users.edit') }}"><img src="{{ asset('img/setting.png')}}" alt=""></a>
    </div>
    </header>

    <div class="container">
    @if ($pet)
        <div class="pet_img">
        <img src="{{ asset('storage/' . $pet->image_at)}}" alt="ペット">
        </div>
    </div>

    <hr>

    <div class="pet_profile">
        <p>{{ $pet->name }}</p>
        <p>1000かわいいね</p>
    </div>

    <div class="pet_comment">
        <p>{{ $pet->body }}</p>
    </div>

    @else
        <p>ペット情報が登録されていません</p>
    @endif

    <div  id="all-container" class="all_container">    

    @foreach ($posts as $index => $post)
        {{-- 1段目（1番目と2番目） --}}
        @if ($index == 0 || $index == 1)
            @if ($index == 0)
                <div class="row">
            @endif
            <a href="{{ route('posts.show', ['id' => $post->id]) }}">
            <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
            </a>
            @if ($index == 1)
                </div>
            @endif

        {{-- 2段目（3番目） --}}
        @elseif ($index == 2)
            <div class="row1">
            <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
            </div>

        {{-- 3段目（4番目と5番目） --}}
        @elseif ($index == 3 || $index == 4)
            @if ($index == 3)
                <div class="row">
            @endif
            <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
            @if ($index == 4)
                </div>
            @endif

        {{-- 4段目（6番目） --}}
        @elseif ($index == 5)
            <div class="row1">
            <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
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
