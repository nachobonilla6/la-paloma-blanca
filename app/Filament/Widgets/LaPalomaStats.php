<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LaPalomaStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $totalViews = PageView::count();
        $todayViews = PageView::whereDate('visited_at', today())->count();
        $totalCountries = PageView::whereNotNull('country')
            ->selectRaw('COUNT(DISTINCT country) as c')
            ->value('c') ?? 0;

        return [
            Stat::make('Total Visits', number_format($totalViews))
                ->description('All time page views')
                ->descriptionIcon('heroicon-o-eye')
                ->color('info'),

            Stat::make('Visits Today', number_format($todayViews))
                ->description('Views in the last 24 hours')
                ->descriptionIcon('heroicon-o-clock')
                ->color($todayViews > 0 ? 'success' : 'gray'),

            Stat::make('Countries', number_format($totalCountries))
                ->description('Unique visitor countries')
                ->descriptionIcon('heroicon-o-globe-alt')
                ->color('warning'),
        ];
    }
}
