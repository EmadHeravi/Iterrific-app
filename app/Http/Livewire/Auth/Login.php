<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{

    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.public');
    }

    public function mount() {
      
        $this->fill(['email' => 'admin@material.com', 'password' => 'secret']);    
    }
    
    public function store()
{
    $attributes = $this->validate();

    \Log::info('LOGIN ATTEMPT', [
        'email' => $this->email,
        'session_id_before' => session()->getId(),
        'is_https' => request()->isSecure(),
        'scheme' => request()->getScheme(),
        'host' => request()->getHost(),
        'cookie_secure' => config('session.secure'),
        'session_domain' => config('session.domain'),
    ]);

    if (! auth()->attempt($attributes)) {

            \Log::warning('LOGIN FAILED', [
                'email' => $this->email,
            ]);

            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        \Log::info('LOGIN SUCCESS BEFORE REGENERATE', [
            'user_id' => auth()->id(),
            'session_id_before_regenerate' => session()->getId(),
        ]);

        session()->regenerate();

        \Log::info('LOGIN SUCCESS AFTER REGENERATE', [
            'user_id' => auth()->id(),
            'session_id_after_regenerate' => session()->getId(),
        ]);

        return redirect('/dashboard');
    }
}
