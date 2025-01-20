<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;



// class AdminMiddleware
// {
//     /**
//      * Handle an incoming request.
//      */
//     public function handle(Request $request, Closure $next)
//     {
//         // Check if the user is authenticated and an admin
//         if (Auth::check() && Auth::user()->isAdmin()) {
//             return $next($request);
//         }

//         // Redirect or abort if the user is not an admin
//         return redirect('/')->with('error', 'Access denied. Admins only.');
//     }
// }

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PlanController;



class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request); // Allow admin access
        }

        // Redirect non-admin users to their dashboard
        return redirect()->route('user.dashboard')->with('error', 'Access denied. Admins only.');
    }
}
