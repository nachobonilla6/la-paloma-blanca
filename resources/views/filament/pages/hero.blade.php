<x-filament::page>
    {{ $this->form }}

    <div class="flex justify-end mt-6">
        <x-filament::button wire:click="save" color="primary">
            Save
        </x-filament::button>
    </div>
</x-filament::page>
