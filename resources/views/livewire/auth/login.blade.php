<div>
    <section class="min-vh-100 d-flex align-items-center bg-gray-200">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">

                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center py-3">
                            <h4 class="mb-0 fw-bold">Client Login</h4>
                        </div>

                        <div class="card-body p-4">
                            <form wire:submit.prevent="store">

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input
                                        wire:model.defer="email"
                                        type="email"
                                        class="form-control border"
                                        placeholder=" your@email.com"
                                        required
                                    >
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input
                                        wire:model.defer="password"
                                        type="password"
                                        class="form-control border"
                                        placeholder=" Password"
                                        required
                                    >
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-warning w-100">
                                    Sign in
                                </button>

                                <div class="text-center mt-3">
                                    <a href="{{ route('password.forgot') }}" class="text-secondary">
                                        Forgot password?
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
