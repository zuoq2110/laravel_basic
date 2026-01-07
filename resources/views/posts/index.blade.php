<h1>Danh sách bài viết</h1>

<!-- Nút thêm bài viết -->
<div style="margin-bottom: 15px;">
    <a href="{{ route('posts.create') }}"
       style="padding: 6px 12px; background: #2563eb; color: white; text-decoration: none; border-radius: 4px;">
        + Thêm bài viết
    </a>
</div>

<div>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Tác giả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <!-- Nút sửa -->
                        <a href="{{ route('posts.edit', $post) }}"
                           style="padding: 4px 8px; background: #16a34a; color: white; text-decoration: none; border-radius: 4px;">
                            Sửa
                        </a>
                         <!-- Nút xóa -->
                        <form action="{{ route('posts.destroy', $post) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="padding: 4px 8px; background: #dc2626; color: white; border: none; border-radius: 4px;">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
