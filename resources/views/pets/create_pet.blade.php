<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>おペットの登録(あとから？)</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_pet.css') }}">
</head>
<body>
    {{-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓--}}
<header class="header-dayo">
    <div class="header-desu">ペット情報編集</div>
</header>
{{-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑--}}

    <main class="maincontent">
        <form action="{{ route('create_pet.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
            <div class="register">
                <div class="photo-upload">
                    <div class="photo-frame">
                        <img id="photo-preview" src="defaultimg.png" alt="Default Image">
                        <input type="file" id="photo-input" accept="image/*" hidden>
                        <label for="photo-input" class="upload-button">+</label>
                    </div>
                </div>
                <div class="input">
                    <label for="accoutname"><span class="asterisk">*</span>ペットの名前</label>
                    <input type="text" name="accountname" placeholder="お名前なんですか〜" required>
                </div>
                <div class="input">
                    <label for="select_pettype"><span class="asterisk">*</span>カテゴリ1(分類)</label>
                    <select name="select_pettype" id="select_pet" required>
                        <option value="" disabled selected>ペットの分類なんですか〜</option>
                         @foreach ($categories as $category)
                         <option value="{{ $category->id }}">{{ $category->category }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="select_pettype2"><span class="asterisk">*</span>カテゴリ2(種類)</label>
                    <select name="select_pettype2" required>
                        <option value="" disabled selected>ペットの種類なんですか〜</option>
                         @foreach ($subcategories as $subcategory)
                         <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="select_pettype3">ペットの種類</label>
                    <input type="text" name="select_pettype3" placeholder="具体的にはなんですか〜">
                </div>
                <div class="input">
                    <label for="birth_year">誕生年</label>
                    <input name="birth_year">
                </div>
                <div class="input">
                    <label for="birth_month">誕生月</label>
                    <input name="birth_month">
                </div>
                <div class="input">
                    <label for="select_pettype">性別</label>
                    <select name="petssex">
                        <option value="" disabled selected>ペットの性別はなんですか〜</option>
                           {{-- データベースできたらこの上の1行消してここから下を生かす --}}
                         {{-- @foreach ($pets as $pet) --}}
                         {{-- <option value="{{ $pet->sex }}">{{ $pet->sex}}</option> --}}
                         {{-- @endforeach --}}
                    </select>
                </div>
                <div class="input">
                    <label for="pickupday">お迎え日</label>
                    <input type="date" name="pickupday">
                </div>
                <div class="input">
                    <label for="introduce">ペットの紹介</label>
                    <textarea id="introduce" name="introduce" rows="4" maxlength="200" placeholder="ペットの紹介を入力してください。200文字"></textarea>
                </div>
            </div>
                <div class="btn">
                    <button type="submit" class="btn-1">登録</button>
                </div>
                <div class="btn">
                    <button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button>
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