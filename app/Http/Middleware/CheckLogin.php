<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckLogin
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

        try{
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(TokenExpiredException $e){
            return response()->json(['error' => 'Token is expired'], 401);
        }
        catch(TokenInvalidException $e){
            return response()->json(['error' => 'Token is invalid'],401);
        }
        catch(Exception $e){
            return response()->json(['error' =>'Token not found'. $e->getMessage()], 401);
        }
        return $next($request);
    }
}
