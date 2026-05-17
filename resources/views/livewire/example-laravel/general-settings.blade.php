<div>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">
                    <div class="row gx-4 align-items-center mb-3">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                                <i class="material-icons text-white">tune</i>
                            </div>
                        </div>

                        <div class="col-auto my-auto">
                            <h5 class="mb-1">General Settings</h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                Manage app-wide branding, localization, integrations, and service configuration.
                            </p>
                        </div>

                        @if($canWriteGeneralSettings)
                            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-end">
                                <button type="button" wire:click="save" class="btn bg-gradient-warning dynamic-config-btn mb-0">
                                    <i class="material-icons text-sm">save</i>
                                    &nbsp;&nbsp;Save Settings
                                </button>
                            </div>
                        @endif
                    </div>

                    <hr class="horizontal gray-light my-3">

                    @if(session('status'))
                        <div class="alert alert-success text-white text-sm">{{ session('status') }}</div>
                    @endif

                    <form wire:submit.prevent="save">
                        <section class="general-settings-section general-branding-section mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h6 class="mb-1">Branding</h6>
                                    <p class="text-xs text-secondary mb-0">
                                        App identity, browser tab appearance, and logos used across the dashboard.
                                    </p>
                                </div>
                                <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">Branding</span>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Application Name</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" wire:model.defer="settings.app_name" @disabled(! $canWriteGeneralSettings)>
                                    </div>
                                    @error('settings.app_name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Logo Path</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" wire:model.defer="settings.app_logo_path" @disabled(! $canWriteGeneralSettings)>
                                    </div>
                                    @error('settings.app_logo_path')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Favicon Path</label>
                                    <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" wire:model.defer="settings.app_favicon_path" @disabled(! $canWriteGeneralSettings)>
                                    </div>
                                    @error('settings.app_favicon_path')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-lg-7">
                                    <div class="general-browser-preview">
                                        <div class="general-browser-preview-label">
                                            Browser Preview
                                        </div>
                                        <div class="general-browser-topbar">
                                            <span></span><span></span><span></span>
                                        </div>
                                        <div class="general-browser-tab">
                                            <img src="{{ $this->faviconUrl() }}" alt="Browser favicon">
                                            <span>{{ $settings['app_name'] ?? 'ITerrific' }}</span>
                                        </div>
                                        <div class="general-browser-page">
                                            <img src="{{ $this->logoUrl() }}" alt="Current logo">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="general-branding-upload-panel mb-3">
                                        <div class="general-logo-preview">
                                            <img src="{{ $this->logoUrl() }}" alt="Current logo">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-label">Replace Logo</label>
                                            <input type="file" class="form-control general-file-input" wire:model="logoUpload" accept=".png,.jpg,.jpeg,.webp,.svg" @disabled(! $canWriteGeneralSettings)>
                                            <small class="text-secondary d-block mt-1">Transparent PNG or SVG, wide format for header/sidebar.</small>
                                            @error('logoUpload')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                            <div wire:loading wire:target="logoUpload" class="text-sm text-secondary mt-2">Preparing preview...</div>
                                        </div>
                                    </div>

                                    <div class="general-branding-upload-panel">
                                        <div class="general-favicon-preview">
                                            <img src="{{ $this->faviconUrl() }}" alt="Current favicon">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-label">Replace Favicon</label>
                                            <input type="file" class="form-control general-file-input" wire:model="faviconUpload" accept=".png,.ico,.jpg,.jpeg,.webp" @disabled(! $canWriteGeneralSettings)>
                                            <small class="text-secondary d-block mt-1">Square PNG or ICO, at least 64x64.</small>
                                            @error('faviconUpload')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                            <div wire:loading wire:target="faviconUpload" class="text-sm text-secondary mt-2">Preparing preview...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row g-3 general-settings-grid">
                            <div class="col-12 col-xl-6">
                                <section class="general-settings-section h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-1">Localization</h6>
                                            <p class="text-xs text-secondary mb-0">Language, country, and timezone defaults.</p>
                                        </div>
                                        <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">Localization</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Default Language</label>
                                            <div class="input-group input-group-outline">
                                                <select class="form-control" wire:model.defer="settings.default_language" @disabled(! $canWriteGeneralSettings)>
                                                    <option value="en">English</option>
                                                    <option value="nl">Dutch</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Default Country</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.default_country" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Timezone</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.timezone" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-12 col-xl-6">
                                <section class="general-settings-section h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-1">Captcha</h6>
                                            <p class="text-xs text-secondary mb-0">Captcha provider keys for public forms.</p>
                                        </div>
                                        <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">Security</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Captcha Provider</label>
                                            <div class="input-group input-group-outline">
                                                <select class="form-control" wire:model.live="settings.captcha_provider" @disabled(! $canWriteGeneralSettings)>
                                                    <option value="none">Disabled</option>
                                                    <option value="turnstile">Cloudflare Turnstile</option>
                                                    <option value="recaptcha">Google reCAPTCHA</option>
                                                </select>
                                            </div>
                                        </div>

                                        @if(($settings['captcha_provider'] ?? 'none') === 'turnstile')
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Turnstile Site Key</label>
                                                <div class="input-group input-group-outline">
                                                    <input type="text" class="form-control" wire:model.defer="settings.turnstile_site_key" @disabled(! $canWriteGeneralSettings)>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Turnstile Secret Key</label>
                                                <div class="input-group input-group-outline">
                                                    <input type="password" class="form-control" wire:model.defer="settings.turnstile_secret_key" @disabled(! $canWriteGeneralSettings)>
                                                </div>
                                                <small class="text-secondary d-block mt-1">Secret values are stored in the database.</small>
                                            </div>
                                        @elseif(($settings['captcha_provider'] ?? 'none') === 'recaptcha')
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">reCAPTCHA Site Key</label>
                                                <div class="input-group input-group-outline">
                                                    <input type="text" class="form-control" wire:model.defer="settings.recaptcha_site_key" @disabled(! $canWriteGeneralSettings)>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">reCAPTCHA Secret Key</label>
                                                <div class="input-group input-group-outline">
                                                    <input type="password" class="form-control" wire:model.defer="settings.recaptcha_secret_key" @disabled(! $canWriteGeneralSettings)>
                                                </div>
                                                <small class="text-secondary d-block mt-1">Secret values are stored in the database.</small>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <p class="text-sm text-secondary mb-0">Captcha is disabled for public forms.</p>
                                            </div>
                                        @endif
                                    </div>
                                </section>
                            </div>

                            <div class="col-12 col-xl-6">
                                <section class="general-settings-section h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-1">Microsoft Graph API</h6>
                                            <p class="text-xs text-secondary mb-0">Mail delivery credentials for Microsoft Graph.</p>
                                        </div>
                                        <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">Microsoft Graph</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Tenant ID</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.ms_tenant_id" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Client ID</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.ms_client_id" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Client Secret</label>
                                            <div class="input-group input-group-outline">
                                                <input type="password" class="form-control" wire:model.defer="settings.ms_client_secret" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Mail From</label>
                                            <div class="input-group input-group-outline">
                                                <input type="email" class="form-control" wire:model.defer="settings.ms_mail_from" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-12 col-xl-6">
                                <section class="general-settings-section h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-1">AWS</h6>
                                            <p class="text-xs text-secondary mb-0">Storage and cloud integration parameters.</p>
                                        </div>
                                        <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">AWS</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Access Key ID</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.aws_access_key_id" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Secret Access Key</label>
                                            <div class="input-group input-group-outline">
                                                <input type="password" class="form-control" wire:model.defer="settings.aws_secret_access_key" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Default Region</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.aws_default_region" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Bucket</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" class="form-control" wire:model.defer="settings.aws_bucket" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-12 col-xl-6">
                                <section class="general-settings-section h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-1">Maintenance</h6>
                                            <p class="text-xs text-secondary mb-0">Temporarily block normal access while administrators keep control.</p>
                                        </div>
                                        <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">Maintenance</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Enable Maintenance Mode</label>
                                            <div class="form-check form-switch ps-0 d-flex align-items-center gap-3">
                                                <input class="form-check-input ms-0 iterrific-checkbox" type="checkbox" role="switch" wire:model.defer="settings.maintenance_enabled" @disabled(! $canWriteGeneralSettings)>
                                                <span class="text-sm text-secondary">{{ ! empty($settings['maintenance_enabled']) ? 'Enabled' : 'Disabled' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Maintenance Message</label>
                                            <div class="input-group input-group-outline">
                                                <textarea class="form-control" rows="3" wire:model.defer="settings.maintenance_message" @disabled(! $canWriteGeneralSettings)></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-12 col-xl-6">
                                <section class="general-settings-section h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-1">System</h6>
                                            <p class="text-xs text-secondary mb-0">General operational values.</p>
                                        </div>
                                        <span class="badge badge-sm bg-gradient-warning dynamic-config-gradient">System</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Support Email</label>
                                            <div class="input-group input-group-outline">
                                                <input type="email" class="form-control" wire:model.defer="settings.support_email" @disabled(! $canWriteGeneralSettings)>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        @if($canWriteGeneralSettings)
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn bg-gradient-warning dynamic-config-btn">
                                    <i class="material-icons text-sm">save</i>
                                    &nbsp;&nbsp;Save Settings
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
