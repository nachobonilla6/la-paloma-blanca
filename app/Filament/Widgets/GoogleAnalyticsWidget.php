<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class GoogleAnalyticsWidget extends Widget
{
    protected static string $view = 'filament.widgets.google-analytics';

    protected int | string | array $columnSpan = 'full';
}
