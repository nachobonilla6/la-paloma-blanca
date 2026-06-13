<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    public function handle(Request $request, Closure $next): Response
    {
        // Solo contar GET requests a la página principal (no admin, no assets)
        if ($request->isMethod('get') && $request->path() === '/') {
            $ip = $request->ip();
            $country = null;

            // Detectar país desde la IP (cacheamos en sesión para no rate-limit)
            if ($ip && $ip !== '127.0.0.1' && !str_starts_with($ip, '192.168.')) {
                $country = cache()->remember("geoip_$ip", 86400, function () use ($ip) {
                    try {
                        $response = Http::timeout(2)->get("http://ip-api.com/json/$ip?fields=country");
                        if ($response->successful()) {
                            return $response->json('country');
                        }
                    } catch (\Exception $e) {
                        // Silently fail
                    }
                    return null;
                });
            }

            PageView::create([
                'url' => $request->fullUrl(),
                'ip' => $ip,
                'country' => $country,
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
