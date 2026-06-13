<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Google Analytics
        </x-slot>

        <div class="flex items-center justify-between p-4">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-full bg-primary-500/10">
                    <x-heroicon-m-chart-bar class="w-8 h-8 text-primary-500" />
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Seguimiento de visitas</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">GTM-WBB3NHBG</p>
                </div>
            </div>
            <x-filament::button
                tag="a"
                href="https://analytics.google.com/analytics/web/"
                target="_blank"
                icon="heroicon-m-arrow-top-right-on-square"
                color="gray">
                Abrir Google Analytics
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
