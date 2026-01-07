<?php

namespace App\Contracts\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{
    /**
     * Get all comments
     * 
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get comments with pagination
     * 
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /**
     * Find comment by ID
     * 
     * @param int $id
     * @return Comment|null
     */
    public function findById(int $id): ?Comment;

    /**
     * Create new comment
     * 
     * @param array $data
     * @return Comment
     */
    public function create(array $data): Comment;

    /**
     * Update comment
     * 
     * @param Comment $comment
     * @param array $data
     * @return bool
     */
    public function update(Comment $comment, array $data): bool;

    /**
     * Delete comment
     * 
     * @param Comment $comment
     * @return bool
     */
    public function delete(Comment $comment): bool;

    /**
     * Get comments by post ID
     * 
     * @param int $postId
     * @return Collection
     */
    public function getByPostId(int $postId): Collection;

    /**
     * Get comments by user ID
     * 
     * @param int $userId
     * @return Collection
     */
    public function getByUserId(int $userId): Collection;
}