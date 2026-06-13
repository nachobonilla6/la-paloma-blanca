<?php

namespace App\Filament\Resources\LaPaloma;

use App\Filament\Resources\LaPaloma\PropertyContentResource\Pages;
use App\Models\LaPaloma\PropertyContent;
use Filament\Forms;
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
                                Forms\Components\TextInput::make('hero_badge')->label('Badge')->maxLength(255),
                                Forms\Components\TextInput::make('hero_title')->label('Título')->maxLength(255),
                                Forms\Components\TextInput::make('hero_accent')->label('Texto destacado')->maxLength(255),
                                Forms\Components\TextInput::make('hero_subtitle')->label('Subtítulo')->maxLength(255),
                                Forms\Components\Textarea::make('hero_tagline')->label('Tagline')->rows(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Details')
                            ->schema([
                                Forms\Components\Textarea::make('details_intro')->label('Texto introductorio')->rows(2),
                                Forms\Components\Textarea::make('details_description')->label('Descripción')->rows(3),
                                Forms\Components\Repeater::make('feature_list')
                                    ->label('Lista de características')
                                    ->schema([
                                        Forms\Components\TextInput::make('icon')->label('Icono (FontAwesome)')->default('fas fa-check'),
                                        Forms\Components\TextInput::make('text')->label('Texto'),
                                    ])
                                    ->defaultItems(0),
                                Forms\Components\TextInput::make('life_title')->label('Título "Life at..."')->maxLength(255),
                                Forms\Components\Textarea::make('life_text')->label('Texto "Life at..."')->rows(3),
                                Forms\Components\Repeater::make('life_highlights')
                                    ->label('Highlights')
                                    ->schema([
                                        Forms\Components\TextInput::make('icon')->default('fas fa-check'),
                                        Forms\Components\TextInput::make('text'),
                                    ])
                                    ->defaultItems(0),
                                Forms\Components\TextInput::make('surf_title')->label('Título "Surf"')->maxLength(255),
                                Forms\Components\Textarea::make('surf_text')->label('Texto "Surf"')->rows(3),
                            ]),
                        Forms\Components\Tabs\Tab::make('Galería & Videos')
                            ->schema([
                                Forms\Components\TextInput::make('gallery_title')->label('Título galería')->maxLength(255),
                                Forms\Components\Textarea::make('gallery_intro')->label('Intro galería')->rows(2),
                                Forms\Components\TextInput::make('video_title')->label('Título videos')->maxLength(255),
                                Forms\Components\Textarea::make('video_intro')->label('Intro videos')->rows(2),
                                Forms\Components\TextInput::make('video_1_src')->label('Video 1 - URL'),
                                Forms\Components\TextInput::make('video_1_label')->label('Video 1 - Label'),
                                Forms\Components\TextInput::make('video_2_src')->label('Video 2 - URL'),
                                Forms\Components\TextInput::make('video_2_label')->label('Video 2 - Label'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Beach')
                            ->schema([
                                Forms\Components\Textarea::make('beach_intro')->label('Intro')->rows(2),
                                Forms\Components\Textarea::make('beach_text_1')->label('Texto 1')->rows(3),
                                Forms\Components\Textarea::make('beach_text_2')->label('Texto 2')->rows(3),
                                Forms\Components\TextInput::make('beach_highlights_title')->label('Título highlights'),
                                Forms\Components\Repeater::make('beach_highlights')
                                    ->label('Highlights')
                                    ->schema([
                                        Forms\Components\TextInput::make('text'),
                                    ])
                                    ->defaultItems(0),
                                Forms\Components\TextInput::make('surfing_title')->label('Título surfing'),
                                Forms\Components\Textarea::make('surfing_text')->label('Texto surfing')->rows(3),
                                Forms\Components\TextInput::make('sunset_title')->label('Título sunset'),
                                Forms\Components\Textarea::make('sunset_text')->label('Texto sunset')->rows(3),
                            ]),
                        Forms\Components\Tabs\Tab::make('Artículos')
                            ->schema([
                                Forms\Components\TextInput::make('articles_badge')->label('Badge')->maxLength(255),
                                Forms\Components\TextInput::make('articles_title')->label('Título')->maxLength(255),
                                Forms\Components\Textarea::make('articles_intro')->label('Intro')->rows(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Contacto')
                            ->schema([
                                Forms\Components\TextInput::make('contact_title')->label('Título')->maxLength(255),
                                Forms\Components\Textarea::make('contact_intro')->label('Intro')->rows(2),
                                Forms\Components\TextInput::make('contact_email')->label('Email')->email(),
                                Forms\Components\TextInput::make('contact_phone')->label('Teléfono'),
                                Forms\Components\TextInput::make('contact_whatsapp')->label('WhatsApp'),
                                Forms\Components\TextInput::make('owner_name')->label('Nombre del dueño'),
                            ]),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')->label('Meta título'),
                                Forms\Components\Textarea::make('meta_description')->label('Meta descripción')->rows(2),
                                Forms\Components\Toggle::make('is_active')->label('Activo'),
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
