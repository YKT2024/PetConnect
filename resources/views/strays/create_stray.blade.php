<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>迷子情報の投稿</title>
        <link rel="stylesheet" href="{{ asset('/css/create_stray.css') }}">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    </head>
<body>
    <!--↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓-->
    <header class="header-dayo">
        <div class="header-desu">迷子情報の投稿</div>
    </header>
    <!--↑↑↑↑仮のヘッダーだよ↑↑↑↑-->

    <main class="maincontent">
        <form action="{{ route('strays.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="register">
            <section class="section1">
        <!-- 画像アップロード -->
        <div class="photo-upload">
        <div class="photo-frame">
            <img id="photo-preview" src="{{ asset('img/defaultimg.png') }}" alt="Default Image">
            <input type="file" name="photo" id="photo-input" accept="image/png, image/jpeg" hidden>
            <label for="photo-input" class="upload-button">+</label>
            </div>
        </div>
                    <!-- ラジオボタン -->
                    <div class="radio"><span class="asterisk">*</span><label for="contactInput">状況</label>
                        <div class="radio-btn">
                            <label>
                                <input type="radio" name="status" value="1" required>探しています
                            </label>
                            <label>
                                <input type="radio" name="status" value="0" required>保護・目撃
                            </label>
                        </div>
                    </div>
                    <!-- ペットの名前 -->
                    <div class="input">
                        <label for="accoutname"><span class="asterisk">*</span>ペットの名前</label>
                        <input type="text" name="accountname" placeholder="不明の場合は「なし」と記入"required>
                    </div>
                    <!-- エリアプル -->
                    <div class="input">
                    <label for="area_id"><span class="asterisk">*</span>エリア</label>
                    <select name="area_id" id="area_id" required>
                        <option value="" disabled selected>どこで？〜</option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                </div>

                    <!-- エリア手入力 -->
                    <div class="input">
                    <label for="address_detail"><span class="asterisk">*</span>エリア詳細</label>
                    <input type="text" name="address_detail" id="address_detail" placeholder="具体的にはどこですか〜" required>
                    </div>

                    <!-- いなくなった・見つけた日 -->
                    <div class="input">
                        <label for="date"><span class="asterisk">*</span>いなくなった日・見かけた日</label>
                        <input type="date" name="date" required>
                        
                    </div>
                </section>  
                <div class="pet-info">ペット情報</div>  
                <section class="section2">
                    <!-- カテゴリ-->
                    <div class="input">
                        <label for="select_pettype2"><span class="asterisk">*</span>カテゴリ</label>
                        <select name="select_pettype2" required>
                        <option value="" disabled selected>ペットの種類なんですか〜</option>
                        @foreach ($pet_subcategories as $pet_subcategorie)
                            <option value="{{ $pet_subcategorie->id }}">{{ $pet_subcategorie->subcategory }}</option>
                        @endforeach
                        </select>
                </div>

                    
                    <!-- 性別 -->
                    <div class="input">
                        <label for="select_pettype">性別</label>
                        <select name="petssex">
                            <option value="">ペットの性別はなんですか〜</option> <!-- nullに対応 -->
                            <option value="male">オス</option>
                            <option value="female">メス</option>
                            <option value="other">その他</option>
                        </select>
                    </div>

                    <!-- 年齢 -->
                    <div class="input">
                        <label for="age">年齢</label>
                            <input class="harfinput" type="number" name="age" placeholder="いくつですか〜">
                    </div>
                    <!-- 体重・体長 -->
                    <div class="input">
                            <!-- 体重 -->
                            <label for="weight">おおよその体重</label>
                            <div class="input-unit">
                                <!-- <span>約</span> -->
                                <input type="number" name="weight" min="1" placeholder="体重">
                                <span>kg</span>
                            </div>
                                <!-- 体長 -->
                            <label for="height">おおよその体長</label>
                            <div class="input-unit">
                                <!-- <span>約</span> -->
                                <input type="number" name="height" min="1" placeholder="体長">
                                <span>cm</span>
                        </div>
                    </div>
                    <!-- 備考 -->
                    <div class="input">
                        <label for="introduce"><span class="asterisk">*</span>備考</label>
                        <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="ペットのなまえや、色など"></textarea>
                    </div>
                </section> 
            </div>
            <div class="btn">
                <button type="submit" class="btn-1">登録</button>
            </div>
            <div class="btn">
                <button type="button" class="btn-3" onclick="window.location.href='#'">キャンセル</button>
            </div>
        <!-- </form> -->
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