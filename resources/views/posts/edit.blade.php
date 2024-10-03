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
        <input type="file" name="image">
        @if ($post->image)
            <img src="{{ asset('uploads/' . $post->image) }}" alt="現在の画像" style="max-width: 100px; margin-top: 10px;">
        @endif
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
    <div>
        <label for="category">カテゴリー</label>
        <select name="category" required>
            <option value="">カテゴリーを選択</option>
            <option value="レシピ" {{ $post->category === 'レシピ' ? 'selected' : '' }}>レシピ</option>
            <option value="ヘア" {{ $post->category === 'ヘア' ? 'selected' : '' }}>ヘア</option>
            <option value="トラベル" {{ $post->category === 'トラベル' ? 'selected' : '' }}>トラベル</option>
            <option value="グルメ" {{ $post->category === 'グルメ' ? 'selected' : '' }}>グルメ</option>
            <option value="暮らし" {{ $post->category === '暮らし' ? 'selected' : '' }}>暮らし</option>
            <option value="ファッション" {{ $post->category === 'ファッション' ? 'selected' : '' }}>ファッション</option>
            <option value="美容" {{ $post->category === '美容' ? 'selected' : '' }}>美容</option>
            <option value="その他" {{ $post->category === 'その他' ? 'selected' : '' }}>その他</option>
        </select>
    <button type="submit">投稿する</button>
</form>
