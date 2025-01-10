{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規投稿おペット自慢</title> --}}
    @extends('layouts.footer')

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/index_post.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/create_post.css') }}">
    @endsection
{{-- </head>
<body> --}}
<!-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓--}} -->
    @section('content')
<header class="header-dayo">
        <div class="header-desu">新規投稿</div>
    </header>
<!-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑　--}} -->

<main class="maincontent">
    <form action="{{ route('create_post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="photo-upload">
            <div class="photo-frame">
                <img id="photo-preview" src='{{asset( 'img/logo.png')}}' alt="Default Image">
                <input type="file" id="photo-input" name="photo-input" accept="image/*" hidden>
                <label for="photo-input" class="upload-button">+</label>
            </div>
        </div>
        <div class="input">
            <label for="introduce">コメント</label>
            <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="ペット自慢。280文字"></textarea>
        </div>
        <div class="btn">
            <button type="submit" class="btn-1">投稿</button>
        </div>
        <div class="btn">
            <a href="#"></a><button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button></a>
        </div>
    </form>
</main>

<script>
    document.getElementById('photo-input').addEventListener('change', function(event) {
const file = event.target.files[0];
if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('photo-preview').src = e.target.result;
    };
    reader.readAsDataURL(file);
}
});
</script>
@endsection

{{-- </body>
</html> --}}
