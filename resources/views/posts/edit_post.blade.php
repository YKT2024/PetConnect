
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿編集</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_post.css') }}">
    <link rel="stylesheet" href="./edit_post.css">
</head>
<body>
<!-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓--}} -->
<header class="header-dayo">
        <div class="header-desu">投稿編集</div>
    </header>
<!-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑　--}} -->

<main class="maincontent">
    <form action="{{ route('create_post.store') }}" method="POST" enctype="multipart/form-data">
        <!-- @csrf -->
        <div class="photo-upload">
            <div class="photo-frame">
                 <img id="photo-preview" src='{{ asset('img/nino.JPG') }}' alt="Posted Image">
                <!-- 上の1行を消してここを編集する　データベース経由でどっかに入れられてる投稿写真を表示 -->
                  {{-- <img id="photo-preview" src="{{ $post->image_at }}" alt=""> --}}
                <input type="file" id="photo-input" name="photo-input" accept="image/*" hidden>
                <label for="photo-input" class="upload-button">+</label>
            </div>
        </div>
        <div class="input">
            <!-- <label for="introduce">コメント</label> -->
            <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="280文字" >ここに投稿したペット自慢が表示されるはずです。どなたか親切な方、ここにpostsテーブルからbodyを見つけてきてください</textarea>
            <!-- 上の1行消してここ変更する　postsテーブルから投稿内容をとってくる -->
            <!-- <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="ペット自慢。280文字">{{ $post->body }}</textarea> -->
        </div>
        <div class="btn">
            <button type="submit" class="btn-1">更新</button>
        </div>
        <div class="btn">
            <a href="#"></a><button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button></a>
        </div>
        <div class="btn">
             <!-- この下の行ルートつながったら変更 --}} -->
             <!-- <form action="{{ route('') }}" method="POST" onsubmit="return confirm('本当に削除しますか？')"> --}} -->
             <!-- @csrf --}} -->
             <!-- @method('DELETE') --}} -->
            <button type="submit" class="btn-2">削除</button>
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
</body>
</html>