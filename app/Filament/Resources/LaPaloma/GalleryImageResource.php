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
    protected static ?string $navigationGroup = 'La Paloma Blanca';
    protected static ?string $navigationLabel = 'Galería de Fotos';
    protected static ?string $slug = 'la-paloma/galeria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('image_path')
                    ->label('URL de la imagen')
                    ->required()
                    ->maxLength(500),
                Forms\Components\TextInput::make('alt_text')
                    ->label('Texto alternativo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')->label('Activa')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('Foto')->size(60),
                Tables\Columns\TextColumn::make('alt_text')->label('Descripción')->limit(30),
                Tables\Columns\TextColumn::make('sort_order')->label('Orden')->sortable(),
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
