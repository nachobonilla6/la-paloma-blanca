<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    public function handle(Request $request, Closure $next): Response
    {
        // Solo contar GET requests a la página principal
        if ($request->isMethod('get') && $request->path() === '/') {
            PageView::create([
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
