@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>ようこそ！</h1>
        <p>あなたのコミュニティとつながりましょう。</p>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = '/posts';
        }, 1500); // 1.5秒後にリダイレクト
    </script>
@endsection
