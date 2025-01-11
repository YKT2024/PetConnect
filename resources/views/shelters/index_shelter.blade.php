@extends('layouts.footer')

@section('css')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/index_shelter.css') }}">
@endsection

    @section('content')
    <header>
    <div class="top">
        <p>避難所情報</p>
    </div>
    </header>

    <div class="search">
        <form action="http://127.0.0.1:8010/shelters" method="get">
            <input type="search" name="search">
            <input type="submit" name="submit" value="  🔍  ">
        </form>
    </div>

    <div class="containers">
        <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
        </div>
        <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
        </div>
        <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
        </div>
        <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
        </div>
        <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
        </div>

    </div>


    <div class="pulus">
        <a href="">
            <span class="dli-plus-circle"><span></span></span>
        </a>
    </div>

@endsection
