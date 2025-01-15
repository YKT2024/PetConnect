<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>見る専？create</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_user.css') }}">
  
    <link rel="stylesheet" href="./register.css">
</head>
<body>
    {{-- ↓↓↓↓↓仮のヘッダーだよ↓↓↓↓ --}}
<header class="header-dayo">
    <div class="header-desu">アカウント登録・編集</div>
</header> 
    {{-- ↑↑↑↑仮のヘッダーだよ↑↑↑ --}}

    <main class="maincontent">
        <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="register">
                <div class="input">
                    <label for="accoutname"><span class="asterisk">*
                    </span>アカウント名</label>
                    <input type="text" name="accountname" value="{{ $user->name }}">
                </div>
                <div class="input">
                    <label for="address"><span class="asterisk">*</span>居住地</label>
                    <select name="address">
                        <option value="" disabled selected>{{ $user->area->area }}</option>
                         @foreach ($areas as $area)
                         <option value="{{ $area->id }}">{{ $area->area }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="input">
                    <label for="email"><span class="asterisk">*</span>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="input">
                    <label for="password"><span class="asterisk">*</span>パスワード</label>
                        <input type="password" name="password" placeholder="パスワードを入力してください">
                </div>
            </div>
            <div class="btn">
                <button type="submit" class="btn-1">次へ</button>
            </div>
        </form>
    </main>
    
</body>
</html>