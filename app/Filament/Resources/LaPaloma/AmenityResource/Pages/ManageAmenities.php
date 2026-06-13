<?php

namespace App\Filament\Resources\LaPaloma\AmenityResource\Pages;

use App\Filament\Resources\LaPaloma\AmenityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAmenities extends ManageRecords
{
    protected static string $resource = AmenityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
