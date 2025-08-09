<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Islogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('sanctum');
        if($user)
        {
            return $next($request);
        }
        if(!$user ) 
        {
            return response()->json(['message' => 'Please login or register' , 'status' => 401], 401);
        }
        return response()->json(['message' => 'Unauthentication' ,'status' => 401], 401);
        
    }
}
