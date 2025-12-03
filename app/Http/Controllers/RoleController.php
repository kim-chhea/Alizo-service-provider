<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Roles",
 *     description="API Endpoints for managing roles"
 * )
 */
class RoleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/allizo/roles",
     *     summary="Get all roles",
     *     tags={"Roles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Roles retrieved successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No roles found"
     *     )
     * )
     */
    public function index()
    {
        try {
            $role = Role::with('users')->get();
            if(!$role)
            {
                return response()->json([
                   'message' => 'No roles found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'roles retrieved successfully.',
                'status' => 200,
                'data' => $role,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/roles",
     *     summary="Create a new role",
     *     tags={"Roles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Admin")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Role created successfully"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Role creation failed"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "name" => "required|string|unique:roles,name",
            ]);
         
            $role = Role::create($ValidatedData);
            if(!$role) {
                throw new CustomeExceptions('Role creation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Role created successfully.',
                'status' => 201,
                'data' => $role,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/allizo/roles/{id}",
     *     summary="Get a role by ID",
     *     tags={"Roles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Role ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role retrieved successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $role = Role::with('users')->findOrFail($id);
            return response()->json([
                'message' => 'roles retrieved successfully.',
                'status' => 200,
                'data' => $role,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/allizo/roles/{id}",
     *     summary="Update a role by ID",
     *     tags={"Roles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Role ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Manager")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try {
            $ValidatedData = $request->validate([
                "name" => "sometimes|string|max:20|unique:roles,name,".$id,
            ]);

            $role = Role::findOrFail($id);
            $updatedSuccess = $role->update($ValidatedData);
            if(!$updatedSuccess) {
                throw new CustomeExceptions('Role updation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Role updated successfully.',
                'status' => 200,
                'data' => $role,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/roles/{id}",
     *     summary="Delete a role by ID",
     *     tags={"Roles"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Role ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json([
                'message' => 'roles deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
    public function assignRoleToUser(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "user_id" => "required|integer|exists:users,id",
                "role_id" => "required|integer|exists:roles,id",
            ]);

            $user = User::findOrFail($ValidatedData['user_id']);
            $role = Role::findOrFail($ValidatedData['role_id']);

            // Attach role to user
            $user->roles()->attach($role->id);

            return response()->json([
                'message' => 'Role assigned to user successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e) 
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
