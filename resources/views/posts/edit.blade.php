<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Tiêu đề:</label>
        <input type="text" id="title" name='title' value="{{ $post->title }}">
    </div>
    <div>
        <label for="body">Nội dung:</label>
        <input type="text" id="body" name="body" value="{{ $post->body }}">
    </div>
    <button type="submit">Cập nhật</button>
</form>