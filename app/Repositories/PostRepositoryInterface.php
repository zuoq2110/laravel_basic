<?php

namespace App\Repositories;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function all();
    public function create(array $data): Post;
    public function update(Post $post, array $data);
    public function delete(Post $post): bool;
    public function getByUserId(int $userId);
}