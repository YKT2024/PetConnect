<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アカウント登録</title>
    <link rel="stylesheet" href="{{ asset('/css/register.css') }}">
</head>
<body>
    {{-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓　--}}
<header class="header-dayo">
    <div class="header-desu">アカウント登録</div>
</header>
{{-- ↑↑↑↑仮のヘッダーだよ↑↑↑↑　--}}


    <main class="maincontent">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
             @csrf
            <div class="register">
                <div class="input">
                    <label for="name"><span class="asterisk">*</span>アカウント名</label>
                    <input type="text" id="name" name="name" placeholder="アカウント名" autocomplete="username" required>
                </div>
                <div class="input">
                    <label for="address"><span class="asterisk">*</span>居住地</label>
                    <select id="address" name="address" required>
                        <option value="" disabled selected>あなたのお家はどこですか〜</option>
                         @foreach ($areas as $area)
                         <option value="{{ $area->id }}">{{ $area->area }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="email"><span class="asterisk">*</span>Email</label>
                    <input type="email" id="email" name="email" placeholder="sample@example.com" autocomplete="email" required>
                </div>
                <div class="input">
                    <label for="password"><span class="asterisk">*</span>パスワード</label>
                        <input type="password" id="password" name="password" placeholder="パスワードを入力してください" required>
                </div>
            </div>
            <div class="btn">
                <button type="submit" class="btn-1">ペット情報の登録</button>
            </div>

            <div class="btn">
                <button type="button" class="btn-2" onclick="window.location.href='#'">ペット情報をスキップ</button>
            </div>
        </form>
    </main>
    
</body>
</html>