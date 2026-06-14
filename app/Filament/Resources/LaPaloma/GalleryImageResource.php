<?php

namespace App\Filament\Resources\LaPaloma;

use App\Filament\Resources\LaPaloma\GalleryImageResource\Pages;
use App\Models\LaPaloma\GalleryImage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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
    protected static ?string $slug = 'la-paloma/galeria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image_path')
                    ->label('Photo')
                    ->image()
                    ->disk('public_html')
                    ->directory('lp-photos')
                    ->imagePreviewHeight('200')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->required(),
                Forms\Components\TextInput::make('alt_text')
                    ->label('Alt text')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('Photo')->size(80)->square(),
                Tables\Columns\TextColumn::make('alt_text')->label('Description')->limit(30),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->paginated(false)
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
