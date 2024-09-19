@if(Auth::id()!=$user_flg)
  @if(Auth::user()->isFollowing($user->id))
    <form action="{{route('unfollow',['user'=>$user->id])}}" method="POST">
        {{csrf_field()}}
        {{mehod_field('DELETE')}}
        <button type="submit">フォロー解除</button>
    </form>
  @else
    <form action="{{route('follow',['user'=>$user->id])}}" method="POST">
        {{csrf_field()}}
        <button type="submit">フォロー</button>
    </form>
@endif
@endif