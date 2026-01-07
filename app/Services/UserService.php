<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data): User
    {
            if (!isset($data['role'])) {
                $data['role'] = 'user';
            }
            $user = $this->userRepository->create($data);
            return $user;
    }

    public function updateUser(User $user, array $data): bool
    {
            $result = $this->userRepository->update($user, $data);

            return $result;
    }

    public function deleteUser(User $user): bool
    {
            $result = $this->userRepository->delete($user);
            $result = $this->userRepository->delete($user);
            return $result;
    }
}