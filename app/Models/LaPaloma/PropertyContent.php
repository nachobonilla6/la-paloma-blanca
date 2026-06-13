<?php

namespace App\Models\LaPaloma;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PropertyContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'property_contents';
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'feature_list' => 'array',
        'life_highlights' => 'array',
        'beach_highlights' => 'array',
    ];
}
