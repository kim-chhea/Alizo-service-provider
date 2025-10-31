<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Category",
 *     description="API Endpoints for managing categories"
 * )
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/allizo/categories",
     *     summary="Get all categories",
     *     tags={"Category"},
     *     @OA\Response(
     *         response=200,
     *         description="List of categories retrieved successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No categories found."
     *     )
     * )
     */
    public function index()
    {
        try {
            $Category = Category::orderBy('id','asc')->with(['service'])->get(['id','name']);
            if(!$Category) {
                return response()->json([
                   'message' => 'No categories found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'Categories retrieved successfully.',
                'status' => 200,
                'data' => $Category,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/categories",
     *     summary="Create a new category",
     *     tags={"Category"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Cleaning")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation failed or category already exists."
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "name" => "required|string|unique:categories,name",
            ]);
            $Category = Category::create($ValidatedData);
            if(!$Category) {
                throw new CustomeExceptions('Category creation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Category created successfully.',
                'status' => 201,
                'data' => $Category,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/allizo/categories/{id}",
     *     summary="Get a category by ID",
     *     tags={"Category"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Category ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category retrieved successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found."
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $Category = Category::with(['service'])->select(['id','name'])->findOrFail($id);
            return response()->json([
                'message' => 'Category retrieved successfully.',
                'status' => 200,
                'data' => $Category,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/allizo/categories/{id}",
     *     summary="Update a category by ID",
     *     tags={"Category"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Category ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Category Name")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found."
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try {
            $ValidatedData = $request->validate([
                "name" => "sometimes|string|max:20|unique:categories,name,".$id,
            ]);
            $Category = Category::findOrFail($id);
            $updatedSuccess = $Category->update($ValidatedData);
            if(!$updatedSuccess) {
                throw new CustomeExceptions('Category updation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Category updated successfully.',
                'status' => 200,
                'data' => $Category,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/categories/{id}",
     *     summary="Delete a category by ID",
     *     tags={"Category"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Category ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category deleted successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found."
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $Category = Category::findOrFail($id);
            $Category->delete();
            return response()->json([
                'message' => 'Category deleted successfully.',
                'status' => 200,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
