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
              <a href="#">
                <img src="{{ asset('logo3.png') }}">
              </a>
            </div>
            <div class="search-bar">
                <input type="text">
            </div>
        </div>
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
                    <button type="submit" class="btn1">
                      <svg class="likeButton__icon1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
                      いいね
                    </button>
                  </form>
                @else
                  <form action="{{ route('favorites.favorite', $p->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">
                      <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
                      いいね
                    </button>
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
    <input type="checkbox" id="actionMenuButton"/>       
        <div class="actions-menu">        
          <button class="humbtn humbtn--share">
          <svg style="width:24px;height:24px" viewBox="0 0 24 24">
            <path fill="#ffffff" d="M12 2C11.4477 2 11 2.44772 11 3V11H3C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11V21C11 21.5523 11.4477 22 12 22C12.5523 22 13 21.5523 13 21V13H21C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11H13V3C13 2.44772 12.5523 2 12 2Z" />
          </svg>
  
          </button>
          <button class="humbtn humbtn--star">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
          </button>
          <button class="humbtn humbtn--comment">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff" d="M10.5 2a8.5 8.5 0 1 0 8.5 8.5A8.5 8.5 0 0 0 10.5 2zm0 15a6.5 6.5 0 1 1 6.5-6.5 6.5 6.5 0 0 1-6.5 6.5z"/>
                <path fill="#ffffff" d="M18.5 18.5l3.5 3.5-1.5 1.5-3.5-3.5z"/>            </svg>
          </button>
          <label for="actionMenuButton" class="humbtn humbtn--large humbtn--menu"/>
        </div>
  <script src="{{ asset('index.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>