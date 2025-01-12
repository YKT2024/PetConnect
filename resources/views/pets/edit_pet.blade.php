<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>おペットの編集</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_pet.css') }}">
</head>
<body>
    {{-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓--}}
<header class="header-dayo">
    <div class="header-desu">ペット情報編集</div>
</header>
{{-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑--}}

    <main class="maincontent">
        <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="register">
                <div class="photo-upload">
                    <div class="photo-frame">
                        <img id="photo-preview" src="{{ $pet->image_at ? asset('storage/' . $pet->image_at) : asset('img/defaultimg.png') }}" alt="Pet Image">
                        <input type="file" id="photo-input" name="photo-input" accept="image/*" hidden>
                        <label for="photo-input" class="upload-button">+</label>
                    </div>
                </div>
                <div class="input">
                    <label for="accoutname"><span class="asterisk">*</span>ペットの名前</label>
                    <input type="text" name="accountname" value="{{ $pet->name }}">
                </div>
                <div class="input">
                    <label for="select_pettype"><span class="asterisk">*</span>カテゴリ1(分類)</label>
                    <select name="select_pettype" id="select_pet" required>
                        <option value="{{ $pet->pet_category_id }}" disabled selected>{{ $pet->pet_category->category }}</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="select_pettype2"><span class="asterisk">*</span>カテゴリ2(種類)</label>
                    <select name="select_pettype2" required>
                        <option value="{{ $pet->pet_subcategory_id }}" disabled selected>{{ $pet->pet_subcategory->subcategory }}</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="select_pettype3">ペットの種類</label>
                    <input type="text" name="select_pettype3" value="{{ $pet->pet_breed }}">
                </div>
                <div class="input">
                    <label for="birthday">誕生年月</label>
                    <input class="halfinput" type="number" name="birth_year" min="2020" max="2100" value="{{ $pet->birth_year }}">
                        <input class="halfinput" type="number" name="birth_month" min="1" max="12" value="{{ $pet->birth_month }}">
                </div>
                <div class="input">
                    <label for="select_pettype">性別</label>
                    <select name="petssex" id="petssex">
                        <option value="" disabled selected>{{ $pet->sex }}</option>
                         <option value="オス">オス</option>
                         <option value="メス">メス</option>
                         <option value="その他">その他</option>
                    </select>
                </div>
                <div class="input">
                    <label for="pickupday">お迎え日</label>
                    <input class="halfinput" type="date" name="pickupday" value="{{ $pet->pick_up_date }}">
                </div>
                <div class="input">
                    <label for="introduce">ペットの紹介</label>
                    <textarea id="introduce" name="introduce" rows="4" maxlength="200">{{ $pet->body }}</textarea>
                </div>
            </div>
                <div class="btn">
                    <button type="submit" class="btn-1">登録</button>
                </div>
                <div class="btn">
                    <button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button>
                </div>
        </form>
                <div class="btn">
                    <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-2">削除</button>
                    </form>
                </div>        
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