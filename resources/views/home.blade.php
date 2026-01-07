@extends('layouts.public')

@section('content')
<section class="p-0">
    <div id="homeCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                     style="
                        background-image: url('{{ asset('assets/img/Slide/bg1.jpg') }}');
                        background-size: cover;
                        background-position: center;
                     ">
                    <span class="mask bg-gradient-dark opacity-7"></span>

                    <div class="container position-relative">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center text-white">
                                <h1 class="display-4 fw-bold text-white">
                                    Reliable IT & Media Solutions
                                </h1>

                                <p class="lead mt-3 text-white opacity-8">
                                    Professional system integration and operational support
                                    for mission-critical environments.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                     style="
                        background-image: url('{{ asset('assets/img/Slide/bg2.jpg') }}');
                        background-size: cover;
                        background-position: center;
                     ">
                    <span class="mask bg-gradient-dark opacity-7"></span>

                    <div class="container position-relative">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center text-white">
                                <h1 class="display-4 fw-bold text-white">
                                    Media & Broadcast Expertise
                                </h1>

                                <p class="lead mt-3 text-white opacity-8">
                                    Specialized solutions for media, broadcast, and streaming workflows.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                     style="
                        background-image: url('{{ asset('assets/img/Slide/bg3.jpg') }}');
                        background-size: cover;
                        background-position: center;
                     ">
                    <span class="mask bg-gradient-dark opacity-7"></span>

                    <div class="container position-relative">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center text-white">
                                <h1 class="display-4 fw-bold text-white">
                                    Monitoring & Support
                                </h1>

                                <p class="lead mt-3 text-white opacity-8">
                                    Proactive monitoring and fast response when it matters most.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="py-6 bg-white">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">emoji_events</i>
                </div>
                <h5 class="fw-bold">Experienced Team</h5>
                <p class="text-secondary">
                    A skilled team delivering reliable IT solutions across multiple industries.
                </p>
            </div>

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">hub</i>
                </div>
                <h5 class="fw-bold">Mastery in IT</h5>
                <p class="text-secondary">
                    Expertise in infrastructure, cloud, media, and mission-critical systems.
                </p>
            </div>

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">lightbulb</i>
                </div>
                <h5 class="fw-bold">Advice to Realization</h5>
                <p class="text-secondary">
                    From consultancy and design to implementation and long-term support.
                </p>
            </div>

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <h5 class="fw-bold">Collaboration</h5>
                <p class="text-secondary">
                    Close cooperation with clients to build sustainable IT environments.
                </p>
            </div>

        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center">

            <!-- Image block -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img
                    src="{{ asset('assets/img/Slide/bg2.jpg') }}"
                    alt="Who We Are"
                    class="img-fluid rounded shadow"
                >
            </div>

            <!-- Text block -->
            <div class="col-lg-6">
                <h2 class="fw-bold text-dark">Who We Are</h2>
                <p class="text-secondary mt-3">
                    At ITerrific, we believe reliable technology infrastructure is the backbone
                    of modern business. Our team combines deep technical expertise with
                    real-world operational experience to deliver solutions that just work.
                </p>

                <p class="text-secondary">
                    From strategy and integration to support and optimization, we partner
                    closely with our clients to solve their toughest challenges with clarity
                    and confidence.
                </p>
            </div>

        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Expertise</h2>
            <p class="text-secondary mt-2">
                We support organizations with reliable, scalable and secure IT solutions.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Infrastructure & Networking</h6>
                        <p class="text-secondary small mb-0">
                            Design, implementation and maintenance of robust IT infrastructures.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Cloud & Virtualization</h6>
                        <p class="text-secondary small mb-0">
                            Hybrid and cloud environments built for performance and reliability.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Media & Broadcast</h6>
                        <p class="text-secondary small mb-0">
                            Specialized solutions for media production, broadcast and streaming.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Monitoring & Support</h6>
                        <p class="text-secondary small mb-0">
                            Proactive monitoring, incident response and operational support.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="py-6 bg-white">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Trusted by Our Clients & Partners</h2>
            <p class="text-secondary mt-2">
                We collaborate with organizations across multiple industries.
            </p>
        </div>

        <div class="row align-items-center justify-content-center text-center g-4">

            <div class="col-6 col-md-3">
                <img src="{{ asset('assets/img/clients/client-1.jpg') }}"
                     class="img-fluid opacity-7"
                     alt="Client 1">
            </div>

            <div class="col-6 col-md-3">
                <img src="{{ asset('assets/img/clients/client-2.jpg') }}"
                     class="img-fluid opacity-7"
                     alt="Client 2">
            </div>

            <div class="col-6 col-md-3">
                <img src="{{ asset('assets/img/clients/client-3.jpg') }}"
                     class="img-fluid opacity-7"
                     alt="Client 3">
            </div>

            <div class="col-6 col-md-3">
                <img src="{{ asset('assets/img/clients/client-4.jpg') }}"
                     class="img-fluid opacity-7"
                     alt="Client 4">
            </div>

        </div>

    </div>
</section>
<section class="py-6 bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">
                <h2 class="fw-bold text-white">
                    Ready to talk about your IT challenges?
                </h2>

                <p class="lead mt-3 text-white opacity-8">
                    Let’s discuss how ITerrific can support your organization
                    with reliable and scalable IT solutions.
                </p>

                <div class="mt-4">
                    <a href="/contact" class="btn btn-warning btn-lg">
                        Get in Touch
                    </a>
                    <a href="/services" class="btn btn-outline-light btn-lg">
                        Explore Our Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
