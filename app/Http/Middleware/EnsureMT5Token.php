<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\MT5\MT5Service;
use App\Jobs\MT5TokenJob;


class EnsureMT5Token
{
    protected $mt5Service;

    public function __construct(MT5Service $mt5Service)
    {
        $this->mt5Service = $mt5Service;
    }

    public function handle($request, Closure $next)
    {
        $mt5Token = $this->mt5Service->getToken();

        if ($mt5Token === null) {
            return response('Something went wrong with the MT5 server. Please reload the page.', 503);
        }

        return $next($request);
    }
}
