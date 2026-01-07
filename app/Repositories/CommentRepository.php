<?php

namespace App\Repositories;

use App\Repositories\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
   
    public function all(): Collection
    {
        return Comment::with(['user', 'post'])->latest()->get();
    }

}