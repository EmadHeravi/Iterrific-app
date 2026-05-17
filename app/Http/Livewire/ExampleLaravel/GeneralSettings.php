<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\AppSetting;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralSettings extends Component
{
    use WithFileUploads;

    public array $settings = [];
    public $logoUpload;
    public $faviconUpload;

    public array $sections = [
        'localization' => 'Localization',
        'branding' => 'Branding',
        'security' => 'Captcha',
        'microsoft_graph' => 'Microsoft Graph API',
        'aws' => 'AWS',
        'maintenance' => 'Maintenance',
        'system' => 'System',
    ];

    public array $fields = [
        'app_name' => ['group' => 'branding', 'label' => 'Application Name', 'type' => 'text'],
        'app_logo_path' => ['group' => 'branding', 'label' => 'Logo Path', 'type' => 'text'],
        'app_favicon_path' => ['group' => 'branding', 'label' => 'Favicon Path', 'type' => 'text'],
        'default_language' => ['group' => 'localization', 'label' => 'Default Language', 'type' => 'select', 'options' => ['en' => 'English', 'nl' => 'Dutch']],
        'default_country' => ['group' => 'localization', 'label' => 'Default Country', 'type' => 'text'],
        'timezone' => ['group' => 'localization', 'label' => 'Timezone', 'type' => 'text'],
        'captcha_provider' => ['group' => 'security', 'label' => 'Captcha Provider', 'type' => 'select', 'options' => ['none' => 'Disabled', 'turnstile' => 'Cloudflare Turnstile', 'recaptcha' => 'Google reCAPTCHA']],
        'turnstile_site_key' => ['group' => 'security', 'label' => 'Turnstile Site Key', 'type' => 'text'],
        'turnstile_secret_key' => ['group' => 'security', 'label' => 'Turnstile Secret Key', 'type' => 'password', 'secret' => true],
        'recaptcha_site_key' => ['group' => 'security', 'label' => 'reCAPTCHA Site Key', 'type' => 'text'],
        'recaptcha_secret_key' => ['group' => 'security', 'label' => 'reCAPTCHA Secret Key', 'type' => 'password', 'secret' => true],
        'ms_tenant_id' => ['group' => 'microsoft_graph', 'label' => 'Tenant ID', 'type' => 'text'],
        'ms_client_id' => ['group' => 'microsoft_graph', 'label' => 'Client ID', 'type' => 'text'],
        'ms_client_secret' => ['group' => 'microsoft_graph', 'label' => 'Client Secret', 'type' => 'password', 'secret' => true],
        'ms_mail_from' => ['group' => 'microsoft_graph', 'label' => 'Mail From', 'type' => 'email'],
        'aws_access_key_id' => ['group' => 'aws', 'label' => 'Access Key ID', 'type' => 'text'],
        'aws_secret_access_key' => ['group' => 'aws', 'label' => 'Secret Access Key', 'type' => 'password', 'secret' => true],
        'aws_default_region' => ['group' => 'aws', 'label' => 'Default Region', 'type' => 'text'],
        'aws_bucket' => ['group' => 'aws', 'label' => 'Bucket', 'type' => 'text'],
        'maintenance_enabled' => ['group' => 'maintenance', 'label' => 'Enable Maintenance Mode', 'type' => 'checkbox'],
        'maintenance_message' => ['group' => 'maintenance', 'label' => 'Maintenance Message', 'type' => 'textarea'],
        'support_email' => ['group' => 'system', 'label' => 'Support Email', 'type' => 'email'],
    ];

    public function mount(): void
    {
        abort_unless(auth()->user()->role === 'administrator' && auth()->user()->canRead('general-settings'), 403);

        foreach ($this->fields as $key => $field) {
            $this->settings[$key] = AppSetting::valueFor($key, $this->defaultValue($key));
        }
    }

    public function save(): void
    {
        $this->authorizeWrite();

        $this->validate($this->rules());

        if ($this->faviconUpload) {
            $extension = strtolower($this->faviconUpload->getClientOriginalExtension() ?: 'png');
            $storedPath = $this->faviconUpload->storeAs('branding', 'favicon.' . $extension, 'public');
            $this->settings['app_favicon_path'] = 'storage/' . $storedPath;
        }

        if ($this->logoUpload) {
            $extension = strtolower($this->logoUpload->getClientOriginalExtension() ?: 'png');
            $storedPath = $this->logoUpload->storeAs('branding', 'logo.' . $extension, 'public');
            $this->settings['app_logo_path'] = 'storage/' . $storedPath;
        }

        foreach ($this->fields as $key => $field) {
            AppSetting::updateOrCreate(
                ['key' => $key],
                [
                    'group' => $field['group'],
                    'value' => $this->settings[$key] ?? null,
                    'type' => $field['type'],
                    'is_secret' => (bool) ($field['secret'] ?? false),
                ]
            );
        }

        session()->flash('status', 'General settings saved successfully.');
        $this->logoUpload = null;
        $this->faviconUpload = null;
    }

    private function rules(): array
    {
        $rules = collect($this->fields)
            ->mapWithKeys(function ($field, $key) {
                $rules = ['nullable', 'string', 'max:2000'];

                if (($field['type'] ?? null) === 'checkbox') {
                    return ['settings.' . $key => ['boolean']];
                }

                if (($field['type'] ?? null) === 'email') {
                    $rules[] = 'email';
                }

                if (($field['type'] ?? null) === 'select') {
                    $rules[] = 'in:' . implode(',', array_keys($field['options']));
                }

                return ['settings.' . $key => $rules];
            })
            ->all();

        $rules['logoUpload'] = ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'];
        $rules['faviconUpload'] = ['nullable', 'file', 'mimes:png,ico,jpg,jpeg,webp', 'max:1024'];

        return $rules;
    }

    private function defaultValue(string $key): ?string
    {
        return match ($key) {
            'app_name' => config('app.name'),
            'app_logo_path' => 'assets/img/Logo.png',
            'app_favicon_path' => 'assets/img/favicon.png',
            'default_language' => 'en',
            'default_country' => 'NL',
            'timezone' => config('app.timezone'),
            'captcha_provider' => config('services.turnstile.site_key') ? 'turnstile' : 'none',
            'turnstile_site_key' => config('services.turnstile.site_key'),
            'turnstile_secret_key' => config('services.turnstile.secret_key'),
            'recaptcha_site_key' => config('services.recaptcha.site_key'),
            'recaptcha_secret_key' => config('services.recaptcha.secret_key'),
            'ms_tenant_id' => config('services.microsoft_graph_mail.tenant_id'),
            'ms_client_id' => config('services.microsoft_graph_mail.client_id'),
            'ms_client_secret' => config('services.microsoft_graph_mail.client_secret'),
            'ms_mail_from' => config('services.microsoft_graph_mail.mail_from'),
            'aws_access_key_id' => config('filesystems.disks.s3.key'),
            'aws_secret_access_key' => config('filesystems.disks.s3.secret'),
            'aws_default_region' => config('filesystems.disks.s3.region'),
            'aws_bucket' => config('filesystems.disks.s3.bucket'),
            'maintenance_enabled' => '0',
            'maintenance_message' => 'ITerrific is temporarily unavailable while we perform scheduled maintenance. Please try again shortly.',
            'support_email' => config('services.microsoft_graph_mail.mail_from'),
            default => null,
        };
    }

    private function authorizeWrite(): void
    {
        abort_unless(auth()->user()->role === 'administrator' && auth()->user()->canWrite('general-settings'), 403);
    }

    public function render()
    {
        return view('livewire.example-laravel.general-settings', [
            'canWriteGeneralSettings' => auth()->user()->role === 'administrator' && auth()->user()->canWrite('general-settings'),
        ]);
    }

    public function faviconUrl(): string
    {
        if ($this->faviconUpload) {
            return $this->faviconUpload->temporaryUrl();
        }

        return $this->versionedAssetUrl($this->settings['app_favicon_path'] ?? 'assets/img/favicon.png');
    }

    public function logoUrl(): string
    {
        if ($this->logoUpload) {
            return $this->logoUpload->temporaryUrl();
        }

        return $this->versionedAssetUrl($this->settings['app_logo_path'] ?? 'assets/img/Logo.png');
    }

    private function versionedAssetUrl(string $path): string
    {
        $path = ltrim($path, '/');
        $absolutePath = public_path($path);
        $version = is_file($absolutePath) ? filemtime($absolutePath) : time();

        return asset($path) . '?v=' . $version;
    }
}
