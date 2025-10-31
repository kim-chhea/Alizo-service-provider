<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomeExceptions;
use App\Models\cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\Hash;
/**
 * @OA\Tag(
 *     name="Carts",
 *     description="API Endpoints for managing carts"
 * )
 */
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *  /**
     * @OA\Get(
     *     path="/api/allizo/carts",
     *     summary="Get all carts",
     *     tags={"Carts"},
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="No carts found")
     * )
     */
    public function index()
    {
        try
        {

            $cart = cart::with(['services:id,title,price','user:id,name'])->get();
            if(!$cart)
            {
                return response()->json([
                   'message' => 'No carts found.',
                    'status' => 404,
                ]);
            }
            return response()->json([
                'message' => 'carts retrieved successfully.',
                'status' => 200,
                'data' => $cart,
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
        /**
     * @OA\Post(
     *     path="/api/allizo/carts",
     *     summary="Create a new cart",
     *     tags={"Carts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Cart created"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
          $ValidatedData = $request->validate([
            "user_id" => "required|integer|unique:carts,user_id",
          ]);
          //check if that user_id alrady have cart or not
         $cart = cart::create($ValidatedData);
          if(!$cart)
          {
            throw new CustomeExceptions('cart creation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'cart created successfully.',
            'status' => 201,
            'data' => $cart,
        ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/allizo/carts/{id}",
     *     summary="Get a specific cart",
     *     tags={"Carts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Cart retrieved"),
     *     @OA\Response(response=404, description="Cart not found")
     * )
     */
    public function show(string $id)
    {
        try
        {

            $cart = cart::with(['services:id,title,description,price','user:id,name,email'])->select(['id','user_id'])->findOrFail($id);
            return response()->json([
                'message' => 'carts retrieved successfully.',
                'status' => 200,
                'data' => $cart,
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
     *     path="/api/allizo/carts/{id}",
     *     summary="Update a cart",
     *     tags={"Carts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Cart updated"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(Request $request,$id)
    {
        try
        {
            $ValidatedData = $request->validate([
                "user_id" => "sometimes|integer|unique:carts,user_id,".$id
              ]);

              $cart = cart::findOrFail($id);
              $updatedSuccess = $cart->update($ValidatedData);

          if(!$updatedSuccess)
          {
            throw new CustomeExceptions('cart updation failed due to an unexpected error.', 500);
          }
          return response()->json([
            'message' => 'cart updated successfully.',
            'status' => 200,
            'data' => $cart->load('categories'),
        ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     *  /**
     * @OA\Delete(
     *     path="/api/allizo/carts/{id}",
     *     summary="Delete a cart",
     *     tags={"Carts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Cart deleted"),
     *     @OA\Response(response=404, description="Cart not found")
     * )
     */
    public function destroy(string $id)
    {
        try
        {

            $cart = cart::findOrFail($id);
            $cart->delete();
            return response()->json([
                'message' => 'carts deleted successfully.',
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
     *     path="/api/allizo/carts/{cartId}/service",
     *     summary="Add a service to a cart",
     *     tags={"Carts"},
     *     @OA\Parameter(
     *         name="cartId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"service_id"},
     *             @OA\Property(property="service_id", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Service added"),
     *     @OA\Response(response=404, description="Cart or service not found")
     * )
     */

    public function addToCart(Request $request , $cartId)
    {
        try
        {

            $valideteData = $request->validate([
                "service_id" => "required|integer",
            ]);
            //find is that cart exits or not
            $cart = cart::findOrFail($cartId);
            //get qty
            $quantity =  1;
            //find is that service already exit in that cart or not
            $service = $cart->services()->where('service_id',$valideteData['service_id'])->first();
            if($service)
            {
                $currentQty = $service->pivot->quantity;
                $cart->services()->updateExistingPivot($valideteData['service_id'], [
                    'quantity' => $quantity
                ]);
            } 
            else 
            {
                $cart->services()->attach($valideteData['service_id'], [
                    'quantity' => $quantity
                ]);
            }
            return response()->json([
                'message' => 'Service added to cart successfully.',
                'status' => 200
            ]);
        }
        catch(Exception $e){
        throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
     /**
     * @OA\Delete(
     *     path="/api/allizo/carts/{cartId}/service",
     *     summary="Remove a service from a cart",
     *     tags={"Carts"},
     *     @OA\Parameter(
     *         name="cartId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"service_id"},
     *             @OA\Property(property="service_id", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Service removed"),
     *     @OA\Response(response=404, description="Cart or service not found")
     * )
     */
    public function removeService(Request $request , $cartId)
    {
        try
        {
        $validatedate = $request->validate([
            "service_id" => 'required|integer'
        ]);
        //find cart base on id 
        $cart = cart::findOrFail($cartId);
        $service = $cart->services()->where('service_id', $request->input('service_id'))->exists();
        if(!$service)
        {
         throw new CustomeExceptions('Service not found in this cart' , 404);
        }
            // remove it 
            $cart->services()->detach($validatedate['service_id']);

            return response()->json([
                'message' => 'Service removed from cart.',
                'status' => 200
            ]);
        }
        catch(Exception $e)
        {
                throw new CustomeExceptions($e->getMessage() , 500);
        }
    }
    
        
}
