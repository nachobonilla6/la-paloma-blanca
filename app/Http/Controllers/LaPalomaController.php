<?php

namespace App\Http\Controllers;

use App\Models\LaPaloma\PropertyContent;
use App\Models\LaPaloma\GalleryImage;
use App\Models\LaPaloma\Amenity;
use App\Models\LaPaloma\Article;

class LaPalomaController extends Controller
{
    public function index()
    {
        $content = PropertyContent::where('is_active', true)->first() ?? new PropertyContent();
        $amenities = Amenity::where('is_active', true)->orderBy('sort_order')->get();
        $articles = Article::where('is_active', true)->orderBy('sort_order')->get();

        $images = GalleryImage::where('is_active', true)
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '')
            ->orderBy('sort_order')
            ->get()
            ->map(function ($img) {
                $path = $img->image_path;
                if ($path && !str_starts_with($path, 'http') && !str_starts_with($path, '/')) {
                    $path = '/' . $path;
                }
                return (object) [
                    'image_path' => $path,
                    'alt_text' => $img->alt_text ?? 'Gallery image',
                ];
            });

        return view('la-paloma', compact('content', 'images', 'amenities', 'articles'));
    }
}
