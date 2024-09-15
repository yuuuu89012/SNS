@foreach($posts as $p)
  @if($p->user_id == Auth::id())
    <a href="{{route('post.edit',['id'=>$p->id])}}">編集</a>
  @endif
    <p>{{ $p->title }}</p>
    <p><img src="{{ asset('uploads/' . $p->image) }}" alt="" style="width:200"></p>
    <p>{{ $p->description }}</p>
    <hr>
@endforeach