@extends('layouts.public')

@section('content')

<!-- References Hero -->
<section class="p-0">
    <div id="homeCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">
        @php
        $slides = [
            [
                'image' => 'references1.png',
                'title' => 'Built on Trust and Long-Term Collaboration',
                'text'  => 'Over the years, we have partnered with organizations across multiple industries by delivering reliable solutions, technical expertise and long-term operational support.',
            ],
            [
                'image' => 'references2.png',
                'title' => 'Supporting Mission-Critical Environments',
                'text'  => 'From enterprise infrastructure to media and broadcast operations, we help organizations maintain stable, scalable and high-performing technology environments.',
            ],
            [
                'image' => 'references3.png',
                'title' => 'International Experience Across Industries',
                'text'  => 'Working from the Netherlands with an international mindset, ITerrific supports customers across Europe and beyond with tailored IT and technology solutions.',
            ],
            [
                'image' => 'references4.png',
                'title' => 'Partnerships Built Around Quality',
                'text'  => 'Our clients value continuity, transparency and technical depth. We believe strong partnerships are created through consistency, trust and delivering results.',
            ],
        ];
        @endphp

        @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                    style="
                        background-image: url('{{ asset('assets/img/references/' . $slide['image']) }}');
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
<!-- Clients & Partners -->
<section class="py-6 bg-white">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Trusted by Our Clients & Partners</h2>
            <p class="text-secondary mt-2">
                We collaborate with organizations across multiple industries.
            </p>
        </div>

<div id="partnersCarousel" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="row align-items-center justify-content-center text-center g-4">

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/vodafoneziggo.jpg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 1">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/spe.jpg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 2">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/odmedia.jpg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 3">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/kpn.jpg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 4">
                </div>

            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="row align-items-center justify-content-center text-center g-4">

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/liberty-logo-orange.svg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 5">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/almashariq.png') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 6">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/nesma.png') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 7">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/hoogenberg.png') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 8">
                </div>

            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="row align-items-center justify-content-center text-center g-4">

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/Borg-OSC.png') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 5">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/in2itions.png') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 6">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/SES.svg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 7">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/ilionx.jpg') }}"
                         class="img-fluid opacity-7"
                         alt="Client 8">
                </div> 

            </div>
        </div>

    </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#partnersCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#partnersCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>

    </div>
</section>

<!-- =======================
 Collaboration Highlights
======================== -->
<section class="py-6 bg-light text-dark">
    <div class="container">

        <!-- Section title -->
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">

                <span class="text-warning fw-bold text-uppercase small">
                    References & Partnerships
                </span>

                <h2 class="fw-bold mt-2">
                    Collaboration Highlights
                </h2>

                <p class="text-secondary mt-3">
                    Real-world experience across infrastructure, media, enterprise environments and long-term operational support.
                </p>

            </div>
        </div>

        <!-- Timeline -->
        <div class="row">
            <div class="col-lg-11 mx-auto">

                <!-- Story item -->
                <div class="row position-relative mb-7">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">

                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                                  style="width:50px;height:50px;">

                                <i class="material-icons text-dark">
                                    business
                                </i>

                            </span>

                            <div class="flex-grow-1 border-start border-2 border-warning mt-3"></div>

                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                             class="img-fluid rounded-4 shadow-lg"
                             alt="Enterprise Infrastructure Project">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            Enterprise Infrastructure
                        </span>

                        <h3 class="fw-bold mt-2">
                            Designing Reliable Enterprise Environments
                        </h3>

                        <p class="text-secondary mt-4">
                            “From core infrastructure and virtualization platforms to networking and operational continuity, 
                            ITerrific has supported organizations in building stable and scalable enterprise environments designed for 
                            long-term reliability.
                            Our focus goes beyond implementation alone — we help organizations create infrastructure foundations
                             that support performance, resilience and future growth.”
                        </p>



                    </div>

                </div>

                <!-- Story item -->
                <div class="row position-relative mb-7">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">

                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                                  style="width:50px;height:50px;">

                                <i class="material-icons text-dark">
                                    cloud
                                </i>

                            </span>

                            <div class="flex-grow-1 border-start border-2 border-warning mt-3"></div>

                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg2.jpg') }}"
                             class="img-fluid rounded-4 shadow-lg"
                             alt="Cloud & Virtualization Journey">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            Cloud & Virtualization
                        </span>

                        <h3 class="fw-bold mt-2">
                            Modernizing Platforms and Operations
                        </h3>

                        <p class="text-secondary mt-4">
                            “ITerrific has supported organizations in modernizing complex environments through virtualization, cloud 
                            integration and operational optimization tailored to business and technical requirements.
                            By combining practical engineering experience with strategic insight, we help customers create flexible 
                            and future-ready technology platforms.”
                        </p>


                    </div>

                </div>

                <!-- Last item -->
                <div class="row position-relative">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">

                        <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                              style="width:50px;height:50px;">

                            <i class="material-icons text-dark">
                                handshake
                            </i>

                        </span>

                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg3.jpg') }}"
                             class="img-fluid rounded-4 shadow-lg"
                             alt="Long-Term Partnership">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            Long-Term Partnership
                        </span>

                        <h3 class="fw-bold mt-2">
                            Building Partnerships Around Trust and Expertise
                        </h3>

                        <p class="text-secondary mt-4">
                            “Many collaborations evolve into long-term partnerships built around trust, continuity and shared goals. 
                            By understanding both technical environments and business operations, ITerrific becomes more than a service 
                            provider — but a reliable technology partner.
                            This long-term approach allows us to continuously adapt, improve and support organizations as 
                            technologies and business needs evolve.”
                        </p>


                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

<section class="py-6 bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">
            <h2 class="fw-bold text-white">Ready to Build a Reliable Partnership?</h2>
            <p class="text-white opacity-8 mt-3">Whether you’re looking for a trusted IT partner or want to explore
                    collaboration opportunities, we’d love to talk.</p>
            <div class="mt-4">
            <a href="/contact" class="btn btn-warning btn-lg">Get in Touch</a>
            <a href="/services" class="btn btn-outline-light btn-lg">Explore Our Services</a>
            </div>
        </div>
        </div>
    </div>
</section>


@endsection
