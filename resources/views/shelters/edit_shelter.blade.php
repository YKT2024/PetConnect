<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>避難所情報編集</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_shelter.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
</head>
<body>
    <!--↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓-->
    <header class="header-dayo">
        <div class="header-desu">避難所情報編集</div>
    </header>
    <!--↑↑↑↑仮のヘッダーだよ↑↑↑↑-->

    <main class="maincontent">
        {{-- <form action="/submit" method="POST">
            @csrf --}}
            <div class="register">
                    <!-- 避難施設 -->
                    <div class="input">
                        <label for="shelter_name"><span class="asterisk">*</span>避難施設名</label>
                        <input type="text" name="accountname" placeholder="施設名" required>
                    </div>
                    <!-- エリアプル -->
                    <div class="input">
                        <label for="area_id"><span class="asterisk">*</span>エリア</label>
                        <select name="area_id" id="area_id" required>
                            <option value="" disabled selected>どこで？〜</option>
                            {{-- @foreach ($areas as $area)
                            <option value="#">{{ $area->area }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <!-- エリア手入力 -->
                    <div class="input">
                        <label for="address"><span class="asterisk">*</span>詳細住所</label>
                        <input type="text" name="address" id="address" value="#" required>
                    </div>
                    <!-- ラジオボタン -->
                    <div class="radio"><span class="asterisk">*</span><label for="contactInput">受け入れ態勢</label>
                        <div class="radio-btn">
                            <label>
                                <input type="radio" name="status" value="1" required>同伴避難
                            </label>
                            <label>
                                <input type="radio" name="status" value="0" required>同室避難
                            </label>
                        </div>
                    </div>
        {{-- ラジオボタンのデータベースからのあれ？ --}}
        {{-- 使えるか知らんけど、試してみてください --}}
        {{-- 選択されたやつがクリアになっててもいいなら --}}
                    {{-- <div class="radio">
                        <span class="asterisk">*</span>
                        <label for="contactInput">受け入れ態勢</label>
                        <div class="radio-btn">
                            <label>
                                <input type="radio" name="status" value="1" 
                                       {{ $post->evacuation_type == 1 ? 'checked' : '' }} required>同伴避難
                            </label>
                            <label>
                                <input type="radio" name="status" value="0" 
                                       {{ $post->evacuation_type == 0 ? 'checked' : '' }} required>同室避難
                            </label>
                        </div>
                    </div> --}}

                    
                    <!-- 備考 -->
                    <div class="input">
                        <label for="introduce"><span class="asterisk">*</span>備考</label>
                        <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="受け入れ数に上限あり など"></textarea>
                    </div>
                
                </div>
                <div class="btn">
                    <button type="submit" class="btn-1">更新</button>
                </div>
                <div class="btn">
                    <a href="#"></a><button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button></a>
                </div>
            {{-- </form> --}}
                <div class="btn">
                    {{-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                    @csrf
                    @method('DELETE') --}}
                    <button type="submit" class="btn-2">削除</button>
                    </form>
                </div>

    </main>  
</body>
</html>