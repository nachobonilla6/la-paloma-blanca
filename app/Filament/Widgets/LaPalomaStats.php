<?php

namespace App\Filament\Widgets;

use App\Models\LaPaloma\Amenity;
use App\Models\LaPaloma\Article;
use App\Models\LaPaloma\GalleryImage;
use App\Models\LaPaloma\PropertyContent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LaPalomaStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Amenities', Amenity::count())
                ->description('Registrados en el sitio')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('success'),

            Stat::make('Fotos en Galería', GalleryImage::count())
                ->description('Imágenes activas')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info'),

            Stat::make('Artículos', Article::count())
                ->description('Enlaces a medios externos')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),

            Stat::make('Contenido del Sitio', PropertyContent::count())
                ->description('Configuraciones guardadas')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),
        ];
    }
}
