<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\Category;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Tag(
 *     name="Services",
 *     description="API Endpoints for managing services"
 * )
 */
class ServiceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/allizo/services",
     *     summary="Get all services",
     *     tags={"Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Services retrieved successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No services found"
     *     )
     * )
     */
    public function index()
    {
        try {
            $service = Service::with(['categories'])->get(['id','title','description','price','image']);
            if(!$service) {
                return response()->json([
                   'message' => 'No services found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'services retrieved successfully.',
                'status' => 200,
                'data' => $service,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/services",
     *     summary="Create a new service",
     *     tags={"Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"title", "description", "price", "category_id"},
     *                 @OA\Property(property="title", type="string", example="Haircut"),
     *                 @OA\Property(property="description", type="string", example="Professional men's haircut"),
     *                 @OA\Property(property="price", type="integer", example=15),
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="image", type="file", format="binary", description="Optional image")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service created successfully"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Service creation failed"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "title" => "required|string",
                "description" => "required|string",
                "price" => "required|integer",
                "category_id" => "required|integer",
                "image" => "nullable|image|mimes:png,jpg,jpeg|max:2048"
            ]);

            if($request->hasFile('image')) {
                $photo = $request->file('image');
                $fileName = $photo->hashName();
                $photo->storeAs('photos', $fileName, 'public');
            }

            $service = Service::create([
                'title' => $ValidatedData['title'],
                'description' => $ValidatedData['description'],
                'price' => $ValidatedData['price'],
                'image' => $fileName ?? null
            ]);

            $service->categories()->attach($ValidatedData['category_id']);

            if(!$service) {
                throw new CustomeExceptions('service creation failed due to an unexpected error.', 500);
            }

            return response()->json([
                'message' => 'service created successfully.',
                'status' => 201,
                'data' => $service->load('categories'),
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/allizo/services/{id}",
     *     summary="Get a service by ID",
     *     tags={"Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Service ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service retrieved successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $service = Service::with(['categories:name'])
                ->select(['id','title','description','price'])
                ->findOrFail($id);

            return response()->json([
                'message' => 'services retrieved successfully.',
                'status' => 200,
                'data' => $service,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/allizo/services/{id}",
     *     summary="Update an existing service",
     *     tags={"Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Service ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", example="New haircut style"),
     *                 @OA\Property(property="description", type="string", example="Updated haircut service"),
     *                 @OA\Property(property="price", type="integer", example=20),
     *                 @OA\Property(property="category_id", type="integer", example=2),
     *                 @OA\Property(property="image", type="file", format="binary", description="New optional image")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service updated successfully"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Service update failed"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try {
            $ValidatedData = $request->validate([
                "title" => "sometimes|string",
                "description" => "sometimes|string",
                "price" => "sometimes|integer",
                "category_id" => "sometimes|integer",
                "image" => "sometimes|image|mimes:png,jpg,jpeg|max:2048"
            ]);

            $service = Service::findOrFail($id);

            if(isset($ValidatedData['category_id'])) {
                Category::findOrFail($ValidatedData['category_id']);
                $alreadyExit = $service->categories()
                    ->where('categories.id', $ValidatedData['category_id'])
                    ->exists();

                if(!$alreadyExit) {
                    $service->categories()->attach($ValidatedData['category_id']);
                } else {
                    return response()->json([
                        "messsge" => "that category already existed in the service",
                        "status" => 400
                    ]);
                }
            }

            $updatedSuccess = $service->update($ValidatedData);

            if(!$updatedSuccess) {
                throw new CustomeExceptions('service updation failed due to an unexpected error.', 500);
            }

            return response()->json([
                'message' => 'service updated successfully.',
                'status' => 200,
                'data' => $service->load('categories'),
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/services/{id}",
     *     summary="Delete a service by ID",
     *     tags={"Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Service ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();

            return response()->json([
                'message' => 'services deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
