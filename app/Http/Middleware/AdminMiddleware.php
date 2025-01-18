<?php

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
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and an admin
        if (Auth::check()) {
            if(Auth::user()->isAdmin()){
                return $next($request);
            }
        }
        else{
            return redirect('/')->with('status','Ta Admin bish baina.');
        }

        // Redirect or abort if the user is not an admin
        return redirect('/')->with('error', 'Access denied. Admins only.');
    }
}
