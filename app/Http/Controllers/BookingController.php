<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\booking;
use App\Models\cart;
use App\Models\review;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\Hash;
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

            $booking = booking::with(['user:id,name', 'services:id,title,price,description',])->get(['id', 'user_id',]);
            if(!$booking)
            {
                return response()->json([
                   'message' => 'No bookings found.',
                    'status' => 404,
                ]);
            }
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
            "user_id" => "required|integer|unique:bookings,user_id",
          ]);
          //check if that user_id alrady have booking or not
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

            $booking =booking::with(['services:id,title,description,price','user:id,name,email'])->select(['id','user_id'])->findOrFail($id);
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
                "user_id" => "sometimes|integer|unique:bookings,user_id,".$id
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

            $valideteData = $request->validate([
                "booking_data" => "required|date",
                "time_slot" => "required|date_format:H:i:s",
                "status" => "required|string",
            ]);
            //find is that booking is it exits or not
            $booking = booking::findOrFail($bookingId);
            $service = Service::findOrFail($serviceId);

            //find is that service already exit in that booking or not
           $service = $booking->services()->where('service_id', $serviceId)->exists();
           // return true or fail
            if($service)
            {
                return response()->json([
                    'message' => 'The services already had in that booking.'
                ]);
            } 
            else 
            {
                $booking->services()->attach($serviceId,[
                    "booking_date" => $valideteData['booking_data'],
                    "time_slot" => $valideteData['time_slot'],
                    "status" => $valideteData['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return response()->json([
                'message' => 'Service added to booking successfully.',
                'status' => 200,
                'data' => $service
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
        //find booking base on id 
        $booking = booking::findOrFail($bookingId);
        $service = booking::findOrFail($serviceId);
        $service = $booking->services()->where('service_id', $serviceId)->exists();
        if(!$service)
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
        public function checkoutfromcart(Request $request)
        {
            //validate user id
            $data = $request->validate([
                "user_id" => "required|integer|exists:users,id"
            ]);
            //check if that cart have service or not
            $cart = cart::with('services')->get()->where('user_id', $data['user_id'])->first();
            if(!$cart)
            {
                return response()->json([
                    'message' => 'Cart is empty or not found',
                    'status' => 400
                ]);
            }
            //create new booking 
            $booking = booking::create([
                'user_id' => $data['user_id']
            ]);
            // Attach services from cart to booking
            foreach ($cart->services as $service) {
                $booking->services()->attach($service->id, [
                    'booking_date' => now()->toDateString(),
                    'time_slot' => now()->format('H:i:s'),
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            //clear cart list
            $cart->services()->detach();
             // Step 7: Return success response
             return response()->json([
                'message' => 'Booking created successfully from cart.',
                'status' => 201,
                'data' => $booking->load('services')
    ]); 
        }
        
}
