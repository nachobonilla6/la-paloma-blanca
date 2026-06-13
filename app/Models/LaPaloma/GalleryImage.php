<?php

namespace App\Models\LaPaloma;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table = 'gallery_images';
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];
}
