<a class="post" href="{{route('post.index')}}">投稿一覧</a>
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
