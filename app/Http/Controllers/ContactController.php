<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1️⃣ Validate basic fields
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
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

        // 3️⃣ Success (email / DB later)
        return back()->with('success', 'Thank you! Your message has been sent.');
    }
}
