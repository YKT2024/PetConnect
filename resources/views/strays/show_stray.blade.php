@extends('layouts.footer')

@section('css')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/index_shelter.css') }}">
<link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
@endsection

    @section('content')
    <header>
    <div class="top">
        <p>迷子情報</p>
    </div>
    </header>

    <div class="help_pet">
        <a href="#">探しています</a>
    </div>

    <div class="containers">
        <a href="#">
            <div class="container">
            <div class="day_picture">
                <p>投稿日:</p>
                <img src="{{asset('img/logo_defaultimg.png') }}" alt="迷子">
            </div>
            <div class="imformation">                    
                <p>ペットのなまえ:</p>
                <p>エリア:</p>
                <p>いなくなった日:</p>
                <p>カテゴリー:</p>
                <p>性別:</p>
                <p>色:</p>
            </div>
            </div>
        </a>
    </div>

    <hr>

    <div class="comment_pet">
        <a href="#" id="commentBtn">コメントする</a>
    </div>
    
            <!-- モーダルウィンドウ -->
            <div id="commentModal">
                <div class="modal-content">
                    <!--コメント機能 ここの下もあってるかわからん -->
                    <form id="commentForm" action="" method="POST">
                        <!-- @csrf -->
                        <textarea name="comment" maxlength="150" placeholder="コメントを入力"></textarea>
                        <div class="modalbtn">
                            <button type="submit">コメント投稿</button>
                            <button type="button" id="cancelBtn" class="cancel-btn">キャンセル</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- コメントリストを表示 -->
            <div id="commentList">
                {{-- <!-- @foreach($comments as $comment) --> --}}
                    <div class="caption-comment">
                        <div class="icon-area">
                            <div class="icon">
                                <img src="{{ asset('img/footer_field.png') }}" alt="アイコン"> -->
                                <!-- 上の1行消してここ変える　コメント投稿者のアイコン取得 -->
                                <!-- <img src="" alt=""> -->
                            </div>
                        </div>
                        <div class="caption">
                            <p>コメントはここやで</p>
                            <!-- 上の1行消してここ変える 投稿されたコメント取得-->
                            {{-- <!-- <p>{{ $comment->text }}</p> --> --}}
                        </div>
                        <!-- コメント削除ボタン -->
                        <!-- 削除機能 ここの下もあってるかわからん -->
                        {{-- <!-- <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('コメントを削除しますか？')"> --> --}}
                            <!-- @csrf -->
                            <!-- @method('DELETE') -->
                            <button class="btn-4" id="delete-btn">削除</button>
                        </form>
                    </div>
                {{-- <!-- @endforeach --> --}}
            </div>
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