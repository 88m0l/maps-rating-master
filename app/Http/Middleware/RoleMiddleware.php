<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(auth()->check() && auth()->user()->role_id == $role){
            return $next($request);
        }
        return redirect()->to('/')->with('error', 'هذه صفحة ادمن انت غير مسموح لك بالدخول اليها.');
    }
}
