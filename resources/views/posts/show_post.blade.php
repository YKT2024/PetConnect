@extends('layouts.footer')

@section('css')
{{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show_post.css') }}">
    {{-- <link rel="stylesheet" href="./show_post.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @endsection

    @section('content')

<header class="header-dayo">
    <button onclick="window.history.back()"><img src="{{ asset('img/return.png')}}" alt=""></button>
</header>

<main class="maincontent">
    <section class="section1">
        <div class="photo-area">
            <div class="photo-frame">
                <img src="{{ asset('storage/' . $post->image_at) }}" alt="posted_img">
            </div>
            <div class="underimg">
                <div class="posted-date">
                    <p>{{ $post->created_at }}</p>
                </div>
                    <div class="actionarea">
                    {{-- かわいいねボタン --}}
                    @if (auth()->user()->likes->contains($post->id))
                        <form action="{{ route('likes.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="likeButton liked">
                                <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" >
                                 <path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/>
                                </svg>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('likes.store', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="likeButton">
                                <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" >
                                 <path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/>
                                </svg>
                            </button>
                        </form>
                    @endif

                    {{-- ブックマークボタン --}}
                    @if (auth()->user()->favorites->contains($post->id))
                        <form action="{{ route('favorites.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="likeButton2 liked">
                                <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50">
                                 <path d="M6 2C5.447 2 5 2.447 5 3v18.586c0 .527.673.792 1.06.415l5.94-5.94 5.94 5.94c.387.377 1.06.112 1.06-.415V3c0-.553-.447-1-1-1H6z"/>
                                </svg>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorites.store', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="likeButton2">
                                <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="50" height="50">
                                 <path d="M6 2C5.447 2 5 2.447 5 3v18.586c0 .527.673.792 1.06.415l5.94-5.94 5.94 5.94c.387.377 1.06.112 1.06-.415V3c0-.553-.447-1-1-1H6z"/>
                                </svg>
                            </button>
                        </form>
                    @endif

                    {{-- 編集ボタン --}}
                    <a href="{{ route('posts.edit', $post->id) }}"><button><i class="far fa-edit edit-icon"></i></button></a>
                    </div>
            </div>
        </div>
    </section>

    <section class="section2">
        <div class="caption-comment">
            <div class="icon-area">
                <div class="icon">
                    <img src="{{ asset('storage/' . $icon) }}" alt="アイコン">
                </div>
            </div>
            <div class="caption">
                <!-- {{-- 80文字以上は表示されないようになっているはず --}} -->
                <p class="post-body" data-full-text="{{ $post->body }}">
                {{ Str::limit($post->body, 80, '…') }}
                </p>
                <button class="read-more-btn" style="display: none;">続きを読む</button>
            </div>
        </div>

        <!-- コメントセクション -->
        <div class="comment">
            <div class="btn">
                <button class="btn-1" id="commentBtn">コメントする</button>
            </div>

            <!-- モーダルウィンドウ -->
            <div id="commentModal">
                <div class="modal-content">
                    <!--コメント機能 ここの下もあってるかわからん -->
                    <form id="commentForm" action="#kokoni-route-ireru" method="POST">
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
                                <img src="{{ asset('images/postedimg3.png') }}" alt="アイコン">
                                <!-- 上の1行消してここ変える　コメント投稿者のアイコン取得 -->
                                <!-- <img src="    " alt=""> -->
                            </div>
                        </div>
                        <div class="caption">
                            <p>コメントはここやで</p>
                            <!-- 上の1行消してここ変える 投稿されたコメント取得-->
                            <!-- <p>    $comment->text     </p> -->
                        </div>
                        <!-- コメント削除ボタン -->
                        <!-- 削除機能 ここの下もあってるかわからん -->
                        <!-- <form action="     route('comments.destroy', $comment->id)     " method="POST" onsubmit="return confirm('コメントを削除しますか？')"> -->
                            {{-- <!-- @csrf --> --}}
                            {{-- <!-- @method('DELETE') --> --}}
                            <button class="btn-4" type="submit">削除</button>
                        </form>
                    </div>
                {{-- <!-- @endforeach --> --}}
            </div>
        </div>
    </section>
</main>


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
</script>

@endsection