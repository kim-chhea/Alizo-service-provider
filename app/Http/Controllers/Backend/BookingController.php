<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomeExceptions;
use App\Models\booking;
use App\Models\Wishlist;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(
 *     name="Booking",
 *     description="APIs for managing bookings"
 * )
 */
class BookingController extends Controller
{

     /**
     * @OA\Get(
     *     path="/api/allizo/booking",
     *     tags={"Booking"},
     *     summary="Get all bookings",
     *     @OA\Response(response=200, description="Bookings retrieved successfully"),
     *     @OA\Response(response=404, description="No bookings found")
     * )
     */
    public function index()
    {
        try
        {
            $bookings = booking::with(['user:id,name', 'services:id,title,price,description'])->get();
            
            if($bookings->isEmpty())
            {
                return response()->json([
                   'message' => 'No bookings found.',
                    'status' => 404,
                ]);
            }
            
            return response()->json([
                'message' => 'Bookings retrieved successfully.',
                'status' => 200,
                'data' => $bookings,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *  /**
     * @OA\Post(
     *     path="/api/allizo/booking",
     *     tags={"Booking"},
     *     summary="Create a booking",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Booking created successfully"),
     *     @OA\Response(response=500, description="Booking creation failed")
     * )
     */
    public function store(Request $request)
    {
        try
        {
          $ValidatedData = $request->validate([
            "user_id" => "required|integer|exists:users,id",
            "note" => "nullable|string",
            "subtotal" => "nullable|numeric",
            "tax" => "nullable|numeric",
            "discount_amount" => "nullable|numeric",
            "scheduled" => "nullable|date",
            "status" => "nullable|boolean",

            "booking_item" => "nullable|array",
            "booking_item.*.service_id" => "required_with:booking_item|integer|exists:services,id",
            "booking_item.*.booking_id" => "required|with:booking_item|integer|exists:bookings,id",
            "booking_item.*.discount_id" => "required|exists:discounts,id",
            "booking_item.*.quantity" => "required_with:booking_item|integer",
            "booking_item.*.total_price" => "required_with:booking_item|numeric",
            "booking_item.*.note" => "required|string",
            "booking_item.*.status" => "required|string",

          ]);
          DB::beginTransaction();
          $booking = booking::create($ValidatedData);
          if(!$booking)
          {
            throw new CustomeExceptions('booking creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'booking created successfully.',
            'status' => 201,
            'data' => $booking,
        ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *  /**
     * @OA\Get(
     *     path="/api/allizo/booking/{id}",
     *     tags={"Booking"},
     *     summary="Get a booking by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Booking retrieved successfully"),
     *     @OA\Response(response=404, description="Booking not found")
     * )
     */
    public function show(string $id)
    {
        try
        {
            $booking = booking::with(['services','user'])->findOrFail($id);
            return response()->json([
                'message' => 'booking retrieved successfully.',
                'status' => 200,
                'data' => $booking,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     * /**
     * @OA\Put(
     *     path="/api/allizo/booking/{id}",
     *     tags={"Booking"},
     *     summary="Update a booking",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Booking updated successfully"),
     *     @OA\Response(response=500, description="Booking update failed")
     * )
     */
    public function update(Request $request,$id)
    {
        try
        {
            $ValidatedData = $request->validate([
                "user_id" => "sometimes|integer|exists:users,id",
                "note" => "nullable|string",
                "scheduled" => "nullable|date",
                "is_confirmed" => "nullable|boolean"
              ]);

              $booking = booking::findOrFail($id);
              $updatedSuccess = $booking->update($ValidatedData);

          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('booking updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'booking updated successfully.',
            'status' => 200,
            'data' => $booking,
        ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * /**
     * @OA\Delete(
     *     path="/api/allizo/booking/{id}",
     *     tags={"Booking"},
     *     summary="Delete a booking",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Booking deleted successfully"),
     *     @OA\Response(response=500, description="Booking deletion failed")
     * )
     */
    public function destroy(string $id)
    {
        try
        {

            $booking = booking::findOrFail($id);
            $booking->delete();
            return response()->json([
                'message' => 'booking deleted successfully.',
                'status' => 200,
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }

    }
    /**
     * @OA\Post(
     *     path="/api/allizo/booking/{bookingId}/service/{serviceId}",
     *     tags={"Booking"},
     *     summary="Add a service to booking",
     *     @OA\Parameter(name="bookingId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Parameter(name="serviceId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"booking_date","time_slot","status"},
     *             @OA\Property(property="booking_data", type="string", format="date"),
     *             @OA\Property(property="time_slot", type="string", format="H:i:s"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Service added successfully"),
     *     @OA\Response(response=400, description="Service already exists")
     * )
     */

    public function addService(Request $request , $bookingId , $serviceId)
    {
        try
        {

            $validatedData = $request->validate([
                "booking_date" => "required|date",
                "time_slot" => "required|date_format:H:i:s",
                "status" => "required|string",
            ]);
            
            $booking = booking::findOrFail($bookingId);
            Service::findOrFail($serviceId);

            // Check if service already exists in booking
            $exists = $booking->services()->where('service_id', $serviceId)->exists();
            
            if($exists)
            {
                return response()->json([
                    'message' => 'Service already exists in this booking.',
                    'status' => 400
                ], 400);
            }
            
            $booking->services()->attach($serviceId,[
                "booking_date" => $validatedData['booking_date'],
                "time_slot" => $validatedData['time_slot'],
                "status" => $validatedData['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            return response()->json([
                'message' => 'Service added to booking successfully.',
                'status' => 200,
                'data' => $booking->load('services')
            ]);
        }
        catch(Exception $e){
        throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
    /**
 * @OA\Delete(
 *     path="/api/allizo/booking/{bookingId}/service/{serviceId}",
 *     tags={"Booking"},
 *     summary="Remove a service from a booking",
 *     @OA\Parameter(
 *         name="bookingId",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="serviceId",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Service removed from booking successfully"),
 *     @OA\Response(response=404, description="Service not found in this booking"),
 *     @OA\Response(response=500, description="Unexpected error")
 * )
 */
    public function removeService(Request $request , $bookingId,$serviceId)
    {
        try
        {
        $booking = booking::findOrFail($bookingId);
        
        $exists = $booking->services()->where('service_id', $serviceId)->exists();
        
        if(!$exists)
        {
         throw new CustomeExceptions('Service not found in this booking' , 404);
        }
            // remove it 
            $booking->services()->detach($serviceId);

            return response()->json([
                'message' => 'Service removed from booking.',
                'status' => 200
            ]);
        }
        catch(Exception $e)
        {
                throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
    
    /**
     * @OA\Post(
     *     path="/api/allizo/booking/checkout-wishlist",
     *     tags={"Booking"},
     *     summary="Create booking from wishlist",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="note", type="string", nullable=true),
     *             @OA\Property(property="scheduled", type="string", format="date", nullable=true)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Booking created from wishlist successfully"),
     *     @OA\Response(response=400, description="Wishlist is empty or not found")
     * )
     */
    public function checkoutFromWishlist(Request $request)
    {
        try
        {
            $data = $request->validate([
                "user_id" => "required|integer|exists:users,id",
                "note" => "nullable|string",
                "scheduled" => "nullable|date"
            ]);
            
            $wishlist = Wishlist::with('services')->where('user_id', $data['user_id'])->first();
            
            if(!$wishlist || $wishlist->services->isEmpty())
            {
                return response()->json([
                    'message' => 'Wishlist is empty or not found',
                    'status' => 400
                ], 400);
            }
            
            // Create new booking
            $booking = booking::create([
                'user_id' => $data['user_id'],
                'note' => $data['note'] ?? null,
                'scheduled' => $data['scheduled'] ?? now()->addDay(),
                'is_confirmed' => false
            ]);
            
            // Attach services from wishlist to booking
            foreach ($wishlist->services as $service) {
                $booking->services()->attach($service->id, [
                    'booking_date' => $data['scheduled'] ?? now()->addDay()->toDateString(),
                    'time_slot' => '09:00:00',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            // Clear wishlist after checkout
            $wishlist->services()->detach();
            
            return response()->json([
                'message' => 'Booking created successfully from wishlist.',
                'status' => 201,
                'data' => $booking->load('services')
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

}
