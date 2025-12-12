<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomeExceptions;
use App\Models\User;
use App\Services\Mail\Gmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            'password' => 'required|string|min:6'
        ]);

           // get value from user input
            $email = $request->input('email');
            $password = $request->input('password');
            //get user from email that mactch
            $user = User::where('email',$email)->first();
            // check that email and password match with user email and pw in database or not
            if(!$user || !Hash::check($password,$user->password))
            {
             throw new CustomeExceptions("The provided credentials are incorrect." , 401);
            }
            //create token 
            $token = $user->createToken('auth_token')->plainTextToken;
            
            // Send login notification email
            try {
                $mailService = new Gmail();
                $mailService->sendLoginNotification($user);
            } catch (Exception $mailException) {
                // Log error but don't fail the login
                Log::error('Failed to send login notification: ' . $mailException->getMessage());
            }
            
            return response()->json([
                'message' => 'Login successful',
                'status' => 200,
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'work_position' => $user->work_position,
                ],
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
            $token = $user->createToken('auth_token')->plainTextToken;
            
            // Send welcome email
            try {
                $mailService = new Gmail();
                $mailService->sendWelcomeEmail($user);
            } catch (Exception $mailException) {
                // Log error but don't fail the registration
                Log::error('Failed to send welcome email: ' . $mailException->getMessage());
            }
            
            return response()->json([
                'message' => 'Registration successful',
                'status' => 201,
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'work_position' => $user->work_position,
                ],
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
            // Validate token in body
            $validated = $request->validate([
                'token' => 'required|string'
            ]);
            
            // Get token from body
            $tokenString = $validated['token'];
            
            // Find and delete the token
            $tokenModel = \Laravel\Sanctum\PersonalAccessToken::findToken($tokenString);
            
            if (!$tokenModel) {
                throw new CustomeExceptions('Invalid or expired token', 401);
            }
            
            $tokenModel->delete();
            
            return response()->json([
                'message' => 'Logged out successfully', 
                'status' => 200
            ]);
        }
        catch(Exception $e)
        {
            throw new CustomeExceptions($e->getMessage(), 500);
        }
    }
}
