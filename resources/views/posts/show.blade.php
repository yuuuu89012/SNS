<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>詳細</title>
</head>
<body>
    <h1>詳細</h1>
    <h3>タイトル</h3>
    <h2>{{$post->title}}</h2>

    <h2>画像</h2>
    <img src="../../uploads/{{$post->image}}" width="300" height="200">

    <h2>詳細</h2>
    <h2>{{$post->description}}</h2>

    <h1>コメント</h1>
    <ul>
        <li>
            <form method="POST" action="{{route('comments.store',$post)}}">
                @csrf
                <input type="text" name="body">
                <button>add</button>
                @error('body')
                   {{$message}}
                @enderror
            </form>
        </li>
    </ul>
    <ul>
        @foreach($post->comments()->latest()->get() as $comment)
        <li>
            {{$comment->body}}
            <form method="post" action="{{route('comments.destroy',$comment)}}">
                @method('DELETE')
                @csrf
                <button>削除</button>
            </form>
        </li>
        @endforeach
    </ul>

</body>
</html>