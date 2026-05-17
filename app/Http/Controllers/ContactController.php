<?php

namespace App\Http\Controllers;

use App\Services\MicrosoftGraphMailer;
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

        $captchaResponse = \Illuminate\Support\Facades\Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret' => config('services.turnstile.secret_key'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (! ($captchaResponse->json('success') ?? false)) {
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
                (string) env('MS_MAIL_FROM'),
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
}
