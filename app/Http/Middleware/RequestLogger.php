<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::channel('stderr')->info([
            'url' => $request->fullUrl(),
            'request' => $request->all(),
        ]);

        $logs = [
            $request->getMethod(),
            $request->fullUrl(),
            $request->headers,
        ];

        Log::channel('stderr')->info(PHP_EOL.implode(PHP_EOL, $logs));

        return $next($request);
    }
}
