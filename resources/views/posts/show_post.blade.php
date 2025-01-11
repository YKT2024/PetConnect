<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿詳細</title>
    <link rel="stylesheet" href="{{ asset('css/show_post.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<!--↓↓↓↓↓仮のヘッダーだよ↓↓↓↓↓-->
<header class="header-dayo">
    <div class="header-desu">投稿詳細</div>
</header>
<!--↑↑↑↑仮のヘッダーだよ↑↑↑↑-->


<main class="maincontent">
    <section class="section1">
        <div class="photo-area">
            <div class="photo-frame">
                <img id="#" src="{{ asset('images/postedimg2.jpg') }}" alt="posted-img">
                <!-- 上の1行消してここ変える 投稿した写真取得-->
                 {{-- <<img src="{{ $post->image_at }}" alt=""> 的な？--> --}}
            </div>
            <div class="underimg">
                <div class="posted-date">
                    <p>2050-12-31</p>
                    <!-- 上の1行消してここ変える 投稿した日取得-->
                    {{-- <p>{{ $post->created_at }}</p> --> --}}
                </div>
                <div class="like-fav">
                    <button><i class="far fa-heart"></i></button>
                    <button><i class="far fa-bookmark"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="section2">
        <div class="caption-comment">
            <div class="icon-area">
                <div class="icon">
                    <img src="{{ asset('images/postedimg3.png') }}" alt="アイコン">
                    <!-- 上の1行消してここ変える 投稿者のアイコン取得-->
                     <img src="{{ $pet->image_at}}" alt="icon"> 的な？-->
                </div>
            </div>
            <div class="caption">
                <p>ここに本文が入ります〜！あなたの可愛いペットの自慢はここですよ〜！<br>
                  文字数は280文字までで、今のとこと80文字以上は長いから続きを読むボタンで隠しています❤️<br>
                  表示文字の制限は下のStr::limit($post->body, 80, '…')の数字をいじればかえられます〜✌️<br>
                  とりあえずがっちゃんこしてもろて、できる限り頑張っていいねとかつけますね。
                </p>
                <!-- 上の<p>の行消してここ変える 投稿文取得-->
                {{-- 80文字以上は表示されないようになっているはず --}}
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
                    <form id="commentForm" action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <textarea name="comment" placeholder="コメントを入力"></textarea>
                        <button type="submit">コメント投稿</button>
                        <button type="button" id="cancelBtn" class="cancel-btn">キャンセル</button>
                    </form>
                </div>
            </div>

            <!-- コメントリストを表示 -->
            <div id="commentList">
                @foreach($comments as $comment)
                    <div class="caption-comment">
                        <div class="icon-area">
                            <div class="icon">
                                <img src="{{ asset('images/postedimg3.png') }}" alt="アイコン">
                                <!-- 上の1行消してここ変える　コメント投稿者のアイコン取得 -->
                                 <!-- <img src="{{  }}" alt=""> -->
                            </div>
                        </div>
                        <div class="caption">
                            <p>コメントはここやで</p>
                            <!-- 上の1行消してここ変える 投稿されたコメント取得-->
                            <!-- <p>{{ $comment->text }}</p> -->
                        </div>
                        <!-- コメント削除ボタン -->
                         <!-- 削除機能 ここの下もあってるかわからん -->
                        <!-- <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('コメントを削除しますか？')"> -->
                            <!-- @csrf -->
                            <!-- @method('DELETE') -->
                            <button type="submit">削除</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>


{{-- コメントのためのモーダル --}}
{{-- コメントされた際の表示 --}}
<script>
let comments = [];

document.getElementById('commentBtn').addEventListener('click', function() {
    document.getElementById('commentModal').style.display = 'flex';
});

document.getElementById('cancelBtn').addEventListener('click', function() {
    document.getElementById('commentModal').style.display = 'none';
});

document.getElementById('commentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // ページリロードを防ぐ

    const commentText = this.querySelector('textarea[name="comment"]').value;

    if (commentText.trim() === '') {
        alert('コメントを入力してください！');
        return;
    }

    // コメントオブジェクトを追加
    const newComment = {
        text: commentText,
        // 投稿者名やIDなども追加できます（例: userId: 12345）
        userId: 'user123',  // 仮のユーザーID（後で実際のユーザーIDに置き換える）
    };
    comments.push(newComment);

    updateComments();

    document.getElementById('commentModal').style.display = 'none';
    this.reset();
});

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
        img.src = 'postedimg3.png'; // アイコン画像
        img.alt = 'アイコン';
        icon.appendChild(img);
        iconArea.appendChild(icon);

        const caption = document.createElement('div');
        caption.classList.add('caption');
        const p = document.createElement('p');
        p.textContent = comment.text;
        caption.appendChild(p);

        // 削除ボタン
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = '削除';
        deleteBtn.classList.add('delete-btn');
        deleteBtn.addEventListener('click', function() {
            if (confirm('コメントを削除しますか？')) { // 確認アラート
                deleteComment(index); // 削除確定
            }
        });

        commentItem.appendChild(iconArea);
        commentItem.appendChild(caption);
        commentItem.appendChild(deleteBtn);

        commentList.appendChild(commentItem);
    });
}

function deleteComment(index) {
    comments.splice(index, 1); // コメントを配列から削除
    updateComments(); // コメントリストを再更新
}




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


</body>
</html>