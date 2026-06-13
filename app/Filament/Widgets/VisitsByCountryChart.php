<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class VisitsByCountryChart extends ChartWidget
{
    protected static ?string $heading = 'Visits by Country';
    protected static ?string $pollingInterval = null;
    protected int | string | array $columnSpan = 4;

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
                    'backgroundColor' => [
                        '#0ea5e9', '#8b5cf6', '#f59e0b', '#10b981',
                        '#ef4444', '#ec4899', '#14b8a6', '#f97316',
                        '#6366f1', '#84cc16',
                    ],
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
