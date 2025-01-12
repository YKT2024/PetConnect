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

    <div class="search">
        <form action="{{ route('strays.index') }}" method="GET">
            <input type="search" name="search">
            <input type="submit" name="submit" value="  🔍  ">
        </form>
    </div>

    <div class="imformation_pet">
        <a href="#">お知らせ</a>
    </div>

    <div class="containers">
    @foreach ($strays as $stray)
        <a href="#">
            <div class="container">
            <img src="{{ $stray->image_at ? asset($stray->image_at) : asset('img/logo_defaultimg.png') }}" alt="迷子">
                <div class="imformation">                    
                    <p>{{ $stray->status == 1 ? '探しています' : '見かけました' }}</p>
                    <p>エリア: {{ $stray->area->area }}</p>
                    <p>場所: {{ $stray->address }}</p>
                </div>
            </div>
        </a>
    @endforeach
    </div>

    <div class="pulus">
        <a href="{{ route('strays.create') }}">
            <span class="dli-plus-circle"><span></span></span>
        </a>
    </div>
@endsection