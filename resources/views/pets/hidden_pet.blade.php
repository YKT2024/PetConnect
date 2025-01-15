<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>非表示登録</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_pet.css') }}">
</head>
<body>
    {{-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓--}}
    {{-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓--}}
    <header class="header-dayo">
        <div class="header-desu">非表示登録</div>
    </header>
    {{-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑--}}
</header>
{{-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑--}}

    <main class="maincontent">
        <form action="{{ route('hidden_pet.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
            <div class="register">
                <div class="hello">
                    <p>登録したカテゴリーは一覧に表示されなくなります</p>
                </div>
        
                <div class="input">
                    <label for="select_pettype2">カテゴリ2(種類)</label>
                    <select name="select_pettype2[]" id="select_pettype2_1">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="select_pettype2">カテゴリ2(種類)</label>
                    <select name="select_pettype2[]" id="select_pettype2_2">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="select_pettype2">カテゴリ2(種類)</label>
                    <select name="select_pettype2[]" id="select_pettype2_3">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="btn">
                    <button type="submit" class="btn-1">つぎへ</button>
                </div>             
        </form>
    </main>    
</body>
</html>
