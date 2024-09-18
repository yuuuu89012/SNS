<a class="post" href="{{route('post.index')}}">投稿一覧</a>
<a class="create" href="{{route('post.create')}}">新規投稿</a>
@foreach($posts as $p)
  <p>{{$p->name}}</p>
  <p>{{ $p->title }}</p>
  <a href="{{route('post.show',['id'=>$p->id])}}">
    <p><img src="{{ asset('uploads/' . $p->image) }}" alt="" style="width:200"></p>
  </a>
  <p>{{ $p->description }}</p>
  @if($p->user_id == Auth::id())
    <a href="{{route('post.edit',['id'=>$p->id])}}">編集</a>
    <form method="POST" action="{{route('post.destroy',['id'=>$p->id])}}">
      @csrf
      <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
    </form>
  @endif
  <hr>
@endforeach
