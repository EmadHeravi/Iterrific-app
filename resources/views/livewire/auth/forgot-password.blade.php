<div>
    <section class="min-vh-100 d-flex align-items-center bg-gray-200">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">

                    <div class="card shadow-lg">

                        <div class="card-header bg-warning text-white text-center py-3">

                            <h4 class="mb-0 fw-bold">
                                Forgot Password
                            </h4>

                            <p class="mb-0 small text-white mt-2">
                                You will receive a reset email shortly
                            </p>

                        </div>

                        <div class="card-body p-4">

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

                            @if ($emailSent)
                                <div class="text-center py-2">
                                    <div class="icon icon-shape icon-lg bg-gradient-warning shadow-warning text-center border-radius-lg mx-auto mb-3">
                                        <i class="material-icons text-white">mark_email_read</i>
                                    </div>

                                    <h5 class="mb-2">
                                        Reset link sent
                                    </h5>

                                    <p class="text-secondary text-sm mb-4">
                                        We sent a password reset link to <strong>{{ $sentEmail }}</strong>.
                                        Check your inbox and follow the link to choose a new password.
                                    </p>

                                    <a
                                        href="{{ route('login') }}"
                                        class="btn btn-warning w-100"
                                    >
                                        Back to Login
                                    </a>
                                </div>
                            @else
                            <form wire:submit.prevent="show">

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

                                <button
                                    type="submit"
                                    class="btn btn-warning w-100"
                                >
                                    Send Reset Link
                                </button>

                                <div class="text-center mt-3">

                                    <a
                                        href="{{ route('login') }}"
                                        class="text-secondary"
                                    >
                                        Back to Login
                                    </a>

                                </div>

                            </form>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
</div>
