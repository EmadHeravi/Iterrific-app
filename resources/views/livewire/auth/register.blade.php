<div>
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
                                        Full Name
                                    </label>

                                    <input
                                        wire:model.defer="name"
                                        type="text"
                                        class="form-control border"
                                        placeholder="John Doe"
                                        required
                                    >

                                    @error('name')
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
                                        wire:model.defer="email"
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

                                    <input
                                        wire:model.defer="password"
                                        type="password"
                                        class="form-control border"
                                        placeholder="Password"
                                        required
                                    >

                                    @error('password')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                                {{-- TERMS --}}
                                <div class="form-check mb-3">

                                    <input
                                        class="form-check-input"
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