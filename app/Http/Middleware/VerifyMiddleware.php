<?php

namespace App\Http\Middleware;

use App\Traits\HasJson;
use Closure;
use Illuminate\Http\Request;

class VerifyMiddleware
{
    use HasJson;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(auth("api")->user()&&!auth("api")->user()->phone_number_verified_at)
        {
            return $this->sendError("Unverified",401);
        }
        return $next($request);
    }
}
