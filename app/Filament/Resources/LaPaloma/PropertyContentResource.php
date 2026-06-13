<?php

namespace App\Filament\Resources\LaPaloma;

use App\Filament\Resources\LaPaloma\PropertyContentResource\Pages;
use App\Models\LaPaloma\PropertyContent;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyContentResource extends Resource
{
    protected static ?string $model = PropertyContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Property';
    protected static ?string $navigationLabel = 'Site Content';
    protected static ?string $slug = 'la-paloma/contenido';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Contenido')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Hero')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('hero')
                                    ->label('Hero Background Image')
                                    ->collection('hero')
                                    ->image()
                                    ->imagePreviewHeight('200')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('hero_badge')->label('Badge')->maxLength(255),
                                Forms\Components\TextInput::make('hero_title')->label('Title')->maxLength(255),
                                Forms\Components\TextInput::make('hero_accent')->label('Accent text')->maxLength(255),
                                Forms\Components\TextInput::make('hero_subtitle')->label('Subtitle')->maxLength(255),
                                Forms\Components\Textarea::make('hero_tagline')->label('Tagline')->rows(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Details')
                            ->schema([
                                Forms\Components\Textarea::make('details_intro')->label('Intro text')->rows(2),
                                Forms\Components\Textarea::make('details_description')->label('Description')->rows(3),
                                Forms\Components\Repeater::make('feature_list')
                                    ->label('Features')
                                    ->schema([
                                        Forms\Components\TextInput::make('icon')->label('Icon (FontAwesome)')->default('fas fa-check'),
                                        Forms\Components\TextInput::make('text')->label('Text'),
                                    ])
                                    ->defaultItems(0),
                                Forms\Components\TextInput::make('life_title')->label('Title "Life at..."')->maxLength(255),
                                Forms\Components\Textarea::make('life_text')->label('Text "Life at..."')->rows(3),
                                Forms\Components\Repeater::make('life_highlights')
                                    ->label('Highlights')
                                    ->schema([
                                        Forms\Components\TextInput::make('icon')->default('fas fa-check'),
                                        Forms\Components\TextInput::make('text'),
                                    ])
                                    ->defaultItems(0),
                                Forms\Components\TextInput::make('surf_title')->label('Title "Surf"')->maxLength(255),
                                Forms\Components\Textarea::make('surf_text')->label('Text "Surf"')->rows(3),
                            ]),
                        Forms\Components\Tabs\Tab::make('Beach')
                            ->schema([
                                Forms\Components\Textarea::make('beach_intro')->label('Intro')->rows(2),
                                Forms\Components\Textarea::make('beach_text_1')->label('Text 1')->rows(3),
                                Forms\Components\Textarea::make('beach_text_2')->label('Text 2')->rows(3),
                                Forms\Components\TextInput::make('beach_highlights_title')->label('Highlights title'),
                                Forms\Components\Repeater::make('beach_highlights')
                                    ->label('Highlights')
                                    ->schema([
                                        Forms\Components\TextInput::make('text'),
                                    ])
                                    ->defaultItems(0),
                                Forms\Components\TextInput::make('surfing_title')->label('Surfing title'),
                                Forms\Components\Textarea::make('surfing_text')->label('Surfing text')->rows(3),
                                Forms\Components\TextInput::make('sunset_title')->label('Sunset title'),
                                Forms\Components\Textarea::make('sunset_text')->label('Sunset text')->rows(3),
                            ]),
                        Forms\Components\Tabs\Tab::make('Contact')
                            ->schema([
                                Forms\Components\TextInput::make('contact_title')->label('Title')->maxLength(255),
                                Forms\Components\Textarea::make('contact_intro')->label('Intro')->rows(2),
                                Forms\Components\TextInput::make('contact_email')->label('Email')->email(),
                                Forms\Components\TextInput::make('contact_phone')->label('Phone'),
                                Forms\Components\TextInput::make('contact_whatsapp')->label('WhatsApp'),
                                Forms\Components\TextInput::make('owner_name')->label('Owner name'),
                            ]),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')->label('Meta title'),
                                Forms\Components\Textarea::make('meta_description')->label('Meta description')->rows(2),
                                Forms\Components\Toggle::make('is_active')->label('Active'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('hero_title')->label('Título')->limit(30),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePropertyContents::route('/'),
        ];
    }
}
