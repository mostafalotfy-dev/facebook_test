<?php

namespace App\Http\Middleware;


use Closure;

class NonSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ((int) request("admin") === 1) {
            return request()->expectsJson() ? response()->json([
                "success" => false,
                "message" => "Access Denied"
            ]) : abort(403);
        }
        return $next($request);
    }
}
