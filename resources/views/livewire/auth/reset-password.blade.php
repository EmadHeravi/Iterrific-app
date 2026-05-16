<div>
    <section class="min-vh-100 d-flex align-items-center bg-gray-200">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">

                    <div class="card shadow-lg">

                        <div class="card-header bg-warning text-white text-center py-3">

                            <h4 class="mb-0 fw-bold">
                                Reset Password
                            </h4>

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

                            <form wire:submit.prevent="update">

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
                                        New Password
                                    </label>

                                    <input
                                        wire:model="password"
                                        type="password"
                                        class="form-control border"
                                        placeholder="New password"
                                        required
                                    >

                                    @error('password')

                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>

                                {{-- CONFIRM PASSWORD --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        Confirm Password
                                    </label>

                                    <input
                                        wire:model="passwordConfirmation"
                                        type="password"
                                        class="form-control border"
                                        placeholder="Confirm password"
                                        required
                                    >

                                </div>

                                {{-- BUTTON --}}
                                <button
                                    type="submit"
                                    class="btn btn-warning w-100"
                                >
                                    Reset Password
                                </button>

                                {{-- LOGIN LINK --}}
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
