@extends('layouts.footer')

@section('css')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/index_shelter.css') }}">
<link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
@endsection

    @section('content')
    <header>
    <div class="top">
        <p>迷子情報</p>
    </div>
    </header>

    <div class="help_pet">
        <a href="#">探しています</a>
    </div>

    <div class="containers">
        <a href="#">
            <div class="container">
            <div class="day_picture">
                <p>投稿日:</p>
                <img src="{{asset('img/logo_defaultimg.png') }}" alt="迷子">
            </div>
            <div class="imformation">                    
                <p>ペットのなまえ:</p>
                <p>エリア:</p>
                <p>いなくなった日:</p>
                <p>カテゴリー:</p>
                <p>性別:</p>
                <p>色:</p>
            </div>
            </div>
        </a>
    </div>

    <hr>

    <div class="comment_pet">
        <a href="#">コメントする</a>
    </div>

@endsection