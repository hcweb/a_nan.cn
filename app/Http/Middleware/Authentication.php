<?php

namespace App\Http\Middleware;

use Closure;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        if (auth()->check()) {
            $permission = str_replace('.', '_', $request->route()->getName());
            if (auth()->user()->can($permission)) {
                return $next($request);
            } else {
                abort(403);
            }
        }
        */
        return $next($request);
    }
}
