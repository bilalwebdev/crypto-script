<?php

namespace App\Http\Middleware;

use App\Models\Configuration;
use Closure;
use Illuminate\Http\Request;

class KycMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        $general = Configuration::first();

        if ($general->is_allow_kyc) {
            if (auth()->user()->is_kyc_verified != 1) {
                return redirect()->route('user.kyc')->with('error', 'Please Update Kyc Information');
            }
        }

        return $next($request);
    }
}
