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
        @foreach($shelters as $shelter)
        <a href="#">
            <div class="container">
                <img src="{{ $shelter->image_at }}" alt="避難所">
              <div class="imformation">
                <p>エリア:{{ $shelter->area->area }}</p>
                <p>施設名:{{ $shelter->shelter_name }}</p>
              </div>
            </div>
        </a>
        @endforeach
    </div>

    
    {{-- <div class="containers">
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
        <a href="#">
            <div class="container">
            <img src="{{ asset('img/shelter.jpg')}}" alt="避難所">
            <div class="imformation">
                <p>エリア:長崎</p>
                <p>施設名:がんばらんど</p>
            </div>
            </div>
        </a>
    </div> --}}


    <div class="pulus">
        <a href="">
            <span class="dli-plus-circle"><span></span></span>
        </a>
    </div>

@endsection
