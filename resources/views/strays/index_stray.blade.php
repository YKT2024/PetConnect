@extends('layouts.footer')

@section('css')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/index_shelter.css') }}">
@endsection

    @section('content')
    <header>
    <div class="top">
        <p>迷子情報</p>
    </div>
    </header>

    <div class="search">
        <form action="http://127.0.0.1:8010/strays" method="get">
            <input type="search" name="search">
            <input type="submit" name="submit" value="  🔍  ">
        </form>
    </div>

    <div class="imformation_pet">
        <a href="#">お知らせ</a>
    </div>

    <div class="containers">
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/strays.jpg')}}" alt="迷子">
            <div class="imformation">
                <p>探していますor見かけました</p>
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/strays.jpg')}}" alt="迷子">
            <div class="imformation">
                <p>探していますor見かけました</p>
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/strays.jpg')}}" alt="迷子">
            <div class="imformation">
                <p>探していますor見かけました</p>
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/strays.jpg')}}" alt="迷子">
            <div class="imformation">
                <p>探していますor見かけました</p>
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/strays.jpg')}}" alt="迷子">
            <div class="imformation">
                <p>探していますor見かけました</p>
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
    </div>


    <div class="pulus">
        <a href="">
            <span class="dli-plus-circle"><span></span></span>
        </a>
    </div>

@endsection
