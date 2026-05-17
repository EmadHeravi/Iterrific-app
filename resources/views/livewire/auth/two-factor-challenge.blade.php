<div>
    <section class="iterrific-auth-shell">
        <div class="iterrific-auth-overlay"></div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="iterrific-auth-copy">
                        <img src="{{ asset(\App\Models\AppSetting::valueFor('app_logo_path', 'assets/img/Logo.png')) }}" alt="ITerrific" class="iterrific-auth-logo">
                        <h1>Secure access to your workspace.</h1>
                        <p>Enter the security code we sent to your email before opening the dashboard.</p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-8 col-12 ms-lg-auto mx-auto">
                    <div class="iterrific-auth-card">
                        <div class="iterrific-auth-card-header">
                            <div class="iterrific-auth-icon">
                                <i class="material-icons text-white">verified_user</i>
                            </div>
                            <div>
                                <h4 class="mb-1">Two-factor verification</h4>
                                <p class="mb-0">We sent a 6-digit code to {{ auth()->user()->email }}.</p>
                            </div>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success text-white text-sm">{{ session('status') }}</div>
                        @endif

                        <form wire:submit.prevent="verify">
                            <div class="mb-3">
                                <label class="form-label">Security Code</label>
                                <input
                                    wire:model.defer="code"
                                    type="text"
                                    inputmode="numeric"
                                    maxlength="6"
                                    class="form-control border iterrific-auth-code"
                                    placeholder="000000"
                                    required
                                >
                                @error('code')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Verify and Continue</button>
                        </form>

                        <button type="button" class="btn btn-link text-warning w-100 mt-3 mb-0" wire:click="resend">
                            Resend code
                        </button>

                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary w-100 mb-0">Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
