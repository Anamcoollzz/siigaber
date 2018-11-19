<?php

namespace App\Http\Middleware;

use Closure;

class WajibMasuk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_null($request->user()))
            return redirect('login?goto='.url($request->route()->uri));
        return $next($request);
    }
}
