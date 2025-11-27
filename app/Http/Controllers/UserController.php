<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints for managing users"
 * )
 */

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/allizo/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Users retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Users retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="email", type="string"),
     *                     @OA\Property(property="location_id", type="integer", nullable=true),
     *                     @OA\Property(property="role_id", type="integer")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        try {
            $user = User::with(['location','roles'])->first();
            if(!$user) {
                return response()->json([
                   'message' => 'No users found.',
                   'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'Users retrieved successfully.',
                'status' => 200,
                'data' => $user,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/users",
     *     summary="Create a new user",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","role_id"},
     *             @OA\Property(property="name", type="string", maxLength=20),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", minLength=6, maxLength=16),
     *             @OA\Property(property="location_id", type="integer", nullable=true),
     *             @OA\Property(property="role_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "name" => "required|string|max:20",
                "email"=> "required|email|unique:users,email",
                "password" => "required|string|min:6|max:16",
                "location_id" => "nullable|integer",
                "role_id" => 'required|integer'
            ]);
            $ValidatedData['password'] = Hash::make($ValidatedData['password']);
            $user = User::create($ValidatedData);

            if(!$user) {
                throw new CustomeExceptions('User creation failed due to an unexpected error.', 500);
            }

            return response()->json([
                'message' => 'User registered successfully.',
                'status' => 201,
                'data' => $user,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/allizo/users/{id}",
     *     summary="Get user by ID",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User retrieved successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $user = User::with(['location','roles'])->findOrFail($id);

            return response()->json([
                'message' => 'User retrieved successfully.',
                'status' => 200,
                'data' => $user,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/allizo/users/{id}",
     *     summary="Update user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", maxLength=20),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", minLength=6, maxLength=16),
     *             @OA\Property(property="location_id", type="integer", nullable=true),
     *             @OA\Property(property="role_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try {
            $ValidatedData = $request->validate([
                "name" => "sometimes|string|max:20",
                "email"=> "sometimes|email|unique:users,email,".$id,
                "password" => "sometimes|string|min:6|max:16",
                "location_id" => "sometimes|nullable|integer",
                "role_id" => 'sometimes|integer'
            ]);

            if(isset($ValidatedData['password'])) {
                $ValidatedData['password'] = Hash::make($ValidatedData['password']);
            }

            $user = User::findOrFail($id);
            $updatedSuccess = $user->update($ValidatedData);

            if(!$updatedSuccess) {
                throw new CustomeExceptions('User updation failed due to an unexpected error.', 500);
            }

            return response()->json([
                'message' => 'User updated successfully.',
                'status' => 200,
                'data' => $user,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/users/{id}",
     *     summary="Delete user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            return response()->json([
                'message' => 'User deleted successfully.',
                'status' => 200,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
