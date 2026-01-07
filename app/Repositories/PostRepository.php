<?php

namespace App\Repositories;

use App\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    public function all(): Collection
    {
        return Post::with(['user', 'comments'])->latest()->get();
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): bool
    {
        return $post->update($data);
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }

    public function getByUserId(int $userId): Collection
    {
        return Post::where('user_id', $userId)
            ->with(['user', 'comments'])
            ->latest()
            ->get();
    }

}