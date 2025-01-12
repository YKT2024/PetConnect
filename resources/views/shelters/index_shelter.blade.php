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
    <form action="{{ route('shelters.index') }}" method="GET">
        <input type="search" name="search" placeholder="検索キーワード">
        <label>
            <input type="radio" name="filter" value="mine"> 自分の投稿
        </label>
        <label>
            <input type="radio" name="filter" value="all" checked> すべて
        </label>
        <input type="submit" name="submit" value="  🔍  ">
    </form>
</div>

<div class="results">
    @foreach ($shelters as $shelter)
        <div class="container">
            <h3>{{ $shelter->shelter_name }}</h3>
            <p>{{ $shelter->address }}</p>
            <p>{{ $shelter->body }}</p>
        </div>
    @endforeach
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
