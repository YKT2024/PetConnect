<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>避難所新規登録</title>
    <link rel="stylesheet" href="{{ asset('/css/create_shelter.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
</head>
<body>
    <!--↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓-->
    <header class="header-dayo">
        <div class="header-desu">避難所新規登録</div>
    </header>
    <!--↑↑↑↑仮のヘッダーだよ↑↑↑↑-->

    <main class="maincontent">
        {{-- <form action="/submit" method="POST">
            @csrf --}}
            <div class="register">
            <section class="section1">
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
                        {{-- @foreach ($areas as $area) --}}
                        {{-- <option value="#">{{ $area->area }}</option> --}}
                        {{-- @endforeach --}}
                    </select>
                </div>

                    <!-- エリア手入力 -->
                    <div class="input">
                        <label for="address"><span class="asterisk">*</span>詳細住所</label>
                        <input type="text" name="address" id="address" placeholder="〇〇町△△×町目◻︎◻︎" required>
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
                    <!-- 備考 -->
                    <div class="input">
                        <label for="introduce"><span class="asterisk">*</span>備考</label>
                        <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="受け入れ数に上限あり など"></textarea>
                    </div>
                </section> 
                </div>
                <div class="btn">
                    <button type="submit" class="btn-1">登録</button>
                </div>
                <div class="btn">
                    <button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button>
                </div>
    </main>  
</body>
</html>