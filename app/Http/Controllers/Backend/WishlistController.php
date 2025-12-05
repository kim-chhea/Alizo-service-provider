<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomeExceptions;
use App\Http\Resources\WishlistResource;
use App\Models\wishlist;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Wishlist",
 *     description="API Endpoints for managing wishlists"
 * )
 */
class WishlistController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/allizo/wishlist",
     *     summary="Get all wishlists",
     *     tags={"Wishlist"},
     *     @OA\Response(
     *         response=200,
     *         description="List of wishlists retrieved successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No wishlists found."
     *     )
     * )
     */
    public function index()
    {
        try {
            $wishlists = wishlist::with(['user:id,name', 'services'])->get();
            
            if ($wishlists->isEmpty()) {
                return response()->json([
                    'message' => 'No wishlists found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'Wishlists retrieved successfully.',
                'status' => 200,
                'data' => WishlistResource::collection($wishlists),
            ]);
        } catch (Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/wishlist",
     *     summary="Create a new wishlist",
     *     tags={"Wishlist"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Wishlist created successfully."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation failed or wishlist already exists."
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "user_id" => "required|integer|unique:wishlists,user_id",
            ]);
            $wishlist = wishlist::create($ValidatedData);
            if (!$wishlist) {
                throw new CustomeExceptions('Wishlist creation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Wishlist created successfully.',
                'status' => 201,
                'data' => $wishlist,
            ]);
        } catch (Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/allizo/wishlist/{id}",
     *     summary="Get a wishlist by ID",
     *     tags={"Wishlist"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Wishlist retrieved successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wishlist not found."
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $wishlist = wishlist::with(['services'])->findOrFail($id);
            return response()->json([
                'message' => 'Wishlist retrieved successfully.',
                'status' => 200,
                'data' => new WishlistResource($wishlist),
            ]);
        } catch (Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/allizo/wishlist/{id}",
     *     summary="Update a wishlist by ID",
     *     tags={"Wishlist"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Wishlist updated successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wishlist not found."
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $ValidatedData = $request->validate([
                "user_id" => "sometimes|integer|unique:wishlists,user_id,".$id,
                "services" => "sometimes|array",
                "services.*" => "integer|exists:services,id"

            ]);
            $wishlist = wishlist::findOrFail($id);
            foreach($ValidatedData['services'] as $service_id) 
            {
                if($wishlist->services()->where('service_id', $service_id)->exists()) 
                    {
                        $wishlist->services()->detach($service_id);
                        continue;
                    }

                    $wishlist->services()->attach($service_id);
                }
            return response()->json([
                'message' => 'Wishlist updated successfully.',
                'status' => 200,
                'data' => $wishlist->load('services'),
            ]);
        } 
        catch (Exception $e) 
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/wishlist/{id}",
     *     summary="Delete a wishlist by ID",
     *     tags={"Wishlist"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Wishlist deleted successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Wishlist not found."
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $wishlist = wishlist::findOrFail($id);
            $wishlist->delete();
            return response()->json([
                'message' => 'Wishlist deleted successfully.',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/wishlist/{wishlistId}/service",
     *     summary="Add a service to a wishlist",
     *     tags={"Wishlist"},
     *     @OA\Parameter(
     *         name="wishlistId",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"service_id"},
     *             @OA\Property(property="service_id", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service added successfully."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Service already exists in wishlist."
     *     )
     * )
     */
    public function addService(Request $request, $wishlistId)
    {
        try 
        {
            $valideteData = $request->validate([
                "service_id" => "required|array|exists:services,id",
            ]);
            $wishlist = wishlist::findOrFail($wishlistId);
            foreach ($valideteData['service_id'] as $service_id)
            {
                $wishlist->services()->attach($service_id);
                if($wishlist->services()->where('service_id', $service_id)->exists()) 
                {
                    return response()->json([
                        'message' => 'Service already exists in this wishlist.',
                        'status' => 400
                    ]);

                }
            }
            return response()->json([
                'message' => 'Service added to wishlist successfully.',
                'status' => 200
            ]);
        } 
        catch (Exception $e) 
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/wishlist/{wishlistId}/service",
     *     summary="Remove a service from a wishlist",
     *     tags={"Wishlist"},
     *     @OA\Parameter(
     *         name="wishlistId",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"service_id"},
     *             @OA\Property(property="service_id", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service removed successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found in wishlist."
     *     )
     * )
     */
    public function removeService(Request $request, $wishlistId)
    {
        try {
            $validatedate = $request->validate([
                "service_id" => 'required|integer'
            ]);
            $wishlist = wishlist::findOrFail($wishlistId);
            $service = $wishlist->services()->where('service_id', $request->input('service_id'))->exists();
            if (!$service) {
                throw new CustomeExceptions('Service not found in this wishlist', 404);
            }
            $wishlist->services()->detach($validatedate['service_id']);
            return response()->json([
                'message' => 'Service removed from wishlist.',
                'status' => 200
            ]);
        } catch (Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
