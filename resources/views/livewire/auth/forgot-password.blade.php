<div>
    <section class="iterrific-auth-shell">
        <div class="iterrific-auth-overlay"></div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="iterrific-auth-copy">
                        <img src="{{ asset(\App\Models\AppSetting::valueFor('app_logo_path', 'assets/img/Logo.png')) }}" alt="ITerrific" class="iterrific-auth-logo">
                        <h1>Recover access without losing momentum.</h1>
                        <p>We’ll send a secure reset link to the email address connected to your account.</p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-8 col-12 ms-lg-auto mx-auto">
                    <div class="iterrific-auth-card">
                        <div class="iterrific-auth-card-header">
                            <div class="iterrific-auth-icon">
                                <i class="material-icons text-white">lock_reset</i>
                            </div>
                            <div>
                                <h4 class="mb-1">Forgot password</h4>
                                <p class="mb-0">Enter your email to receive a reset link.</p>
                            </div>
                        </div>

                        @if (Session::has('status'))
                            <div class="alert alert-success text-white">{{ Session::get('status') }}</div>
                        @endif

                        @if (Session::has('email'))
                            <div class="alert alert-danger text-white">{{ Session::get('email') }}</div>
                        @endif

                        @if ($emailSent)
                            <div class="text-center py-2">
                                <div class="iterrific-auth-icon mx-auto mb-3">
                                    <i class="material-icons text-white">mark_email_read</i>
                                </div>
                                <h5 class="mb-2">Reset link sent</h5>
                                <p class="text-secondary text-sm mb-4">
                                    We sent a password reset link to <strong>{{ $sentEmail }}</strong>.
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-warning w-100">Back to Login</a>
                            </div>
                        @else
                            <form wire:submit.prevent="show">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input wire:model="email" type="email" class="form-control border" placeholder="your@email.com" required>
                                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                @if($captchaProvider === 'turnstile' && $captchaSiteKey)
                                    <div class="mb-3" wire:ignore>
                                        <div class="cf-turnstile" data-sitekey="{{ $captchaSiteKey }}" data-callback="forgotPasswordCaptchaCallback"></div>
                                    </div>
                                    @error('captcha_token')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                @elseif($captchaProvider === 'recaptcha' && $captchaSiteKey)
                                    <input type="hidden" wire:model="captcha_token">
                                    @error('captcha_token')<small class="text-danger d-block mb-3">{{ $message }}</small>@enderror
                                @endif

                                @if($captchaProvider === 'recaptcha' && $captchaSiteKey)
                                    <button type="button" class="btn btn-warning w-100" onclick="submitForgotPasswordWithRecaptcha()">Send Reset Link</button>
                                @else
                                    <button type="submit" class="btn btn-warning w-100">Send Reset Link</button>
                                @endif

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="text-secondary">Back to Login</a>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if($captchaProvider === 'turnstile' && $captchaSiteKey)
    @push('scripts')
        <script>
            window.forgotPasswordCaptchaCallback = function (token) {
                Livewire.find('{{ $this->getId() }}').set('captcha_token', token);
            };
        </script>
    @endpush
@elseif($captchaProvider === 'recaptcha' && $captchaSiteKey)
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ $captchaSiteKey }}"></script>
        <script>
            function submitForgotPasswordWithRecaptcha() {
                grecaptcha.ready(() => {
                    grecaptcha.execute('{{ $captchaSiteKey }}', { action: 'forgot_password' }).then((token) => {
                        const component = Livewire.find('{{ $this->getId() }}');
                        Promise.resolve(component.set('captcha_token', token)).then(() => component.call('show'));
                    });
                });
            }
        </script>
    @endpush
@endif
