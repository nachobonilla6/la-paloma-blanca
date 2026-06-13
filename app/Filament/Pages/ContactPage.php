<?php

namespace App\Filament\Pages;

use App\Models\LaPaloma\PropertyContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class ContactPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Contact';
    protected static ?string $slug = 'site/contact';
    protected static ?string $title = 'Contact Section';

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
                TextInput::make('contact_title')->label('Title')->maxLength(255),
                Textarea::make('contact_intro')->label('Intro')->rows(2),
                TextInput::make('contact_email')->label('Email')->email(),
                TextInput::make('contact_phone')->label('Phone'),
                TextInput::make('contact_whatsapp')->label('WhatsApp'),
                TextInput::make('owner_name')->label('Owner name'),
            ])
            ->model(PropertyContent::class)
            ->statePath('data');
    }

    public function save(): void
    {
        $content = PropertyContent::firstOrCreate([], ['is_active' => true]);
        $content->update($this->form->getState());
        $this->notify('success', 'Contact section updated!');
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
