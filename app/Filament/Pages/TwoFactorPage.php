<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $slug = '2fa';
    protected static ?string $title = 'Two-Factor Authentication';
    protected static string $view = 'filament.pages.hero';
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];
    public string $qrCode = '';
    public string $secret = '';

    public function mount(): void
    {
        $user = Auth::user();
        if ($user->two_factor_enabled) {
            $this->form->fill();
        } else {
            $google2fa = new Google2FA();
            $this->secret = $google2fa->generateSecretKey();
            $qrCodeUrl = $google2fa->getQRCodeUrl(
                'La Paloma Blanca',
                $user->email,
                $this->secret
            );
            $this->qrCode = $qrCodeUrl;
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->label('Authentication Code')
                    ->required()
                    ->maxLength(6)
                    ->placeholder('000000'),
            ])
            ->statePath('data');
    }

    public function verify(): void
    {
        $user = Auth::user();
        $google2fa = new Google2FA();

        $code = $this->form->getState()['code'] ?? '';

        if ($user->two_factor_enabled) {
            $valid = $google2fa->verifyKey($user->google2fa_secret, $code);
        } else {
            $valid = $google2fa->verifyKey($this->secret, $code);
            if ($valid) {
                $user->update([
                    'google2fa_secret' => $this->secret,
                    'two_factor_enabled' => true,
                ]);
            }
        }

        if ($valid) {
            session(['2fa_passed' => true]);
            Notification::make()->title('Verified!')->success()->send();
            $this->redirect('/lp-admin');
        } else {
            Notification::make()->title('Invalid code')->danger()->send();
        }
    }
}
