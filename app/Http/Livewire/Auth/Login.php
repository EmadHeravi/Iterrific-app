<?php

namespace App\Http\Livewire\Auth;

use App\Support\CaptchaValidator;
use App\Support\TwoFactorCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use RuntimeException;

class Login extends Component
{

    public $email='';
    public $password='';
    public bool $remember = false;
    public $captcha_token = '';

    private const CAPTCHA_FAILURE_THRESHOLD = 3;

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function render()
    {
        $captchaProvider = CaptchaValidator::provider();

        return view('livewire.auth.login', [
            'captchaProvider' => $captchaProvider,
            'captchaSiteKey' => CaptchaValidator::siteKey($captchaProvider),
            'requiresCaptcha' => $this->requiresCaptcha(),
        ])->layout('layouts.public');
    }

    public function mount() {
    }
    
    public function store()
    {
        $attributes = $this->validate();

        if ($this->requiresCaptcha() && ! CaptchaValidator::verify($this->captcha_token, request()->ip())) {
            $this->captcha_token = '';
            $this->addError('captcha_token', 'CAPTCHA verification failed.');

            return null;
        }

        if (! auth()->attempt($attributes, $this->remember)) {
            $this->incrementFailedAttempts();
            $this->captcha_token = '';

            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();
        $this->clearFailedAttempts();

        session(['two_factor_verified' => false]);

        try {
            TwoFactorCode::send(auth()->user());
        } catch (RuntimeException $exception) {
            auth()->logout();
            session()->invalidate();
            session()->regenerateToken();
            report($exception);

            throw ValidationException::withMessages([
                'email' => 'Unable to send the two-factor security code right now.',
            ]);
        }

        return redirect()->route('two-factor.challenge');
    }

    public function requiresCaptcha(): bool
    {
        return CaptchaValidator::provider() !== 'none'
            && Cache::get($this->failureCacheKey(), 0) >= self::CAPTCHA_FAILURE_THRESHOLD;
    }

    private function incrementFailedAttempts(): void
    {
        $key = $this->failureCacheKey();
        $attempts = Cache::get($key, 0) + 1;

        Cache::put($key, $attempts, now()->addMinutes(30));
    }

    private function clearFailedAttempts(): void
    {
        Cache::forget($this->failureCacheKey());
    }

    private function failureCacheKey(): string
    {
        return 'login_failures.' . sha1(strtolower(trim($this->email)) . '|' . request()->ip());
    }
}
