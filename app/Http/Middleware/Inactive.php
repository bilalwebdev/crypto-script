<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Inactive
{

    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->status == 0) {
            Auth::logout();

            return redirect()->route('user.login')->with('error', 'You Account Is disabled');
        }
        return $next($request);
    }
}
