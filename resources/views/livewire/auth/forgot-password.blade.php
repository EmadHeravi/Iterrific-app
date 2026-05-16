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

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
</div>
