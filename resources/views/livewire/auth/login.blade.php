<div>
    <section class="iterrific-auth-shell">
        <div class="iterrific-auth-overlay"></div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="iterrific-auth-copy">
                        <img src="{{ asset(\App\Models\AppSetting::valueFor('app_logo_path', 'assets/img/Logo.png')) }}" alt="ITerrific" class="iterrific-auth-logo">
                        <h1>Welcome back to your ITerrific workspace.</h1>
                        <p>Access time entries, approvals, projects, and billing in a secure dashboard built for operational clarity.</p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-8 col-12 ms-lg-auto mx-auto">
                    <div class="iterrific-auth-card">
                        <div class="iterrific-auth-card-header">
                            <div class="iterrific-auth-icon">
                                <i class="material-icons text-white">login</i>
                            </div>
                            <div>
                                <h4 class="mb-1">Sign in</h4>
                                <p class="mb-0">Use your account credentials to continue.</p>
                            </div>
                        </div>

                        <form wire:submit.prevent="store">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input wire:model="email" type="email" class="form-control border" placeholder="your@email.com" required>
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group auth-password-field">
                                    <input wire:model="password" type="password" class="form-control border auth-password-input" placeholder="Password" required>
                                    <button type="button" class="btn btn-outline-secondary auth-password-toggle mb-0" aria-label="Show password" onclick="const input = this.closest('.auth-password-field').querySelector('.auth-password-input'); const icon = this.querySelector('.material-icons'); const visible = input.type === 'text'; input.type = visible ? 'password' : 'text'; icon.textContent = visible ? 'visibility' : 'visibility_off'; this.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');">
                                        <span class="material-icons">visibility</span>
                                    </button>
                                </div>
                                @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-check mb-3">
                                <input wire:model="remember" class="form-check-input iterrific-checkbox" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>

                            @if($requiresCaptcha && $captchaProvider === 'turnstile' && $captchaSiteKey)
                                <div class="mb-3" wire:ignore>
                                    <div class="cf-turnstile" data-sitekey="{{ $captchaSiteKey }}" data-callback="loginCaptchaCallback"></div>
                                </div>
                                @error('captcha_token')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                            @elseif($requiresCaptcha && $captchaProvider === 'recaptcha' && $captchaSiteKey)
                                <input type="hidden" wire:model="captcha_token">
                                @error('captcha_token')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                            @endif

                            @if($requiresCaptcha && $captchaProvider === 'recaptcha' && $captchaSiteKey)
                                <button type="button" class="btn btn-warning w-100" onclick="submitLoginWithRecaptcha()">Sign in</button>
                            @else
                                <button type="submit" class="btn btn-warning w-100">Sign in</button>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="{{ route('password.forgot') }}" class="text-secondary text-sm">Forgot password?</a>
                                <a href="{{ route('register') }}" class="text-warning fw-bold text-sm">Create account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if($requiresCaptcha && $captchaProvider === 'turnstile' && $captchaSiteKey)
    @push('scripts')
        <script>
            window.loginCaptchaCallback = function (token) {
                Livewire.find('{{ $this->getId() }}').set('captcha_token', token);
            };
        </script>
    @endpush
@elseif($requiresCaptcha && $captchaProvider === 'recaptcha' && $captchaSiteKey)
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ $captchaSiteKey }}"></script>
        <script>
            function submitLoginWithRecaptcha() {
                grecaptcha.ready(() => {
                    grecaptcha.execute('{{ $captchaSiteKey }}', { action: 'login' }).then((token) => {
                        const component = Livewire.find('{{ $this->getId() }}');
                        Promise.resolve(component.set('captcha_token', token)).then(() => component.call('store'));
                    });
                });
            }
        </script>
    @endpush
@endif
