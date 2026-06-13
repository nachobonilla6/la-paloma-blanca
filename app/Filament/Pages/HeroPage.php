<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\PropertyContent;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class HeroPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Hero';
    protected static ?string $slug = 'site/hero';
    protected static ?string $title = 'Hero Section';
    protected static string $view = 'filament.pages.hero';

    public ?array $data = [];

    public function mount(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $this->form->fill($content->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('hero')
                    ->label('Hero Background Image')
                    ->collection('hero')
                    ->image()
                    ->imagePreviewHeight('200')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                TextInput::make('hero_badge')->label('Badge')->maxLength(255),
                TextInput::make('hero_title')->label('Title')->maxLength(255),
                TextInput::make('hero_accent')->label('Accent text')->maxLength(255),
                TextInput::make('hero_subtitle')->label('Subtitle')->maxLength(255),
                Textarea::make('hero_tagline')->label('Tagline')->rows(2),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $state = $this->form->getState();
        
        // Separar los campos de Spatie (colecciones) de los campos normales
        $normalFields = collect($state)->except(['hero'])->toArray();
        $content->update($normalFields);
        
        // Spatie media library guarda automáticamente cuando se usa el uploader
        // con el modelo correcto en el formulario
        
        $this->notify('success', 'Hero section updated!');
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }
}
