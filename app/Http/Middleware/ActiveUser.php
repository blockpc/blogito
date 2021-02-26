<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($blocked_at = auth()->user()->bloqueado()) {
            auth()->logout();
            return redirect()->route('login')
                ->with('blocked','Tu cuenta fue bloqueada el ' . $blocked_at . '. Comunicate con un administrador');
        }
        return $next($request);
    }
}
