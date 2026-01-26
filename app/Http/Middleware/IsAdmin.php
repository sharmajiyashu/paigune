<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && in_array(Auth::user()->role, [User::$admin, User::$agent])) {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'Access denied. Admin or Agent only.');
    }
}
