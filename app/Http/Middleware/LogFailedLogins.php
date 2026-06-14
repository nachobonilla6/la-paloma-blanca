<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogFailedLogins
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->is('panel/login') && $request->isMethod('POST') && $response->status() === 302) {
            $referer = $request->header('referer');
            if ($referer && str_contains($referer, 'panel/login')) {
                Log::warning('Failed login attempt', [
                    'ip' => $request->ip(),
                    'email' => $request->input('email'),
                    'user_agent' => $request->userAgent(),
                    'time' => now()->toDateTimeString(),
                ]);
            }
        }

        return $response;
    }
}
