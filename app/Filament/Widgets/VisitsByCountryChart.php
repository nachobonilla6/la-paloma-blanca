<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class VisitsByCountryChart extends ChartWidget
{
    protected static ?string $heading = 'Visits by Country';
    protected static ?string $pollingInterval = null;
    protected int | string | array $columnSpan = 6;

    protected function getData(): array
    {
        $countries = PageView::whereNotNull('country')
            ->selectRaw('country, COUNT(*) as total')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => $countries->pluck('total'),
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#059669',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $countries->pluck('country')->map(fn ($c) => $c ?: 'Unknown'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
