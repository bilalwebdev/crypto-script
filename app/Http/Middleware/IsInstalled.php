<?php

namespace App\Http\Middleware;

use App\Helpers\Helper\Helper;
use Closure;
use Illuminate\Http\Request;

class IsInstalled
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

        if(Helper::isInstalled()){
            header('Location:install');
            die();
        }

        return $next($request);
    }
}
