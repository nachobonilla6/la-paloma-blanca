<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\PropertyContent;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class BeachPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sun';
    protected static ?string $navigationLabel = 'Beach';
    protected static ?string $slug = 'site/beach';
    protected static ?string $title = 'Beach Section';

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
                Textarea::make('beach_intro')->label('Intro')->rows(2),
                Textarea::make('beach_text_1')->label('Text 1')->rows(3),
                Textarea::make('beach_text_2')->label('Text 2')->rows(3),
                TextInput::make('beach_highlights_title')->label('Highlights title'),
                Repeater::make('beach_highlights')
                    ->label('Highlights')
                    ->schema([
                        TextInput::make('text'),
                    ])
                    ->defaultItems(0),
                TextInput::make('surfing_title')->label('Surfing title'),
                Textarea::make('surfing_text')->label('Surfing text')->rows(3),
                TextInput::make('sunset_title')->label('Sunset title'),
                Textarea::make('sunset_text')->label('Sunset text')->rows(3),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());
        $this->notify('success', 'Beach section updated!');
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
