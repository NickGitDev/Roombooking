<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = $guards[0] ?? null;

        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.rooms.index');
            } else {
                return redirect()->route('dashboard');
            }
        }
        return $next($request);
    }
}
