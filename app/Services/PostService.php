<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class PostService
{
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts(): Collection
    {
        return $this->postRepository->all();
    }

    public function getPostById(int $id): ?Post
    {
        return $this->postRepository->findByIdWith($id, ['user', 'comments.user']);
    }

    public function createPost(array $data): Post
    {
            $postData = array_merge($data, ['user_id' => Auth::id()]);
            $post = $this->postRepository->create($postData);
            return $post;
    }

    public function updatePost(Post $post, array $data): bool
    {
            $result = $this->postRepository->update($post, $data);
            return $result;
    }

    public function deletePost(Post $post): bool
    {
            $result = $this->postRepository->delete($post);
            return $result;
    }

    public function canDeletePost(Post $post): bool
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        return $user->id === $post->user_id;
    }

    public function canEditPost(Post $post): bool
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        // Admin can edit any post
        if ($user->isAdmin()) {
            return true;
        }

        // User can only edit their own posts
        return $user->id === $post->user_id;
    }
}