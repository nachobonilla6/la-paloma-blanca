<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = '';
    protected static ?string $navigationLabel = 'Dashboard';

    public function getTitle(): string
    {
        return '';
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\LaPalomaStats::class,
            \App\Filament\Widgets\DailyVisitsChart::class,
            \App\Filament\Widgets\VisitsByCountryChart::class,
        ];
    }
}
