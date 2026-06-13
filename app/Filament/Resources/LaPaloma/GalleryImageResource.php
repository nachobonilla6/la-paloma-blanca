<?php

namespace App\Filament\Resources\LaPaloma;

use App\Filament\Resources\LaPaloma\GalleryImageResource\Pages;
use App\Models\LaPaloma\GalleryImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryImageResource extends Resource
{
    protected static ?string $model = GalleryImage::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Property';
    protected static ?string $navigationLabel = 'Photo Gallery';
    protected static ?string $slug = 'la-paloma/galeria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('image_path')
                    ->label('Image URL')
                    ->required()
                    ->maxLength(500),
                Forms\Components\TextInput::make('alt_text')
                    ->label('Alt text')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('Photo')->size(60),
                Tables\Columns\TextColumn::make('alt_text')->label('Description')->limit(30),
                Tables\Columns\TextColumn::make('sort_order')->label('Order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGalleryImages::route('/'),
        ];
    }
}
