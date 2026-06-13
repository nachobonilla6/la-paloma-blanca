<?php

namespace App\Filament\Resources\LaPaloma\PropertyContentResource\Pages;

use App\Filament\Resources\LaPaloma\PropertyContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePropertyContents extends ManageRecords
{
    protected static string $resource = PropertyContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
