<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\PropertyContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class HeroPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Hero';
    protected static ?string $slug = 'site/hero';
    protected static ?string $title = 'Hero Section';
    protected static string $view = 'filament.pages.hero';
    protected static ?int $navigationSort = 1;

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
                FileUpload::make('hero_image')
                    ->label('Hero Background Image')
                    ->image()
                    ->disk('public_html')
                    ->directory('lp-photos')
                    ->imagePreviewHeight('250')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('hero_badge')
                            ->label('Badge')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-tag'),
                        TextInput::make('hero_subtitle')
                            ->label('Subtitle')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-map-pin'),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('Title')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-bold'),
                        TextInput::make('hero_accent')
                            ->label('Accent text')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-star'),
                    ]),
                Textarea::make('hero_tagline')
                    ->label('Tagline')
                    ->rows(2),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());

        Notification::make()
            ->title('Hero section updated!')
            ->success()
            ->send();
    }
}
