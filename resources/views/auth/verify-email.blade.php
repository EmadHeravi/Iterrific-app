@extends('layouts.public')

@section('content')
    <section class="py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-md-5 text-center">
                            <div class="icon icon-shape icon-lg bg-gradient-warning shadow-warning text-center border-radius-lg mx-auto mb-4">
                                <i class="material-icons text-white">mark_email_unread</i>
                            </div>

                            <h4 class="mb-2">Confirm your email address</h4>
                            <p class="text-secondary mb-4">
                                Your account is active, but dashboard access is blocked until you verify your email address.
                                We sent a verification link to <strong>{{ auth()->user()->email }}</strong>.
                            </p>

                            @if (session('status'))
                                <div class="alert alert-success text-white text-sm" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @error('email')
                                <div class="alert alert-danger text-white text-sm" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="d-flex flex-column flex-sm-row justify-content-center gap-2">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn bg-gradient-warning mb-0">
                                        Resend Verification Email
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary mb-0">
                                        Sign Out
                                    </button>
                                </form>
                            </div>

                            <p class="text-xs text-secondary mb-0 mt-4">
                                After clicking the link in your email, return to the dashboard and continue.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
