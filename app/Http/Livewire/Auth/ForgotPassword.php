<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Services\MicrosoftGraphMailer;
use App\Support\CaptchaValidator;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use RuntimeException;

class ForgotPassword extends Component
{
    public $email='';
    public $emailSent = false;
    public $sentEmail = '';
    public $captcha_token = '';
    
    protected $rules = [
        'email' => 'required|email',
    ];

    public function render()
    {
        $captchaProvider = CaptchaValidator::provider();

        return view('livewire.auth.forgot-password', [
            'captchaProvider' => $captchaProvider,
            'captchaSiteKey' => CaptchaValidator::siteKey($captchaProvider),
        ])
            ->layout('layouts.public');
    }

    public function show(){

        if(env('IS_DEMO')){
            return back()->with('demo', "You are in a demo version, you can't reset the password");
        }
        else{

        $this->validate();

        if (! CaptchaValidator::verify($this->captcha_token, request()->ip())) {
            $this->captcha_token = '';
            $this->addError('captcha_token', 'CAPTCHA verification failed.');

            return null;
        }

        $user = User::where('email', $this->email)->first();

        if($user){
            $mailer = app(MicrosoftGraphMailer::class);
            $resetUrl = URL::temporarySignedRoute(
                'reset-password',
                now()->addHours(12),
                ['id' => $user->id]
            );

            $html = view('emails.reset-password', [
                'expiresInHours' => 12,
                'resetUrl' => $resetUrl,
                'user' => $user,
            ])->render();

            try {
                $mailer->send(
                    $user->email,
                    'Reset your ITerrific password',
                    $html
                );
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->with('email', 'Unable to send the reset email right now. Please try again later.');
            }

            $this->sentEmail = $user->email;
            $this->emailSent = true;

            return back()->with('status', 'We have emailed your password reset link.');
        } else {
    
            return back()->with('email', "We can't find any user with that email address.");
    
        }
    }
}
}
