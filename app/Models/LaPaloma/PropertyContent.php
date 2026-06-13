<?php

namespace App\Models\LaPaloma;

use Illuminate\Database\Eloquent\Model;

class PropertyContent extends Model
{
    protected $table = 'property_contents';
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'feature_list' => 'array',
        'life_highlights' => 'array',
        'beach_highlights' => 'array',
    ];
}
