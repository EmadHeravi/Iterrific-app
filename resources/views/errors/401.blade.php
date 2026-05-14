@extends('layouts.public')

@section('content')

<section class="py-7 min-vh-75 d-flex align-items-center bg-light">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8 text-center">

                <h1 class="display-1 fw-bold text-warning">
                    401
                </h1>

                <h2 class="fw-bold mb-3">
                    Unauthorized
                </h2>

                <p class="lead text-secondary mb-4">
                    You are not authorized to access this page.
                </p>

                <a href="{{ url('/') }}"
                   class="btn btn-warning btn-lg">

                    Return Home

                </a>

            </div>

        </div>

    </div>

</section>

@endsection