<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomeExceptions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        try
        {
            //validate input field
            $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:16'
        ]);

           // get value from user input
            $email = $request->input('email');
            $password = $request->input('password');
            //get user from email that mactch
            $user = User::where('email',$email)->first();
            // check that email and password match with user email and pw in database or not
            if(!$user || !Hash::check($password,$user->password))
            {
             throw new CustomeExceptions("The provided credentials are incorrect." , 400);
            }
            //create token 
            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'message' => 'Verified successfully',
                'status' => 200,
                'token' => $token,
            ]);

        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
       
        
    }
    public function register(Request $request)
    {
        try
        {
            // get user info , validate
          $ValidatedUser = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6",
            "gender" => "nullable|string",
            "first_name" => "nullable|string",
            "sure_name" => "nullable|string",
            "work_position" => "nullable|string"
          ]);
          
          // hash password
          $ValidatedUser['password'] = Hash::make($ValidatedUser['password']);
          
          // Ensure nullable fields exist with null as default
          $ValidatedUser = array_merge([
              'gender' => null,
              'first_name' => null,
              'sure_name' => null,
              'work_position' => null,
          ], $ValidatedUser);
          
          // create user
          $user = User::create($ValidatedUser);
          if($user)
          {
            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'message' => 'Registration successful',
                'status' => 201,
                'token' => $token,
            ]);
      
          }
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
    public function logout(Request $request)
    {
    
     try
     {
         $user = $request->user('sanctum');
         
         if(!$user)
         {
             throw new CustomeExceptions('Unauthenticated' , 401);
         }
         
         $token = $user->currentAccessToken();
         
         if($token)
         {
             $token->delete();
             return response()->json([
                 'message' => 'Logged out successfully', 
                 'status' => 200
             ]);
         }
         
         return response()->json([
             'message' => 'No active token found.',
             'status' => 400
         ]);
     }
     catch(Exception $e)
    {
      throw new CustomeExceptions($e->getMessage(),500);
    }
 
    }
}
