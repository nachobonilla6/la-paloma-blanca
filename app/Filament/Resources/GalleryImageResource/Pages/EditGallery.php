<?php

namespace App\Filament\Resources\GalleryImageResource\Pages;

use App\Filament\Resources\GalleryImageResource;
use App\Models\LaPaloma\GalleryImage;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class EditGallery extends Page
{
    protected static string $resource = GalleryImageResource::class;
    protected static string $view = 'filament.resources.gallery-image-resource.pages.edit-gallery';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function save(): void
    {
        $state = $this->form->getState();
        $files = $state['image_path'] ?? [];

        // Eliminar todas las fotos existentes y reemplazar con las nuevas
        GalleryImage::query()->delete();

        if (!empty($files)) {
            foreach ($files as $index => $file) {
                GalleryImage::create([
                    'image_path' => $file,
                    'alt_text' => '',
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }

        Notification::make()
            ->title('Gallery updated!')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Changes')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }
}
