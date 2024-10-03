<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">タイトル</label>
        <input type="text" name="title" value="{{old("title")}}">
    </div>
    @error('title')
    <div>{{$message}}</div>
    @enderror
    <div>
        <label for="img" accept="image/png,image/jpg,image/jpeg">ファイル</label>
        <input type="file" name="image" value="{{old("image")}}">
    </div>
    @error('image')
    <div>{{$message}}</div>
    @enderror
    <div>
        <label for="description">詳細</label>
        <textarea name="description" row="5">{{old('description')}}</textarea>
    </div>
    @error('description')
    <div>{{$message}}</div>
    @enderror
    <select name="category" required>
      <option value="">カテゴリーを選択</option>
      <option value="レシピ">レシピ</option>
      <option value="ヘア">ヘア</option>
      <option value="トラベル">トラベル</option>
      <option value="グルメ">グルメ</option>
      <option value="暮らし">暮らし</option>
     <option value="ファッション">ファッション</option>
     <option value="美容">美容</option>
     <option value="その他">その他</option>
    </select>
    <button type="submit">投稿する</button>
</form>
