<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user(); 
    
        if ($user) {
    
            if ($user->role === 'owner') {

                return $next($request);
                
            } else {
                
                return redirect()->route('owner.dashboard');
            }
        }
        
        return redirect()->route('login');
    
    }
}
