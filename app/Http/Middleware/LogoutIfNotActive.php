<?php

namespace App\Http\Middleware;

use Closure;

class LogoutIfNotActive
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
        $user = auth("admin")->user();

        if ($user && $user->status != 1) {

            \Flash::error(__('messages.not_found', ['model' => __('models/roles.singular')]));
            auth("admin")->logout();
        }


        return $next($request);

    }
}
