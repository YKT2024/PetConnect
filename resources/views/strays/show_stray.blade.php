@extends('layouts.footer')

@section('css')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/show_stray.css') }}">
<link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
@endsection

    @section('content')
    <header>
    <div class="top">
        <button onclick="window.history.back()"><img src="{{ asset('img/return.png')}}" alt=""></button>
        <p>迷子情報</p>
    </div>
    </header>

    <div class="help_pet">
    <p class="{{ $stray->status == 1 ? 'status-searching' : 'status-found' }}">
        {{ $stray->status == 1 ? '探しています' : '保護・目撃' }}
    </p>

    <!-- 自分の投稿なら「編集」リンクを表示 -->
    @if ($isOwner)
    <a href="{{ route('strays.edit', $stray->id) }}" class="my-edit-link">編集</a>
    @endif
</div>

    <div class="containers">
    <div class="container">
        <div class="day_picture">
            <p>投稿日: {{ $stray->created_at->format('Y-m-d') }}</p>
            <div class="icon-area">
                <div class="icon">
                    <img src="{{ $icon ? asset('storage/' . $icon) : asset('img/logo_defaultimg.png') }}" alt="アイコン">
                </div>
                <div class="user_name">
                    <span class="value">{{ $userName }}</span>
                </div>
            </div>

                {{-- <span class="value">{{ $userName }}</span> --}}
                <img src="{{ $stray->image_at ? asset($stray->image_at) : asset('img/logo_defaultimg.png') }}" alt="迷子">
        </div>
        <div class="imformation">                    
            <p>ペットのなまえ: {{ $stray->name }}</p>
            <p>エリア: {{ $stray->area->area }}</p>
            <p>いなくなった日: {{ $stray->date }}</p>
            <p>カテゴリー: {{ $stray->pet_subcategory->subcategory ?? '不明' }}</p>
            <p>性別: {{ $stray->sex ?? '不明' }}</p>
            <p>備考: {{ $stray->body }}</p>
        </div>
    </div>
    </div>

    <hr>

    <div class="comment_pet">
        <a href="#" id="commentBtn">コメントする</a>
    </div>
    
    <div id="commentModal">
        <div class="modal-content">
            <!-- コメント投稿フォーム -->
            <form id="commentForm" action="{{ route('strays.comments.store', $stray->id) }}" method="POST">
                @csrf
                <textarea name="body" maxlength="150" placeholder="コメントを入力" required></textarea>
                <div class="modalbtn">
                    <button type="submit">コメント投稿</button>
                    <button type="button" id="cancelBtn" class="cancel-btn">キャンセル</button>
                </div>
            </form>
        </div>
    </div>
            <!-- コメントリストを表示 -->
    <div id="commentList">
        @foreach($comments as $comment)
        <div class="caption-comment">
        <!-- アイコンエリア -->
        <div class="icon-area">
            <div class="icon">
                <img src="{{ $icon ? asset('storage/' . $icon) : asset('img/logo_defaultimg.png') }}" alt="アイコン">
            </div>
        </div>

            <!-- コメント内容 -->
            <div class="caption">
                <p><strong>{{ $comment->user->name ?? '匿名' }}:</strong> {{ $comment->body }}</p>
            </div>

            <!-- コメント削除ボタン  -->
            @if(auth()->id() === $comment->user_id) <!-- 自分のコメントのみ削除可能 -->
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

    </script>
    

@endsection