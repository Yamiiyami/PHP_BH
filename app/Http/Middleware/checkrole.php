<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class checkrole
{
    public function handle(Request $request, Closure $next,$role)
    {
        
        if (!$user = auth()->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $us = DB::table('customers')->find($user['id']);

        if (!$us) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $roleName = DB::table('roles')->where('id', $us->role_id)->value('name');

        if ($roleName !== $role) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
