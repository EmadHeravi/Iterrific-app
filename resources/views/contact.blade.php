@extends('layouts.public')

@section('content')

<!-- =======================
 Contact Hero
======================== -->
<section class="p-0">
    <div id="homeCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">
        @php
        $slides = [
            [
                'image' => 'contact1.png',
                'title' => 'Let’s Talk About Your Challenges',
                'text'  => 'Whether you are planning a new project, modernizing existing environments or looking for reliable operational support, we are ready to help.',
            ],
            [
                'image' => 'contact2.png',
                'title' => 'Technology Conversations That Matter',
                'text'  => 'We believe successful projects start with understanding business goals, technical requirements and long-term operational needs.',
            ],
            [
                'image' => 'contact3.png',
                'title' => 'From Strategy to Implementation',
                'text'  => 'From consultancy and architecture to implementation and support, ITerrific helps organizations translate ideas into reliable solutions.',
            ],
            [
                'image' => 'contact4.png',
                'title' => 'Building Long-Term Partnerships',
                'text'  => 'We work closely with organizations across industries by combining technical expertise, transparency and a strong commitment to quality.',
            ],
        ];
        @endphp

        @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                    style="
                        background-image: url('{{ asset('assets/img/contact/' . $slide['image']) }}');
                        background-size: cover;
                        background-position: center;
                    ">

                    <span class="mask bg-gradient-dark opacity-7"></span>

                    <div class="container position-relative">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center text-white">

                                <h1 class="display-4 fw-bold text-white">
                                    {{ $slide['title'] }}
                                </h1>

                                <p class="lead mt-3 text-white opacity-8">
                                    {{ $slide['text'] }}
                                </p>

                                <a href="/contact"
                                class="btn btn-warning btn-lg mt-3">
                                    Start a Conversation
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

         <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
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
                            Het lemoen 92<br>
                            6846KE Arnhem<br>
                            The Netherlands
                        </p>
                    </div>
                </div>

                <div class="mb-4 d-flex">
                    <i class="material-icons text-warning me-3">phone</i>
                    <div>
                        <h6 class="fw-bold mb-1">Phone</h6>
                        <a href="tel:+31123456789" class="text-secondary text-decoration-none">
                            +31 850 70 8580 
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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2458.7318940349364!2d5.833906877353381!3d51.957080371919055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7a9f8f7656f49%3A0x431273ac628bf7b5!2sITerrific%20B.V.!5e0!3m2!1sen!2snl!4v1778754625817!5m2!1sen!2snl"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
</section>

@endsection
