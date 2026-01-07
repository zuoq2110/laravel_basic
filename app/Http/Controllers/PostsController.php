<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PostsController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }


    // 2. Form tạo mới (Create - View)
    public function create()
    {
        return view('posts.create');
    }

    // 3. Lưu dữ liệu (Create - Action)
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

            $this->postService->createPost($validate);

            return redirect()->route('posts.index')->with('success', 'Tạo bài viết thành công!');
    }

    #4. xem chi tiết bài viết (Read - Detail)
    public function show(Post $post)
    {
        $post = $this->postService->getPostById($post->id);
        if (!$post) {
            abort(404);
        }
        return view('posts.show', compact('post'));
    }

    #5. form chỉnh sửa bài viết (Update - View)
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    #6. Cập nhật bài viết (Update - Action)
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $this->postService->updatePost($post, [
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    #7. Xóa bài viết (Delete)
    public function destroy(Post $post)
    {
        try {
            if($this->postService->canDeletePost($post) === false) {
                return redirect()->back()->with('error', 'Bạn không có quyền xóa bài viết này.');
            }
            $this->postService->deletePost($post);
            return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
