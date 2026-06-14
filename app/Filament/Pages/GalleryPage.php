<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\GalleryImage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class GalleryPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Photo Gallery';
    protected static ?string $slug = 'galeria';
    protected static ?string $title = 'Photo Gallery';
    protected static string $view = 'filament.pages.gallery';
    protected static ?int $navigationSort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(GalleryImage::query())
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Photo')
                    ->size(80)
                    ->disk('public_html'),
                TextColumn::make('alt_text')
                    ->label('Description')
                    ->limit(30),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                CreateAction::make()
                    ->label('Add Image')
                    ->icon('heroicon-o-plus')
                    ->color('success')
                    ->form([
                        FileUpload::make('image_path')
                            ->label('Image')
                            ->disk('public_html')
                            ->directory('gallery')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->required(),
                        TextInput::make('alt_text')
                            ->label('Description')
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->label('Order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        if (isset($data['image_path']) && is_string($data['image_path'])) {
                            $data['image_path'] = 'gallery/' . $data['image_path'];
                        }
                        return $data;
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        FileUpload::make('image_path')
                            ->label('Image')
                            ->disk('public_html')
                            ->directory('gallery')
                            ->image()
                            ->imagePreviewHeight('200'),
                        TextInput::make('alt_text')
                            ->label('Description')
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->label('Order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
                DeleteAction::make(),
            ]);
    }
}
