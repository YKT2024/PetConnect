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
        <input type="text" name="search" placeholder="キーワードで検索" value="{{ request('search') }}">
        <label>
            <input type="radio" name="filter" value="mine" {{ request('filter') === 'mine' ? 'checked' : '' }}> 自分の投稿
        </label>
        <label>
            <input type="radio" name="filter" value="all" {{ request('filter', 'all') === 'all' ? 'checked' : '' }}> すべて
        </label>
        </br>
        <button type="submit">検索 🔍</button>
    </form>
</div>


    <div class="containers">
        @foreach($shelters as $shelter)
        <a href="{{ route('shelters.show', $shelter->id) }}">
            <div class="container">
                <div class="imformation">
                    <p class="{{ $shelter->evacuation_type == 1 ? 'status-searching' : 'status-found' }}">
                    {{ $shelter->evacuation_type == 1 ? '同伴避難' : '同室避難' }}</p>
                    <p>エリア：{{ $shelter->area->area }}</p>
                    <p>施設名：{{ $shelter->shelter_name }}</p>
                    <p>住所：{{ $shelter->address }}</p>
                    <p>コメント数：{{ $shelter->comments->count() }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    
    <!-- {{-- <div class="containers">
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
    </div> --}} -->


    <div class="pulus">
        <a href="{{ route('shelters.create') }}">
            <span class="dli-plus-circle"><span></span></span>
        </a>
    </div>

@endsection
