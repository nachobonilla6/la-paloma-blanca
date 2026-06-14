<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\PropertyContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class DetailsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Details';
    protected static ?string $slug = 'site/details';
    protected static ?string $title = 'Details Section';
    protected static string $view = 'filament.pages.hero';
    protected static ?int $navigationSort = 2;

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
                FileUpload::make('details_image')
                    ->label('Details Image')
                    ->image()
                    ->disk('public_html')
                    ->directory('lp-photos')
                    ->imagePreviewHeight('250')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('details_title')
                            ->label('Title')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-bold'),
                        TextInput::make('details_intro')
                            ->label('Intro text')
                            ->prefixIcon('heroicon-o-chat-bubble-left-right'),
                    ]),
                Textarea::make('details_description')
                    ->label('Description')
                    ->rows(3)
                    ,
                Repeater::make('feature_list')
                    ->label('Features')
                    ->schema([
                        TextInput::make('icon')->label('Icon (FontAwesome)')->default('fas fa-check')->prefixIcon('heroicon-o-code-bracket'),
                        TextInput::make('text')->label('Text'),
                    ])
                    ->grid(2)
                    ->defaultItems(0),
                Grid::make(2)
                    ->schema([
                        TextInput::make('life_title')
                            ->label('Title "Life at..."')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-heart'),
                        TextInput::make('surf_title')
                            ->label('Title "Surf"')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-sparkles'),
                    ]),
                Grid::make(2)
                    ->schema([
                        Textarea::make('life_text')
                            ->label('Text "Life at..."')
                            ->rows(3)
                            ,
                        Textarea::make('surf_text')
                            ->label('Text "Surf"')
                            ->rows(3)
                            ,
                    ]),
                Repeater::make('life_highlights')
                    ->label('Highlights')
                    ->schema([
                        TextInput::make('icon')->default('fas fa-check'),
                        TextInput::make('text'),
                    ])
                    ->defaultItems(0)
                    ->grid(2),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());

        Notification::make()
            ->title('Details Section updated!')
            ->success()
            ->send();
    }
}
