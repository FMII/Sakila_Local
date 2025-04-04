<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
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
       
        
        if ($request->user() && ($request->user()->rol_id == 3 || $request->user()->rol_id == 1) || ($request->user()->rol_id == 2 && $request->method() == 'GET')) {
           
            return $next($request);
        }

       
        return redirect('/dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
