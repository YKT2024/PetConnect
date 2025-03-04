@extends('layouts.footer')

@section('css')
{{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show_shelter.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
</head>
<body>

<header class="header-dayo">
    <button onclick="window.history.back()"><img src="{{ asset('img/return.png')}}" alt=""></button>
    <div class="header-desu">投稿詳細</div>    
</header>


    <main class="maincontent">
        <section class="section1">
            <div class="edit-btn">
                @if ($isOwner) <!-- 自分の投稿なら「編集」リンクを表示 -->
                    <a href="{{ route('shelters.edit', $shelter->id) }}" class="my-edit-link">編集</a>
                @endif
            </div>
            <div class="area-name">
                <p>{{ $shelter->area->area }}</p> <!-- エリア名を表示 -->
            </div>
            <div class="shelter-name">
                <p>施設名</p>
                <h1>{{ $shelter->shelter_name }}</h1> <!-- 避難所名を表示 -->
            </div>
        </section>

        <section class="section2">
        <div class="sectionarea">
            <div class="icon-area">
                <div class="icon">
                    <img src="{{ $icon ? asset('storage/' . $icon) : asset('img/logo_defaultimg.png') }}" alt="アイコン">
                </div>
                <div class="user_name">
                    <span class="value">{{ $userName }}</span>
                </div>
            </div>


            <div class="details">
                <div class="title">
                        <span class="label">投 稿 日：</span>
                </div>
                <div class="info">
                    <span class="value">{{ $shelter->created_at->format('Y-m-d') }}</span> <!-- 作成日時を表示 -->
                </div>
            </div>
            <div class="details">
                <div class="title">
                    <span class="label">住　　所：</span>
                </div>
                <div class="info">
                    <span class="value">{{ $shelter->address }}</span> <!-- 住所を表示 -->
                </div>
            </div>
            <div class="details">
                <div class="title">
                    <span class="label">避難態勢：</span>
                </div>
                <div class="info">
                    <span class="value">
                        {{ $shelter->evacuation_type ? '同伴避難' : '同室避難' }} <!-- 避難態勢を表示 -->
                    </span>
                </div>
            </div>
            <div class="details">
                <div class="title">
                    <span class="label">備　　考：</span>
                </div>
                <div class="info">
                    <span class="value">{{ $shelter->body }}</span> <!-- 備考を表示 -->
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>

    <!-- コメント一覧を更新する関数 -->
        <div class="comment">
            <div class="btn">
                <button class="btn-1" id="commentBtn">コメントする</button>
            </div>

        {{-- モーダルウィンドウ --}}
            <div id="commentModal">
                <div class="modal-content">
        {{-- コメント機能 ここの下もあってるかわからん --}}
            <form action="{{ route('shelters.comments.store', $shelter->id) }}" method="POST">
            @csrf
            <textarea name="body" maxlength="150" placeholder="コメントを入力" required></textarea>
                <button type="submit">コメント投稿</button>
                <button type="button" id="cancelBtn" class="cancel-btn">キャンセル</button>
            </div>
            </form>
        </div>
            </div>

{{-- コメントリストを表示 --}}
<div id="commentList">
    {{-- コメントをループで表示 --}}
    @foreach($comments as $comment)
        <div class="caption-comment">
            {{-- アイコンエリア --}}
            <div class="icon-area">
                <div class="icon">
                    {{-- 投稿者のアイコン画像を取得 --}}
                    <img src="{{ $icon ? asset('storage/' . $icon) : asset('img/logo_defaultimg.png') }}" alt="アイコン">
                </div>
            </div>
            
            {{-- コメント内容 --}}
            <div class="caption">
                <p><strong>{{ $comment->user->name ?? '匿名' }}:</strong> {{ $comment->body }}</p>
            </div>

            {{-- コメント削除ボタン --}}
            @if(auth()->id() === $comment->user_id) {{-- 自分のコメントのみ削除可能 --}}
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('コメントを削除しますか？')">
                    @csrf
                    @method('DELETE')
                    <button class="btn-4" type="submit">削除</button>
                </form>
            @endif
        </div>
    @endforeach
</div>

<!-- {{-- コメントのためのモーダル --}} -->
<!-- {{-- コメントされた際の表示 --}} -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // コメントリスト用の配列を宣言
        let comments = []; // 修正ポイント: 配列を適切に定義
    
        // コメント投稿ボタン
        document.getElementById('commentBtn').addEventListener('click', function() {
            document.getElementById('commentModal').style.display = 'flex';
        });
    
        // コメント投稿キャンセルボタン
        document.getElementById('cancelBtn').addEventListener('click', function() {
            document.getElementById('commentModal').style.display = 'none';
        });
    
        // コメントフォームの送信処理
        document.getElementById('commentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // ページリロードを防ぐ
    
            const commentText = this.querySelector('textarea[name="comment"]').value;
    
            if (commentText.trim() === '') {
                alert('コメントを入力してください！');
                return;
            }
    
            // 新しいコメントを配列に追加
            const newComment = {
                text: commentText,
                userId: 'user123', // 仮のユーザーID
            };
            comments.push(newComment);
    
            updateComments(); // コメント一覧を更新
    
            document.getElementById('commentModal').style.display = 'none';
            this.reset();
        });
    
        // コメント一覧を更新する関数
        function updateComments() {
            const commentList = document.getElementById('commentList');
            commentList.innerHTML = ''; // リストをクリア
    
            comments.forEach((comment, index) => {
                const commentItem = document.createElement('div');
                commentItem.classList.add('caption-comment');
    
                const iconArea = document.createElement('div');
                iconArea.classList.add('icon-area');
                const icon = document.createElement('div');
                icon.classList.add('icon');
                const img = document.createElement('img');
                img.src = '{{ asset("images/postedimg3.png") }}';
                img.alt = 'アイコン';
                icon.appendChild(img);
                iconArea.appendChild(icon);
    
                const caption = document.createElement('div');
                caption.classList.add('caption');
                const p = document.createElement('p');
                p.textContent = comment.text;
                caption.appendChild(p);
    
                const deleteButton = document.createElement('button');
                deleteButton.classList.add('btn-4', 'delete-btn');
                deleteButton.textContent = '削除';
                deleteButton.dataset.index = index;
    
                // 削除ボタンのクリックイベント
                deleteButton.addEventListener('click', function() {
                    const confirmDelete = window.confirm('このコメントを削除しますか？');
                    if (confirmDelete) {
                        comments.splice(index, 1); // 配列から削除
                        updateComments(); // リストを更新
                    }
                });
    
                commentItem.appendChild(iconArea);
                commentItem.appendChild(caption);
                commentItem.appendChild(deleteButton);
                commentList.appendChild(commentItem);
            });
        }
    });

