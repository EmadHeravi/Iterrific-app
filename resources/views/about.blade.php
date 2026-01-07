@extends('layouts.public')

@section('content')

<!-- Hero -->
<section class="page-header min-vh-50 d-flex align-items-center"
    style="background-image:url('{{ asset('assets/img/Slide/bg2.jpg') }}');
           background-size:cover;
           background-position:center;">

    <span class="mask bg-gradient-dark opacity-6"></span>

    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="fw-bold text-white">About ITerrific</h1>
                <p class="lead text-white opacity-8 mt-3">
                    We transform IT into sustainable solutions that drive business success.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Mission & Vision -->
<section class="py-6 bg-light text-center">
    <div class="container">
        <h2 class="fw-bold">Our Mission & Vision</h2>
        <p class="text-secondary mt-3">
            At ITerrific, our mission is to build reliable, scalable and future-ready IT
            systems paired with strong business insight. We help organizations align
            their technology landscape with strategic goals.
        </p>
        <p class="text-secondary">
            We envision a world where technology empowers people to do more — without
            interruptions, performance gaps or outdated infrastructure.
        </p>
    </div>
</section>

<!-- Our Story -->
<section class="py-6 bg-white">
    <div class="container">
        <h2 class="fw-bold text-center">Our Story</h2>
        <p class="text-secondary mt-3 text-center">
            ITerrific started with a simple but ambitious idea: provide dependable IT
            and media solutions that solve real business problems. Over the years,
            we’ve grown by partnering with clients who demand quality, innovation
            and trust. Today, we continue to build on that foundation with the same
            commitment and passion we started with.
        </p>

        <div class="row text-center mt-5">
            <div class="col-sm-6 col-lg-3 mb-4">
                <h3 class="fw-bold text-dark">250+</h3>
                <p class="text-secondary">Projects Delivered</p>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <h3 class="fw-bold text-dark">99%+</h3>
                <p class="text-secondary">Client Satisfaction</p>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <h3 class="fw-bold text-dark">0 Downtime</h3>
                <p class="text-secondary">Mission-Critical Environments</p>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <h3 class="fw-bold text-dark">50+</h3>
                <p class="text-secondary">Expert Engineers</p>
            </div>
        </div>
    </div>
</section>

<!-- Company Values -->
<section class="py-6 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center">What We Stand For</h2>

        <div class="row g-4 mt-4">
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">handshake</i>
                <h5 class="fw-bold">Partnership</h5>
                <p class="text-secondary">We succeed together with our clients.</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">insights</i>
                <h5 class="fw-bold">Expertise</h5>
                <p class="text-secondary">We deliver deep technical insight and quality.</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">security</i>
                <h5 class="fw-bold">Reliability</h5>
                <p class="text-secondary">Built for uptime, stability and long life spans.</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">lightbulb</i>
                <h5 class="fw-bold">Innovation</h5>
                <p class="text-secondary">We design future-ready solutions every day.</p>
            </div>
        </div>
    </div>
</section>
<!-- =======================
 Proud of Our Story
======================== -->
<section class="py-6 bg-white text-dark">
    <div class="container">

        <!-- Section title -->
        <div class="row mb-6">
            <div class="col text-center">
                <h2 class="fw-bold text-uppercase">Proud of Our Story</h2>
            </div>
        </div>

        <!-- Timeline wrapper -->
        <div class="row">
            <div class="col-lg-10 mx-auto">

                <!-- Timeline item -->
                <div class="row position-relative mb-6">
                    <!-- Line + dot -->
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                  style="width:40px;height:40px;">
                                <i class="material-icons text-dark">flag</i>
                            </span>
                            <div class="flex-grow-1 border-start border-warning mt-2"></div>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Founded">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">
                        <h4 class="fw-bold">2015 — The Beginning</h4>
                        <p class="text-secondary mt-3 ">
                            ITerrific started with a clear vision: build reliable, human-centric
                            IT solutions that truly support businesses.
                        </p>
                        <p class="text-secondary mt-3">
                            From day one, trust, craftsmanship and long-term thinking
                            were the foundation of our work.
                        </p>
                    </div>
                </div>

                <!-- Timeline item -->
                <div class="row position-relative mb-6">
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                  style="width:40px;height:40px;">
                                <i class="material-icons text-dark">business</i>
                            </span>
                            <div class="flex-grow-1 border-start border-warning mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg2.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Growth">
                    </div>

                    <div class="col-lg-7">
                        <h4 class="fw-bold">2018 — Growing Together</h4>
                        <p class="text-secondary mt-3">
                            As our client base expanded, so did our expertise.
                            Infrastructure, cloud, media and software became
                            core pillars of our services.
                        </p>
                        <p class="text-secondary mt-3">
                            Growth was never about size — but about quality
                            and long-term partnerships.
                        </p>
                    </div>
                </div>

                <!-- Timeline item -->
                <div class="row position-relative mb-6">
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                  style="width:40px;height:40px;">
                                <i class="material-icons text-dark">rocket_launch</i>
                            </span>
                            <div class="flex-grow-1 border-start border-warning mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg3.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Expansion">
                    </div>

                    <div class="col-lg-7">
                        <h4 class="fw-bold">2021 — Expanding Horizons</h4>
                        <p class="text-secondary mt-3">
                            We expanded into consultancy, architecture and
                            recruitment-as-a-service to support organizations
                            end-to-end.
                        </p>
                        <p class="text-secondary mt-3">
                            From as-is analysis to future-proof IT strategies —
                            we became a true technology partner.
                        </p>
                    </div>
                </div>

                <!-- Timeline item (last, no line) -->
                <div class="row position-relative">
                    <div class="col-1 d-flex justify-content-center">
                        <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                              style="width:40px;height:40px;">
                            <i class="material-icons text-dark">emoji_events</i>
                        </span>
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Future">
                    </div>

                    <div class="col-lg-7">
                        <h4 class="fw-bold">Today — Looking Forward</h4>
                        <p class="text-secondary mt-3">
                            Today, ITerrific continues to focus on
                            innovation, reliability and people.
                        </p>
                        <p class="text-secondary mt-3">
                            Proud of our story — and even more excited
                            about what comes next.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>


<!-- CTA -->
<section class="py-6 bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">
            <h2 class="fw-bold text-white">Looking for a dependable IT partner?</h2>
            <p class="text-white opacity-8 mt-3">Let’s build something great together.</p>
            <div class="mt-4">
            <a href="/contact" class="btn btn-warning btn-lg">Get in Touch</a>
            <a href="/services" class="btn btn-outline-light btn-lg">Explore Our Services</a>
            </div>
        </div>
        </div>
    </div>
</section>

@endsection
