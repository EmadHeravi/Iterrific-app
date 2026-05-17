<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Support\CaptchaValidator;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';
    public $captcha_token = '';

    protected $rules=[
    'first_name' => 'required|min:3',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:12',];


    public function store(){

        $attributes = $this->validate();

        if (! CaptchaValidator::verify($this->captcha_token, request()->ip())) {
            $this->captcha_token = '';
            $this->addError('captcha_token', 'CAPTCHA verification failed.');

            return null;
        }

        $user = User::create($attributes);

        event(new Registered($user));

        auth()->login($user);
        
        return redirect()->route('verification.notice');
    } 

    public function render()
    {
        $captchaProvider = CaptchaValidator::provider();

        return view('livewire.auth.register', [
            'captchaProvider' => $captchaProvider,
            'captchaSiteKey' => CaptchaValidator::siteKey($captchaProvider),
        ])
            ->layout('layouts.public');
    }
}
