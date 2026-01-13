<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserController extends BaseApiController
{
    public function index(): JsonResponse
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')->get();
        return $this->sendResponse($users, 'Users retrieved successfully');
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'string|email|unique:users,email',
                'password' => 'required|confirmed',
                'role' => 'in:admin,user'
            ]);

            if ($validation->fails()) {
                return $this->sendValidationError($validation->errors());
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'user',
            ]);

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at
            ];

            return $this->sendResponse($userData, 'User created successfully', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->sendError('Error creating user: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $user = User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')->findOrFail($id);

            return $this->sendResponse($user, 'User retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError('Error retrieving user: ' . $e->getMessage());
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->sendError('User not found', Response::HTTP_NOT_FOUND);
            }
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'string|email|unique:users,email',

            ]);
            if ($validation->fails()) {
                return $this->sendValidationError($validation->errors());
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
            return $this->sendResponse($userData, 'User updated successfully');
        } catch (Exception $e) {
            return $this->sendError('Error updating user: ' . $e->getMessage());
        }
    }

   public function destroy($id): JsonResponse{
    try{
        $user = User::find($id);
        if(!$user){
            return $this->sendError('User not found', Response::HTTP_NOT_FOUND);
        }
        $user->delete();
        return $this->sendResponse([], 'User deleted successfully');
    }catch(Exception $e){
        return $this->sendError('Error deleting user: ' . $e->getMessage());
    }
   }
    
    
}
