<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\PropertyContent;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class DetailsPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Details';
    protected static ?string $slug = 'site/details';
    protected static ?string $title = 'Details Section';

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
                Textarea::make('details_intro')->label('Intro text')->rows(2),
                Textarea::make('details_description')->label('Description')->rows(3),
                Repeater::make('feature_list')
                    ->label('Features')
                    ->schema([
                        TextInput::make('icon')->label('Icon (FontAwesome)')->default('fas fa-check'),
                        TextInput::make('text')->label('Text'),
                    ])
                    ->defaultItems(0),
                TextInput::make('life_title')->label('Title "Life at..."')->maxLength(255),
                Textarea::make('life_text')->label('Text "Life at..."')->rows(3),
                Repeater::make('life_highlights')
                    ->label('Highlights')
                    ->schema([
                        TextInput::make('icon')->default('fas fa-check'),
                        TextInput::make('text'),
                    ])
                    ->defaultItems(0),
                TextInput::make('surf_title')->label('Title "Surf"')->maxLength(255),
                Textarea::make('surf_text')->label('Text "Surf"')->rows(3),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());
        $this->notify('success', 'Details section updated!');
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
