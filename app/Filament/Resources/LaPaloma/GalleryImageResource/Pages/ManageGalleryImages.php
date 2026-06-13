<?php

namespace App\Filament\Resources\LaPaloma\GalleryImageResource\Pages;

use App\Filament\Resources\LaPaloma\GalleryImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGalleryImages extends ManageRecords
{
    protected static string $resource = GalleryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
