<div>
    <section class="iterrific-auth-shell">
        <div class="iterrific-auth-overlay"></div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="iterrific-auth-copy">
                        <img src="{{ asset(\App\Models\AppSetting::valueFor('app_logo_path', 'assets/img/Logo.png')) }}" alt="ITerrific" class="iterrific-auth-logo">
                        <h1>Create a stronger password.</h1>
                        <p>Choose a new password for your ITerrific account before returning to your dashboard.</p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-8 col-12 ms-lg-auto mx-auto">
                    <div class="iterrific-auth-card">
                        <div class="iterrific-auth-card-header">
                            <div class="iterrific-auth-icon">
                                <i class="material-icons text-white">lock_reset</i>
                            </div>
                            <div>
                                <h4 class="mb-1">Reset password</h4>
                                <p class="mb-0">Enter your email and choose a new password.</p>
                            </div>
                        </div>

                        @if (Session::has('status'))
                            <div class="alert alert-success text-white">
                                {{ Session::get('status') }}
                            </div>
                        @endif

                        @if (Session::has('email'))
                            <div class="alert alert-danger text-white">
                                {{ Session::get('email') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="update">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input
                                    wire:model="email"
                                    type="email"
                                    class="form-control border"
                                    placeholder="your@email.com"
                                    required
                                >
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group auth-password-field">
                                    <input
                                        wire:model="password"
                                        type="password"
                                        class="form-control border auth-password-input"
                                        placeholder="New password"
                                        required
                                    >
                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary auth-password-toggle mb-0"
                                        aria-label="Show password"
                                        onclick="const input = this.closest('.auth-password-field').querySelector('.auth-password-input'); const icon = this.querySelector('.material-icons'); const visible = input.type === 'text'; input.type = visible ? 'password' : 'text'; icon.textContent = visible ? 'visibility' : 'visibility_off'; this.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');"
                                    >
                                        <span class="material-icons">visibility</span>
                                    </button>
                                </div>
                                @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group auth-password-field">
                                    <input
                                        wire:model="passwordConfirmation"
                                        type="password"
                                        class="form-control border auth-password-input"
                                        placeholder="Confirm password"
                                        required
                                    >
                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary auth-password-toggle mb-0"
                                        aria-label="Show password"
                                        onclick="const input = this.closest('.auth-password-field').querySelector('.auth-password-input'); const icon = this.querySelector('.material-icons'); const visible = input.type === 'text'; input.type = visible ? 'password' : 'text'; icon.textContent = visible ? 'visibility' : 'visibility_off'; this.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');"
                                    >
                                        <span class="material-icons">visibility</span>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">
                                Reset Password
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="text-secondary">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
