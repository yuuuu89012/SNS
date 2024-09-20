<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ページタイトル</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <form method="POST" action="{{route('user.update',['id'=>$user->id])}}">
        @csrf
        <h1>投稿編集</h1>
        <label for="name">ユーザーネーム</label>
        <input  type="text" name="name" value="{{$user->name}}">
        @error('name')
        {{$message}}
        @enderror
        <button type="submit">更新</button>
    </form>

</body>
</html>
