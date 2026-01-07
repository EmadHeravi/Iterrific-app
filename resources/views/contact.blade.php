@extends('layouts.public')

@section('content')

<!-- =======================
 Contact Hero
======================== -->
<section class="py-6 position-relative"
         style="background-image:url('{{ asset('assets/img/Slide/bg2.jpg') }}');
                background-size:cover;
                background-position:center;">
    <span class="mask bg-gradient-dark opacity-7"></span>

    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="fw-bold text-white">Contact Us</h1>
                <p class="lead text-white opacity-9 mt-3">
                    Let’s talk about how ITerrific can support your organization.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- =======================
 Contact Info + Form
======================== -->
<section class="py-6 bg-light">
    <div class="container">
        <div class="row g-5">

            <!-- Contact Info -->
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4">Get in touch</h3>

                <div class="mb-4 d-flex">
                    <i class="material-icons text-warning me-3">location_on</i>
                    <div>
                        <h6 class="fw-bold mb-1">Office Address</h6>
                        <p class="text-secondary mb-0">
                            ITerrific B.V.<br>
                            Your Street 12<br>
                            1234 AB Your City<br>
                            The Netherlands
                        </p>
                    </div>
                </div>

                <div class="mb-4 d-flex">
                    <i class="material-icons text-warning me-3">phone</i>
                    <div>
                        <h6 class="fw-bold mb-1">Phone</h6>
                        <a href="tel:+31123456789" class="text-secondary text-decoration-none">
                            +31 12 345 6789
                        </a>
                    </div>
                </div>

                <div class="mb-4 d-flex">
                    <i class="material-icons text-warning me-3">email</i>
                    <div>
                        <h6 class="fw-bold mb-1">Email</h6>
                        <a href="mailto:info@iterrific.nl" class="text-secondary text-decoration-none">
                            info@iterrific.nl
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">Send us a message</h4>
                        @if(session('success'))
                            <div class="alert alert-success mb-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger mb-3">
                                {{ $errors->first() }}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf

                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control bg-white border border-secondary"
                                        placeholder=" Your name"
                                        required
                                    >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control bg-white border border-secondary"
                                    placeholder=" your@email.com"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input
                                type="text"
                                name="subject"
                                class="form-control bg-white border border-secondary"
                                placeholder=" Subject"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea
                                name="message"
                                class="form-control bg-white border border-secondary"
                                rows="5"
                                placeholder=" Your message"
                                required
                            ></textarea>
                        </div>

                        <!-- CAPTCHA placeholder -->
                        <div class="mb-4">
                            <div
                                class="cf-turnstile"
                                data-sitekey="{{ config('services.turnstile.site_key') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            Send Message
                        </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =======================
 Google Map
======================== -->
<section class="py-0">
    <div class="container-fluid px-0">
        <iframe
            src="https://www.google.com/maps?q=Amsterdam&output=embed"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
</section>

@endsection
