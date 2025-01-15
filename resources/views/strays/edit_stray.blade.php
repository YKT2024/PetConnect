<DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>迷子情報の編集</title>
        <link rel="stylesheet" href="{{ asset('/css/edit_stray.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    </head>    
    <body>
    <!--↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓-->
    <header class="header-dayo">
        <div class="header-desu">迷子情報の編集</div>
    </header>
    <!--↑↑↑↑仮のヘッダーだよ↑↑↑↑-->
    
<main class="maincontent">
        <form action="{{ route('strays.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- PUT メソッドを指定 -->
                <div class="register">
                    <section class="section1">
                        <!-- 画像アップロード -->
                        <div class="photo-upload">
                            <div class="photo-frame">
                                <img id="photo-preview" src="{{ asset($stray->image_at ?? 'img/defaultimg.png') }}" alt="Uploaded Image">
                                <input type="file" name="photo" id="photo-input" accept="image/png, image/jpeg" hidden>
                                <label for="photo-input" class="upload-button">+</label>
                            </div>
                        </div>
                        <!-- ラジオボタン -->
                        <div class="radio"><span class="asterisk">*</span><label for="contactInput">状況</label>
                        <div class="radio-btn">
                            <label>
                                <input type="radio" name="status" value="1" {{ $stray->status == 1 ? 'checked' : '' }} required> 探しています
                            </label>
                            <label>
                                <input type="radio" name="status" value="0" {{ $stray->status == 0 ? 'checked' : '' }} required> 保護・目撃
                            </label>
                        </div>
                            </div>
                    <!-- ペットの名前 -->
                    <div class="input">
                        <label for="accoutname"><span class="asterisk">*</span>ペットの名前</label>
                        <input type="text" name="accountname" value="{{ old('accountname', $stray->name) }}" placeholder="不明の場合は「なし」と記入" required>
                    </div>
                    <!-- エリアプル -->
                    <div class="input">
                    <label for="area_id"><span class="asterisk">*</span>エリア</label>
                    <select name="area_id" id="area_id" required>
                    <option value="" disabled>どこで？〜</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ $area->id == $stray->area_id ? 'selected' : '' }}>
                            {{ $area->area }}
                        </option>
                    @endforeach
                </select>

                </div>
                    <!-- エリア手入力 -->
                    <div class="input">
                    <label for="address_detail"><span class="asterisk">*</span>エリア詳細</label>
                    <input type="text" name="address_detail" id="address_detail" value="{{ old('address_detail', $stray->address) }}" placeholder="具体的にはどこですか〜" required>
                    </div>

                    <!-- いなくなった・見つけた日 -->
                    <div class="input">
                        <label for="date"><span class="asterisk">*</span>いなくなった日・見かけた日</label>
                        <input type="date" name="date" value="{{ old('date', $stray->date) }}" required>
                        
                    </div>
                </section>  
                <div class="pet-info">ペット情報</div>  
                <section class="section2">
                    <!-- カテゴリ-->
                    <div class="input">
                        <label for="select_pettype2"><span class="asterisk">*</span>カテゴリ</label>
                        <select name="select_pettype2" required>
                        <option value="" disabled>ペットの種類なんですか〜</option>
                        @foreach ($pet_subcategories as $pet_subcategorie)
                            <option value="{{ $pet_subcategorie->id }}" {{ $pet_subcategorie->id == $stray->pet_subcategory_id ? 'selected' : '' }}>
                                {{ $pet_subcategorie->subcategory }}
                            </option>
                        @endforeach
                    </select>

                </div>

                    
                    <!-- 性別 -->
                    <div class="input">
                        <label for="select_pettype">性別</label>
                        <select name="petssex">
                            <option value="">ペットの性別はなんですか〜</option>
                            <option value="male" {{ $stray->sex == 'male' ? 'selected' : '' }}>オス</option>
                            <option value="female" {{ $stray->sex == 'female' ? 'selected' : '' }}>メス</option>
                            <option value="other" {{ $stray->sex == 'other' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>

                    <!-- 年齢 -->
                    <div class="input">
                        <label for="age">年齢</label>
                        <input class="harfinput" type="number" name="age" value="{{ old('age', $stray->age) }}" placeholder="いくつですか〜">
                    </div>
                    <!-- 体重・体長 -->
                    <div class="input">
                            <!-- 体重 -->
                            <label for="weight">おおよその体重</label>
                            <div class="input-unit">
                                <!-- <span>約</span> -->
                                <input type="number" name="weight" value="{{ old('weight', $stray->weight) }}" min="1" placeholder="体重">
                                <span>kg</span>
                            </div>
                                <!-- 体長 -->
                            <label for="height">おおよその体長</label>
                            <div class="input-unit">
                                <!-- <span>約</span> -->
                                <input type="number" name="height" value="{{ old('height', $stray->height) }}" min="1" placeholder="体長">
                                <span>cm</span>
                        </div>
                    </div>
                    <!-- 備考 -->
                    <div class="input">
                        <label for="introduce"><span class="asterisk">*</span>備考</label>
                        <textarea id="introduce" name="introduce" rows="4" maxlength="280" placeholder="ペットのなまえや、色など">{{ old('introduce', $stray->body) }}</textarea>
                    </div>
                </section> 
                </div>
                <div class="btn">
                <div class="btn1">
                    <button type="submit" class="btn-1">更新する</button>
    </form>
                <div class="btn2">
                <form action="{{ route('strays.destroy', $stray->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');"> 
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn-2">削除</button>
                </form>
                </div>
                <button type="button" class="btn-3" onclick="window.location.href='{{ route('strays.index') }}'">キャンセル</button>
                </div>
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