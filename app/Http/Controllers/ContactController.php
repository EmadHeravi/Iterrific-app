<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1️⃣ Validate form fields
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // 2️⃣ Validate Cloudflare Turnstile
        $captchaResponse = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret'   => config('services.turnstile.secret_key'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]
        );

        if (!($captchaResponse->json('success') ?? false)) {
            return back()
                ->withErrors([
                    'captcha' => 'CAPTCHA verification failed.'
                ])
                ->withInput();
        }

        // 3️⃣ Get Microsoft Graph access token
        $tenantId = env('MS_TENANT_ID');

        $tokenResponse = Http::asForm()->post(
            "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token",
            [
                'client_id'     => env('MS_CLIENT_ID'),
                'client_secret' => env('MS_CLIENT_SECRET'),
                'scope'         => 'https://graph.microsoft.com/.default',
                'grant_type'    => 'client_credentials',
            ]
        );

        // Check token request
        if (!$tokenResponse->successful()) {

            \Log::error('Microsoft Graph Token Error', [
                'status' => $tokenResponse->status(),
                'body'   => $tokenResponse->body(),
            ]);

            return back()
                ->withErrors([
                    'mail' => 'Unable to authenticate mail service.'
                ])
                ->withInput();
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // 4️⃣ Send email via Microsoft Graph
        $mailResponse = Http::withToken($accessToken)
            ->post(
                'https://graph.microsoft.com/v1.0/users/info@iterrific.nl/sendMail',
                [
                    'message' => [

                        'subject' => 'New Contact Request - ITerrific Website',

                        'body' => [
                            'contentType' => 'Text',
                            'content' =>
                                "Name: {$request->name}\n" .
                                "Email: {$request->email}\n" .
                                "Subject: {$request->subject}\n\n" .
                                "Message:\n{$request->message}",
                        ],

                        'toRecipients' => [
                            [
                                'emailAddress' => [
                                    'address' => 'info@iterrific.nl',
                                ],
                            ],
                        ],

                        'replyTo' => [
                            [
                                'emailAddress' => [
                                    'address' => $request->email,
                                    'name'    => $request->name,
                                ],
                            ],
                        ],
                    ],
                ]
            );

        // 5️⃣ Check mail send result
        if (!$mailResponse->successful()) {

            \Log::error('Microsoft Graph Mail Error', [
                'status' => $mailResponse->status(),
                'body'   => $mailResponse->body(),
            ]);

            return back()
                ->withErrors([
                    'mail' => 'Unable to send message at this time.'
                ])
                ->withInput();
        }

        // 6️⃣ Success
        return back()->with(
            'success',
            'Thank you! Your message has been sent successfully.'
        );
    }
}