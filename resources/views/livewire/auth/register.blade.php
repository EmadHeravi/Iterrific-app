<div>
    <style>
        .form-check:not(.form-switch) #terms.iterrific-checkbox[type="checkbox"]:checked,
        .form-check:not(.form-switch) #terms.iterrific-checkbox[type="checkbox"]:indeterminate {
            background: #fb8c00 !important;
            border-color: #fb8c00 !important;
        }

        .form-check:not(.form-switch) #terms.iterrific-checkbox[type="checkbox"]:focus {
            border-color: #fb8c00 !important;
            box-shadow: 0 0 0 0.2rem rgba(251, 140, 0, 0.18) !important;
        }
    </style>

    <section class="min-vh-100 d-flex align-items-center bg-gray-200">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">

                    <div class="card shadow-lg">

                        <div class="card-header bg-warning text-white text-center py-3">

                            <h4 class="mb-0 fw-bold">
                                Create Account
                            </h4>

                        </div>

                        <div class="card-body p-4">

                            <form wire:submit.prevent="store">

                                {{-- NAME --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        First Name
                                    </label>

                                    <input
                                        wire:model="first_name"
                                        type="text"
                                        class="form-control border"
                                        placeholder="John"
                                        required
                                    >

                                    @error('first_name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Last Name
                                    </label>

                                    <input
                                        wire:model="last_name"
                                        type="text"
                                        class="form-control border"
                                        placeholder="Doe"
                                        required
                                    >

                                    @error('last_name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                {{-- EMAIL --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        Email
                                    </label>

                                    <input
                                        wire:model="email"
                                        type="email"
                                        class="form-control border"
                                        placeholder="your@email.com"
                                        required
                                    >

                                    @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                {{-- PASSWORD --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        Password
                                    </label>

                                    <div class="input-group auth-password-field">
                                        <input
                                            wire:model="password"
                                            type="password"
                                            class="form-control border auth-password-input"
                                            placeholder="Password"
                                            required
                                        >

                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary auth-password-toggle mb-0"
                                            aria-label="Show password"
                                            onclick="
                                                const input = this.closest('.auth-password-field').querySelector('.auth-password-input');
                                                const icon = this.querySelector('.material-icons');
                                                const visible = input.type === 'text';
                                                input.type = visible ? 'password' : 'text';
                                                icon.textContent = visible ? 'visibility' : 'visibility_off';
                                                this.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');
                                            "
                                        >
                                            <span class="material-icons">visibility</span>
                                        </button>
                                    </div>

                                    @error('password')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                {{-- TERMS --}}
                                <div class="form-check mb-3">

                                    <input
                                        class="form-check-input iterrific-checkbox"
                                        type="checkbox"
                                        id="terms"
                                        required
                                    >

                                    <label class="form-check-label" for="terms">

                                        I agree to the

                                        <a
                                            href="#"
                                            class="text-warning fw-bold"
                                        >
                                            Privacy Policy
                                        </a>

                                    </label>

                                </div>

                                {{-- SUBMIT --}}
                                <button
                                    type="submit"
                                    class="btn btn-warning w-100"
                                >
                                    Sign Up
                                </button>

                                {{-- LOGIN LINK --}}
                                <div class="text-center mt-3">

                                    <p class="mb-0 text-sm text-secondary">

                                        Already have an account?

                                        <a
                                            href="{{ route('login') }}"
                                            class="text-warning fw-bold"
                                        >
                                            Sign in
                                        </a>

                                    </p>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
</div>
