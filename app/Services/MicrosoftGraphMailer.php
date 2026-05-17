<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class MicrosoftGraphMailer
{
    public function send(
        string $to,
        string $subject,
        string $html,
        ?string $replyToEmail = null,
        ?string $replyToName = null
    ): void {
        $from = (string) env('MS_MAIL_FROM');

        if ($from === '') {
            throw new RuntimeException('MS_MAIL_FROM is not configured.');
        }

        $payload = [
            'message' => [
                'subject' => $subject,
                'body' => [
                    'contentType' => 'HTML',
                    'content' => $html,
                ],
                'toRecipients' => [
                    [
                        'emailAddress' => [
                            'address' => $to,
                        ],
                    ],
                ],
            ],
            'saveToSentItems' => true,
        ];

        if ($replyToEmail) {
            $payload['message']['replyTo'] = [
                [
                    'emailAddress' => [
                        'address' => $replyToEmail,
                        'name' => $replyToName ?: $replyToEmail,
                    ],
                ],
            ];
        }

        $logoPath = public_path('assets/img/Logo.png');

        if (is_file($logoPath)) {
            $payload['message']['attachments'] = [
                [
                    '@odata.type' => '#microsoft.graph.fileAttachment',
                    'name' => 'iterrific-logo.png',
                    'contentType' => 'image/png',
                    'contentBytes' => base64_encode((string) file_get_contents($logoPath)),
                    'contentId' => 'iterrific-logo',
                    'isInline' => true,
                ],
            ];
        }

        $response = Http::withToken($this->accessToken())
            ->post("https://graph.microsoft.com/v1.0/users/{$from}/sendMail", $payload);

        if (! $response->successful()) {
            Log::error('Microsoft Graph Mail Error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'to' => $to,
                'subject' => $subject,
            ]);

            throw new RuntimeException('Unable to send email through Microsoft Graph.');
        }
    }

    private function accessToken(): string
    {
        $tenantId = (string) env('MS_TENANT_ID');

        $response = Http::asForm()->post(
            "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token",
            [
                'client_id' => env('MS_CLIENT_ID'),
                'client_secret' => env('MS_CLIENT_SECRET'),
                'scope' => 'https://graph.microsoft.com/.default',
                'grant_type' => 'client_credentials',
            ]
        );

        if (! $response->successful()) {
            Log::error('Microsoft Graph Token Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new RuntimeException('Unable to authenticate Microsoft Graph mail service.');
        }

        return (string) $response->json('access_token');
    }
}
