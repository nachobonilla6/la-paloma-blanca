<?php

namespace App\Filament\Resources\LaPaloma;

use App\Filament\Resources\LaPaloma\AmenityResource\Pages;
use App\Models\LaPaloma\Amenity;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AmenityResource extends Resource
{
    protected static ?string $model = Amenity::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Property';
    protected static ?string $navigationLabel = 'Amenities';
    protected static ?string $slug = 'la-paloma/amenities';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('photo')
                            ->label('Photo')
                            ->collection('amenity-photos')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ]),
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon (FontAwesome)')
                            ->placeholder('fas fa-swimmer')
                            ->helperText('Search icons at ')
                            ->suffixAction(
                                \Filament\Forms\Components\Actions\Action::make('fontawesome')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url('https://fontawesome.com/search?o=r&m=free', true)
                            )
                            ->afterStateUpdated(function ($state, callable $set) {
                                // keep as-is
                            })
                            ->reactive()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(2),
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')->label('Active')->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->html()
                    ->formatStateUsing(fn ($state) => '<i class="' . $state . '"></i> ' . e($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
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
            'index' => Pages\ManageAmenities::route('/'),
        ];
    }
}
