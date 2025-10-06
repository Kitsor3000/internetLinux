<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryModeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $mode = $request->query('mode');

        if ($mode === 'debug') {
            // Додаємо заголовок для debug режиму
            $request->headers->set('X-Debug-Mode', 'enabled');
        }

        return $next($request);
    }
}
