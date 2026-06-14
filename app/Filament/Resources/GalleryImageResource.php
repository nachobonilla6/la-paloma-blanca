<?php

namespace App\Filament\Resources;

use App\Models\LaPaloma\GalleryImage;
use App\Filament\Resources\GalleryImageResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Photo Gallery';
    protected static ?string $slug = 'galeria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Gallery Photos')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Photos')
                            ->image()
                            ->disk('public_html')
                            ->directory('gallery')
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->imagePreviewHeight('150')
                            ->panelLayout('grid')
                            ->maxFiles(30)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
            ])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditGallery::route('/'),
        ];
    }
}
