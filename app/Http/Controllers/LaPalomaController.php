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
        \$content = PropertyContent::where('is_active', true)->first() ?? new PropertyContent();
        \$images = GalleryImage::where('is_active', true)->orderBy('sort_order')->get();
        \$amenities = Amenity::where('is_active', true)->orderBy('sort_order')->get();
        \$articles = Article::where('is_active', true)->orderBy('sort_order')->get();
        return view('la-paloma', compact('content', 'images', 'amenities', 'articles'));
    }
}
