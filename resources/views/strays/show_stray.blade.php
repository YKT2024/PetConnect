@extends('layouts.footer')

@section('css')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/index_shelter.css') }}">
<link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
@endsection

    @section('content')
    <div class="top">
    <a href="{{ route('strays.index') }}"><img src="{{ asset('img/return.png')}}" alt="戻る"></a>
        <p>迷子情報</p>
    </div>
    </header>

    <div class="help_pet">
    <p class="{{ $stray->status == 1 ? 'status-searching' : 'status-found' }}">
    {{ $stray->status == 1 ? '探しています' : '保護・目撃' }}
    </div>

    <div class="containers">
    <div class="container">
        <div class="day_picture">
            <p>投稿日: {{ $stray->created_at->format('Y-m-d') }}</p>
            <img src="{{ $stray->image_at ? asset($stray->image_at) : asset('img/logo_defaultimg.png') }}" alt="迷子">
        </div>
        <div class="imformation">                    
            <p>ペットのなまえ: {{ $stray->name }}</p>
            <p>エリア: {{ $stray->area->area }}</p>
            <p>いなくなった日: {{ $stray->date }}</p>
            <p>カテゴリー: {{ $stray->pet_subcategory->subcategory ?? '不明' }}</p>
            <p>性別: {{ $stray->sex ?? '不明' }}</p>
            <p>備考: {{ $stray->body }}</p>
        </div>
    </div>
    </div>

    <hr>

    <div class="comment_pet">
        <a href="#">コメントする</a>
    </div>

@endsection