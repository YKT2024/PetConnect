{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}

  @extends('layouts.footer')

  @section('css')
  {{-- css --}}
  <link rel="stylesheet" href="{{ asset('css/index_post.css') }}">
  @endsection
{{-- </head> --}}

  @section('content')
  <header>
    <div class="top">
      <p>投稿一覧</p>
    </div>
  </header>
  <div class="select_button">
    <a href="#" id="show-all">全て</a>
    <a href="#" id="show-favorites">お気に入り</a>
  </div>
  <div class="search">
    <form action="http://127.0.0.1:8002/posts" method="get">
      <input type="search" name="search">
      <input type="submit" name="submit" value="🔍">
    </form>
  </div>
  
<div  id="all-container" class="all_container">
    @foreach ($posts as $index => $post)
        {{-- 1段目（1番目と2番目） --}}
        @if ($index == 0 || $index == 1)
            @if ($index == 0)
                <div class="row"> {{-- 新しい行の開始 --}}
            @endif
             <a href="{{ route('posts.show', ['id' => $post->id]) }}">
             <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
             </a>
            @if ($index == 1)
                </div> {{-- 行の終了 --}}
            @endif

        {{-- 2段目（3番目） --}}
        @elseif ($index == 2)
            <div class="row1">
              <a href="{{ route('posts.show', ['id' => $post->id]) }}">
              <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
              </a>
            </div>

        {{-- 3段目（4番目と5番目） --}}
        @elseif ($index == 3 || $index == 4)
            @if ($index == 3)
                <div class="row">
            @endif
              <a href="{{ route('posts.show', ['id' => $post->id]) }}">
              <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
              </a>
            @if ($index == 4)
                </div>
            @endif

        {{-- 4段目（6番目） --}}
        @elseif ($index == 5)
            <div class="row1">
              <a href="{{ route('posts.show', ['id' => $post->id]) }}">
              <img src="{{ asset('storage/' . $post->image_at)}}" alt="投稿画像">
              </a>
            </div>
        @endif
    @endforeach
</div>

<div id="favorites-container" class="favorite_container" style="display: none;">
  {{-- ダミーデータで投稿画像を表示 --}}
  @foreach ($favposts as $index => $favpost)
      {{-- 1段目（1番目と2番目） --}}
      @if ($index == 0 || $index == 1)
          @if ($index == 0)
              <div class="row"> {{-- 新しい行の開始 --}}
          @endif
          <a href="{{ route('posts.show', ['id' => $favpost->id]) }}">
           <img src="{{ asset('storage/' . $favpost->image_at) }}" alt="投稿画像">
          </a>
          @if ($index == 1)
              </div> {{-- 行の終了 --}}
          @endif

      {{-- 2段目（3番目） --}}
      @elseif ($index == 2)
          <div class="row1">
            <a href="{{ route('posts.show', ['id' => $favpost->id]) }}">
              <img src="{{ asset('storage/' . $favpost->image_at) }}" alt="投稿画像">
             </a>
          </div>

      {{-- 3段目（4番目と5番目） --}}
      @elseif ($index == 3 || $index == 4)
          @if ($index == 3)
              <div class="row">
          @endif
          <a href="{{ route('posts.show', ['id' => $favpost->id]) }}">
            <img src="{{ asset('storage/' . $favpost->image_at) }}" alt="投稿画像">
           </a>
          @if ($index == 4)
              </div>
          @endif

      {{-- 4段目（6番目） --}}
      @elseif ($index == 5)
          <div class="row1">
            <<a href="{{ route('posts.show', ['id' => $favpost->id]) }}">
              <img src="{{ asset('storage/' . $favpost->image_at) }}" alt="投稿画像">
             </a>
          </div>
      @endif
  @endforeach
</div>

<div class="pulus">
  <a href="{{ route('posts.create_post') }}">
    <span class="dli-plus-circle"><span></span></span>
  </a>
</div>

{{-- <div class="footer-icons">
  <a href="{{ route('posts.index_post') }}"><img class=icons src="{{ asset('img/footer_field.png')}}" alt="投稿一覧"></a>
  <a href="{{ route('posts.index_post') }}"><img class=icons src="{{ asset('img/footer_search.png') }}" alt="検索"></a>
  <a href="{{ route('posts.index_post') }}"><img class=icons src="{{ asset('img/footer_bookmark.png')}}" alt="ブックマーク"></a>
  <a href="{{ route('posts.index_post') }}"><img class=icons src="{{ asset('img/footer_comment.png')}}" alt="コメント"></a>
  <a href="{{ route('posts.index_post') }}"><img class=icons src="{{ asset('img/footer_mypage.png')}}" alt="マイぺージ"></a>
</div> --}}

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // 要素が存在するか確認
    const allContainer = document.getElementById('all-container');
    const favoritesContainer = document.getElementById('favorites-container');
    const showAllButton = document.getElementById('show-all');
    const showFavoritesButton = document.getElementById('show-favorites');

    if (allContainer && favoritesContainer && showAllButton && showFavoritesButton) {
      // "全て" ボタンのクリックイベント
      showAllButton.addEventListener('click', function(event) {
        event.preventDefault();
        allContainer.style.display = 'block'; // 全てを表示
        favoritesContainer.style.display = 'none'; // お気に入りを非表示
      });

      // "お気に入り" ボタンのクリックイベント
      showFavoritesButton.addEventListener('click', function(event) {
        event.preventDefault();
        allContainer.style.display = 'none'; // 全てを非表示
        favoritesContainer.style.display = 'block'; // お気に入りを表示
      });
    } else {
      console.error('必要な要素が見つかりません。HTML 内の ID を確認してください。');
    }
  });
</script>

  {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> --}}

  @endsection
