<?php

namespace App\Http\Livewire\Auth;

use App\Support\TwoFactorCode;
use Livewire\Component;
use RuntimeException;

class TwoFactorChallenge extends Component
{
    public string $code = '';
    public int $resendCooldown = 0;

    protected array $rules = [
        'code' => ['required', 'digits:6'],
    ];

    public function mount(): void
    {
        abort_unless(auth()->check(), 403);

        if (session('two_factor_verified') === true) {
            redirect()->route('dashboard');
        }

        if (! TwoFactorCode::hasActiveCode(auth()->user())) {
            try {
                TwoFactorCode::send(auth()->user());
                session()->flash('status', 'A security code has been sent to your email.');
            } catch (RuntimeException $exception) {
                report($exception);
                $this->addError('code', 'Unable to send your security code right now. Please try again later.');
            }
        }

        $this->resendCooldown = TwoFactorCode::secondsUntilResend(auth()->user());
    }

    public function verify()
    {
        $this->validate();

        if (! TwoFactorCode::verify(auth()->user(), $this->code)) {
            $this->code = '';
            $this->addError('code', 'The security code is invalid or has expired.');

            return null;
        }

        session(['two_factor_verified' => true]);

        return redirect()->route('dashboard');
    }

    public function resend(): void
    {
        $this->resendCooldown = TwoFactorCode::secondsUntilResend(auth()->user());

        if ($this->resendCooldown > 0) {
            return;
        }

        try {
            TwoFactorCode::send(auth()->user());
            $this->resendCooldown = 60;
            session()->flash('status', 'A new security code has been sent.');
        } catch (RuntimeException $exception) {
            report($exception);
            $this->addError('code', 'Unable to send a new code right now. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.auth.two-factor-challenge')
            ->layout('layouts.public');
    }
}
