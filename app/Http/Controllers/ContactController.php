<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1️⃣ Validate basic fields
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // 2️⃣ Validate Cloudflare Turnstile
        $response = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret'   => config('services.turnstile.secret_key'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (!($response->json('success') ?? false)) {
            return back()
                ->withErrors(['captcha' => 'CAPTCHA verification failed'])
                ->withInput();
        }

        // 3️⃣ Send email
        Mail::raw(
            "Name: {$request->name}\n" .
            "Email: {$request->email}\n" .
            "Subject: {$request->subject}\n\n" .
            "Message:\n{$request->message}",
            function ($message) use ($request) {
                $message->to('info@iterrific.nl')
                        ->replyTo($request->email, $request->name)
                        ->subject('New Contact Request - ITerrific Website');
            }
        );

        // 4️⃣ Success response
        return back()->with(
            'success',
            'Thank you! Your message has been sent successfully.'
        );
    }
}