// 文字数の制限に関するjs

document.addEventListener('DOMContentLoaded', () => {
        // 各投稿を処理
        document.querySelectorAll('.post-body').forEach((postBody, index) => {
            const fullText = postBody.getAttribute('data-full-text');

            // "続きを読む" ボタンの表示・非表示を制御
            const readMoreBtn = document.querySelectorAll('.read-more-btn')[index];
            if (fullText.length > 80) {
                readMoreBtn.style.display = 'inline-block'; // 80文字を超える場合のみ表示
            }

            // "続きを読む" ボタンのクリックイベント
            readMoreBtn.addEventListener('click', () => {
                postBody.textContent = fullText; // 全文を表示
                readMoreBtn.style.display = 'none'; // ボタンを隠す
            });
        });
    });


// いいねボタンくりっくでいろかわるとこ

    document.addEventListener('DOMContentLoaded', function () {
  // 対象のクラス名を配列で管理
    var targetClasses = ['likeButton', 'likeButton2'];

  // 各クラスごとに処理を実行
    targetClasses.forEach(function (className) {
    var buttons = document.getElementsByClassName(className);

    Array.from(buttons).forEach(function (button, index) {
    // 各ボタンに固有のキーを生成
        var storageKey = className + '_' + index;

    // ページ読み込み時に状態を反映
        var isLiked = localStorage.getItem(storageKey);
        if (isLiked === 'true') {
        button.classList.add('liked'); // 保存された状態を反映
        }

    // ボタンがクリックされたときに状態を保存
        button.addEventListener('click', function () {
        button.classList.toggle('liked');
        var isLikedNow = button.classList.contains('liked');
        localStorage.setItem(storageKey, isLikedNow); // 状態を保存
        });
    });
    });
}, false);
</script>

@endsection