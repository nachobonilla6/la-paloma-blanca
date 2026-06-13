<?php

namespace App\Models\LaPaloma;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Amenity extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'amenities';
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];
}
