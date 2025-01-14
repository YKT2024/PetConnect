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
        <!-- フォーム開始 -->
        <form action="{{ route('shelters.update', $shelter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- PUT メソッドを指定 -->

        <div class="register">
        <!-- 避難施設名 -->
        <div class="input">
            <label for="shelter_name"><span class="asterisk">*</span>避難施設名</label>
            <input type="text" name="shelter_name" value="{{ old('shelter_name', $shelter->shelter_name) }}" placeholder="施設名" required>
        </div>

        <!-- エリアプルダウン -->
        <div class="input">
            <label for="area_id"><span class="asterisk">*</span>エリア</label>
            <select name="area_id" id="area_id" required>
                <option value="" disabled>どこで？〜</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $area->id == $shelter->area_id ? 'selected' : '' }}>
                        {{ $area->area }}
                    </option>
                @endforeach
        </select>
        </div>

        <!-- 詳細住所 -->
            <div class="input">
                <label for="address"><span class="asterisk">*</span>詳細住所</label>
                <input type="text" name="address" value="{{ old('address', $shelter->address) }}" required>
            </div>

        <!-- ラジオボタン (受け入れ態勢) -->
        <div class="radio">
            <span class="asterisk">*</span><label for="evacuation_type">受け入れ態勢</label>
            <div class="radio-btn">
                <label>
                    <input type="radio" name="evacuation_type" value="1" {{ $shelter->evacuation_type == 1 ? 'checked' : '' }} required>
                    同伴避難
                </label>
                <label>
                    <input type="radio" name="evacuation_type" value="0" {{ $shelter->evacuation_type == 0 ? 'checked' : '' }} required>
                    同室避難
                </label>
            </div>
        </div>

            
        <!-- 備考 -->
        <div class="input">
            <label for="body"><span class="asterisk">*</span>備考</label>
            <textarea id="body" name="body" rows="4" maxlength="280" placeholder="受け入れ数に上限あり など">{{ old('body', $shelter->body) }}</textarea>
        </div>
    </div>
                

        <!-- ボタン -->
        <div class="btn">
            <button type="submit" class="btn-1">更新する</button>
            <button type="button" class="btn-3" onclick="window.location.href='{{ route('shelters.index') }}'">キャンセル</button>
        </div>
    </form>

        <!-- 削除ボタン -->
        <div class="btn">
            <form action="{{ route('shelters.destroy', $shelter->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-2">削除</button>
            </form>
        </div>
    </main>
</body>
</html>