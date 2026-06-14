<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('panel')
            ->login()
            ->renderHook(
                'panels::head.end',
                fn () => '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /><style>.fi-wi-stats-overview-stats-ctn{grid-template-columns:repeat(1,minmax(0,1fr))!important}@media(min-width:768px){.fi-wi-stats-overview-stats-ctn{grid-template-columns:repeat(3,minmax(0,1fr))!important}}</style>'
            )
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\LaPalomaStats::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->default()
            ->authGuard('web')
            ->profile()
            ->darkMode(true);
    }
}
