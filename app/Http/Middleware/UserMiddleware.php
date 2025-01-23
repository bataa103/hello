<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{

    public function handle(Request $request, Closure $next)
    {
             if (Auth::check()) {
                if(Auth::user()->isUser()){
                    return $next($request);
                }
            }
            else{
                return redirect('/')->with('status','Ta User bish baina.');
            }

            return redirect('/')->with('error', 'Access denied. Admins only.');
    }
}
