<h1>編集</h1>
<form method="POST" action="{{route('post.update',['id'=>$post->id])}}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">タイトル</label>
        <input type="text" name="title" value="{{$post->title}}">
    </div>
    @error('title')
    <div>{{$message}}</div>
    @enderror
    <div>
        <label for="img" accept="image/png,image/jpg,image/jpeg">ファイル</label>
        <input type="file" name="image" value="{{$post->image}}">
    </div>
    @error('image')
    <div>{{$message}}</div>
    @enderror
    <div>
        <label for="description">詳細</label>
        <textarea name="description" row="5">{{$post->description}}</textarea>
    </div>
    @error('description')
    <div>{{$message}}</div>
    @enderror
    <button type="submit">投稿する</button>
</form>
