<?php

namespace App\Filament\Resources\LaPaloma\ArticleResource\Pages;

use App\Filament\Resources\LaPaloma\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageArticles extends ManageRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
