<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">タイトル</label>
        <input type="text" name="title" value="{{old("title")}}">
    </div>

    <div>
        <label for="img" accept="image/png,image/jpg,image/jpeg">ファイル</label>
        <input type="file" name="image" value="{{old("image")}}">
    </div>
    <div>
        <label for="description">詳細</label>
        <textarea name="description" row="5">{{old('description')}}</textarea>
    </div>

    <button type="submit">投稿する</button>
</form>
