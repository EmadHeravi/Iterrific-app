<?php

namespace App\Http\Controllers;

use App\Services\MicrosoftGraphMailer;
use App\Support\CaptchaValidator;
use Illuminate\Http\Request;
use RuntimeException;

class ContactController extends Controller
{
    public function submit(Request $request, MicrosoftGraphMailer $mailer)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if (! $this->captchaIsValid($request)) {
            return back()
                ->withErrors([
                    'captcha' => 'CAPTCHA verification failed.'
                ])
                ->withInput();
        }

        $html = view('emails.contact-request', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messageBody' => $request->message,
        ])->render();

        try {
            $mailer->send(
                $mailer->fromAddress(),
                'New Contact Request - ITerrific Website',
                $html,
                $request->email,
                $request->name
            );
        } catch (RuntimeException $exception) {
            report($exception);

            return back()
                ->withErrors([
                    'mail' => 'Unable to send message at this time.'
                ])
                ->withInput();
        }

        return back()->with(
            'success',
            'Thank you! Your message has been sent successfully.'
        );
    }

    private function captchaIsValid(Request $request): bool
    {
        $token = CaptchaValidator::provider() === 'recaptcha'
            ? $request->input('g-recaptcha-response')
            : $request->input('cf-turnstile-response');

        return CaptchaValidator::verify($token, $request->ip());
    }
}
