<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($jwt = $request->cookie('jwt')) { 
            $request->headers->set('Authorization', 'Bearer ' . $jwt);
         }
             try { 
                 $user = JWTAuth::parseToken($jwt);
             //    $user = JWTAuth::parseToken()->authenticate();
             
             } catch (Exception $e) {
                 if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                     return response()->json(['error' => 'Token is Invalid'], 403);
                 }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                     return response()->json(['error' => 'Token is Expired'], 401);
                 }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
                     return response()->json(['error' => 'Token is Blacklisted'], 400);
                 }else{
                         return response()->json(['error' => 'Authorization Token not found'], 404);
                 }
             }
             return $next($request);
    }
}
