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
        $hoy = PageView::whereDate('visited_at', today())->count();
        $total = PageView::count();
        $unicos = PageView::distinct('ip')->count('ip');

        return [
            Stat::make('Total Visits', $total)
                ->description('All time page views')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),

            Stat::make('Visits Today', $hoy)
                ->description('Views in the last 24 hours')
                ->descriptionIcon('heroicon-m-clock')
                ->color('success'),

            Stat::make('Unique Visitors', $unicos)
                ->description('Distinct IP addresses')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
        ];
    }
}
