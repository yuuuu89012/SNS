<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ページタイトル</title>
    <link rel="stylesheet" href="styles.css"> <!-- 外部CSS -->
</head>
<body>
  <a href="#content">
    <span>Skip to main content</span>
  </a>
  <a href="{{route('post.index')}}">投稿一覧</a>
  <a href="{{route('post.create')}}">新規投稿</a>
  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
  <form action="{{route('logout')}}" method="POST">
    @csrf
  </form>
  <img src="" width="140" height="140">
  <h1>{{$user->name}}</h1>
  @if(Auth::id()!=$user_flg)
    @if(Auth::user()->isFollowing($user->id))
      <form action="{{route('unfollow',['user'=>$user->id])}}" method="POST">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="submit">フォロー解除</button>
      </form>
    @else
      <form action="{{route('follow',['user'=>$user->id])}}" method="POST">
        {{csrf_field()}}
        <button type="submit">フォロー</button>
      </form>
    @endif
    @else
      <a href="{{route('user.edit',['id'=>Auth::id()])}}">編集</a>
  @endif


  @foreach($post as $p)
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

</body>
</html>



