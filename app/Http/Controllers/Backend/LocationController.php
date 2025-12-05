<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomeExceptions;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Location",
 *     description="API Endpoints for managing locations"
 * )
 */
class LocationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/allizo/locations",
     *     summary="Get all locations",
     *     tags={"Location"},
     *     @OA\Response(
     *         response=200,
     *         description="Locations retrieved successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No locations found."
     *     )
     * )
     */
    public function index()
    {
        try {
            $location = Location::get();
            if(!$location) {
                return response()->json([
                   'message' => 'No locations found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'Locations retrieved successfully.',
                'status' => 200,
                'data' => LocationResource::collection($location),
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/allizo/locations",
     *     summary="Create a new location",
     *     tags={"Location"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"address","city","postal_code"},
     *             @OA\Property(property="address", type="string", example="123 Main St"),
     *             @OA\Property(property="city", type="string", example="Phnom Penh"),
     *             @OA\Property(property="postal_code", type="integer", example=12000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Location created successfully."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation failed or location already exists."
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $ValidatedData = $request->validate([
                "address" => "required|string|unique:locations,address",
                "city" => "required|string",
                "postal_code" => "required|integer",
                'country_code' => 'required|interger',
            ]);
            $location = Location::create($ValidatedData);
            if(!$location) {
                throw new CustomeExceptions('Location creation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Location created successfully.',
                'status' => 201,
                'data' => $location,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/allizo/locations/{id}",
     *     summary="Get a location by ID",
     *     tags={"Location"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Location ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location retrieved successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found."
     *     )
     * )
     */
    public function show(string $id)
    {
        try {
            $location = Location::with('user' ,'user.roles')->findOrFail($id);
            return response()->json([
                'message' => 'Locations retrieved successfully.',
                'status' => 200,
                'data' => new LocationResource($location),
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/allizo/locations/{id}",
     *     summary="Update a location by ID",
     *     tags={"Location"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Location ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="address", type="string", example="456 Main St"),
     *             @OA\Property(property="city", type="string", example="Siem Reap"),
     *             @OA\Property(property="postal_code", type="integer", example=13000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location updated successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found."
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        try {
            $ValidatedData = $request->validate([
                "address" => "sometimes|string",
                "city" => "sometimes|string",
                "postal_code" => "sometimes|integer",
                'country_code' => 'sometimes|integer',
            ]);
            $location = Location::findOrFail($id);
            $updatedSuccess = $location->update($ValidatedData);
            if(!$updatedSuccess) {
                throw new CustomeExceptions('Location updation failed due to an unexpected error.', 500);
            }
            return response()->json([
                'message' => 'Location updated successfully.',
                'status' => 200,
                'data' => $location,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/allizo/locations/{id}",
     *     summary="Delete a location by ID",
     *     tags={"Location"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Location ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location deleted successfully."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found."
     *     )
     * )
     */
    public function destroy(string $id)
    {
        try {
            $location = Location::findOrFail($id);
            $location->delete();
            return response()->json([
                'message' => 'Locations deleted successfully.',
                'status' => 200,
            ]);
        } catch(Exception $e) {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
