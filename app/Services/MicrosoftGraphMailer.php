<?php

namespace App\Services;

use App\Models\AppSetting;
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
        $from = $this->setting('ms_mail_from', 'services.microsoft_graph_mail.mail_from');

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

        $logoPath = AppSetting::publicPathFor('app_logo_path', 'assets/img/Logo.png');

        if ($logoPath && is_file($logoPath)) {
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
        $tenantId = $this->setting('ms_tenant_id', 'services.microsoft_graph_mail.tenant_id');
        $clientId = $this->setting('ms_client_id', 'services.microsoft_graph_mail.client_id');
        $clientSecret = $this->setting('ms_client_secret', 'services.microsoft_graph_mail.client_secret');

        if ($tenantId === '' || $clientId === '' || $clientSecret === '') {
            throw new RuntimeException('Microsoft Graph mail credentials are not configured.');
        }

        $response = Http::asForm()->post(
            "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token",
            [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
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

    public function fromAddress(): string
    {
        return $this->setting('ms_mail_from', 'services.microsoft_graph_mail.mail_from');
    }

    private function setting(string $settingKey, string $configKey): string
    {
        return (string) AppSetting::valueFor($settingKey, config($configKey, ''));
    }
}
