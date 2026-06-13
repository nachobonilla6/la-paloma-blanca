<?php

namespace App\Filament\Widgets;

use App\Models\LaPaloma\Amenity;
use App\Models\LaPaloma\Article;
use App\Models\LaPaloma\GalleryImage;
use App\Models\LaPaloma\PropertyContent;
use App\Models\PageView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LaPalomaStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $hoy = PageView::whereDate('visited_at', today())->count();
        $semana = PageView::whereBetween('visited_at', [now()->subDays(7), now()])->count();
        $total = PageView::count();

        return [
            Stat::make('Visitas Hoy', $hoy)
                ->description("$semana esta semana · $total total")
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary')
                ->chart([7, 9, 8, 12, 10, 15, $hoy]),

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
