<!--<a class="post" href="{{route('post.index')}}">投稿一覧</a>
<a class="create" href="{{route('post.create')}}">新規投稿</a>
@foreach($posts as $p)
  <a href="{{route('user.show',["id"=>$p->user_id])}}">{{$p->name}}</a>
  <p>{{ $p->title }}</p>
  <a href="{{route('post.show',['id'=>$p->id])}}">
    <p><img src="{{ asset('uploads/' . $p->image) }}" alt="" style="width:200"></p>
  </a>
  <p>{{ $p->description }}</p>

  @if (Auth::id()!=$p->user_id)
    @if(Auth::user()->is_favorite($p->id))
      <form action="{{ route('favorites.unfavorite', $p->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">いいねを解除</button>
      </form>
    @else
      <form action="{{ route('favorites.favorite', $p->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn">いいね</button>
      </form>
    @endif
  @endif

  @if($p->user_id == Auth::id())
    <a href="{{route('post.edit',['id'=>$p->id])}}">編集</a>
    <form method="POST" action="{{route('post.destroy',['id'=>$p->id])}}">
      @csrf
      <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
    </form>
  @endif
  <hr>
@endforeach
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SNS App</title>
  <link rel="stylesheet" href="{{ asset('index-style.css') }}">
</head>
<body>
    <header>
        <div class="logo-ser">
            <div class="logo">
                <img src="{{ asset('logo.png') }}">
            </div>
            <div class="search-bar">
                <input type="text">
            </div>    
        </div>
        <div class="user-menu">
          <img src="user-icon.png" alt="User">
          <img src="notification-icon.png" alt="Notifications">
          <button type="button" class="humbtn js-btn">
            <span class="btn-line"></span>
          </button>
          <nav>
            <ul class="menu">
              <li class="menu-list">メニュー1</li>
              <li class="menu-list">メニュー2</li>
              <li class="menu-list">メニュー3</li>
              <li class="menu-list">メニュー4</li>
              <li class="menu-list">メニュー5</li>
            </ul>
          </nav>
        </div>
    </header>
    <nav>
        <ul id="nav-categories">
            <li data-category="おすすめ">おすすめ</li>
            <li data-category="レシピ">レシピ</li>
            <li data-category="ヘア">ヘア</li>
            <li data-category="トラベル">トラベル</li>
            <li data-category="グルメ">グルメ</li>
            <li data-category="暮らし">暮らし</li>
            <li data-category="ファッション">ファッション</li>
            <li data-category="美容">美容</li>
        </ul>
    </nav>
    <main>
      <div class="posts">
        @foreach($posts as $p)
        <div class="post" data-category="{{ $p->category }}"> 
          <div class="post-header">
            <a href="{{route('user.show',["id"=>$p->user_id])}}">{{$p->name}}</a>
            @if(Auth::id() != $p->user_id)
              @if(Auth::user()->isFollowing($p->user_id))
                <form action="{{ route('unfollow', ['user' => $p->user_id]) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="follow-btn">Unfollow</button>
                </form>
              @else
                <form action="{{ route('follow', ['user' => $p->user_id]) }}" method="POST" style="display:inline;">
                  @csrf
                  <button type="submit" class="follow-btn">Follow</button>
                </form>
              @endif
            @endif
            </div>
          <a href="{{ route('post.show', ['id' => $p->id]) }}">
            <div class="post-img">
              <img src="{{ asset('uploads/' . $p->image) }}">
            </div>
          </a>
          <div class="post-footer">
            <div class="post-actions">
              @if (Auth::id()!=$p->user_id)
                @if(Auth::user()->is_favorite($p->id))
                  <form action="{{ route('favorites.unfavorite', $p->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">いいねを解除</button>
                  </form>
                @else
                  <form action="{{ route('favorites.favorite', $p->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">いいね</button>
                  </form>
                @endif
              @endif
            </div>
            <div class="post-text">
              <p class="title">{{ $p->title }}</p>
              <p class="text">{{ $p->description }}</p>
            </div>
              <div class="post-date"></div><!--後で作成-->
            </div>

          @if($p->user_id == Auth::id())
            <a href="{{route('post.edit',['id'=>$p->id])}}">編集</a>
            <form method="POST" action="{{route('post.destroy',['id'=>$p->id])}}">
              @csrf
              <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
            </form>
          @endif
          <hr>
        </div>
        @endforeach
      </div>
    </main>
    <a href="{{ route('post.create') }}" class="add-post-btn">+</a>
<script src="{{ asset('index.js') }}"></script>
</body>
</html>