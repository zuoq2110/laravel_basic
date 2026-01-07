<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Tiêu đề:</label>
        <input type="text" id="title" name="title">
    </div>
    <div>
        <label for="body">Nội dung:</label>
        <textarea id="body" name="body"></textarea>
    </div>
    <div>
        <label for="user_id">id user:</label>
        <input type="text" id="user_id" name="user_id">
    </div>
    <button type="submit">Tạo mới</button>
</form>