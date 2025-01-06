<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PetConnect</title>
   {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')
   
</head> 
<body>
    
    <header>
        <div class="top">
            <img class="header_return" src="{{ asset('img/header_return.png') }}" alt="前のページに戻る">
            <div class="title">title（ページによって異なる）</div>
        </div>
    </header>
@yield('content')
