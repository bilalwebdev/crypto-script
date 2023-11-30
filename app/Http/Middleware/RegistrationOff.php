<?php

namespace App\Http\Middleware;

use App\Models\Configuration;
use Closure;
use Illuminate\Http\Request;

class RegistrationOff
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
        $general = Configuration::first();


        if (!$general->reg_enabled) {
            return back()->with('error', 'System Registration Is off');
        }


        return $next($request);
    }
}
