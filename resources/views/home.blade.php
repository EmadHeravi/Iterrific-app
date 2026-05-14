@extends('layouts.public')

@section('content')
<section class="p-0">
    <div id="homeCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">
            @php
        $slides = [
            [
                'image' => 'bg1.jpg',
                'title' => 'Infrastructure & Networking',
                'text'  => 'Design, deployment and maintenance of reliable IT infrastructure and networking environments.',
                'link'  => '/services#infrastructure',
            ],
            [
                'image' => 'bg2.jpg',
                'title' => 'Cloud & Virtualization',
                'text'  => 'Scalable cloud and virtualization solutions built for performance, flexibility and reliability.',
                'link'  => '/services#cloud',
            ],
            [
                'image' => 'bg3.jpg',
                'title' => 'Media & Broadcast',
                'text'  => 'Specialized solutions for broadcast, streaming and media production workflows.',
                'link'  => '/services#media',
            ],
            [
                'image' => 'bg4.jpg',
                'title' => 'Monitoring & Support',
                'text'  => 'Proactive monitoring, incident response and operational support for critical systems.',
                'link'  => '/services#support',
            ],
            [
                'image' => 'bg5.jpg',
                'title' => 'Software Development',
                'text'  => 'Custom software development and tailored solutions built around your operational needs.',
                'link'  => '/services#software',
            ],
            [
                'image' => 'bg6.jpg',
                'title' => 'Consulting & Architecture',
                'text'  => 'Strategic IT consulting and architecture services designed for scalable and future-proof environments.',
                'link'  => '/services#consultancy',
            ],
            [
                'image' => 'bg7.jpg',
                'title' => 'Recruitment As A Service',
                'text'  => 'Connecting organizations with skilled IT professionals and specialized technical talent.',
                'link'  => '/services#recruitment',
            ],
        ];
        @endphp

            @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                    style="
                        background-image: url('{{ asset('assets/img/Slide/' . $slide['image']) }}');
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

                                <a href="{{ $slide['link'] }}"
                                class="btn btn-warning btn-lg mt-3">
                                    Explore Services
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
<section class="py-6 bg-white">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">emoji_events</i>
                </div>
                <h5 class="fw-bold">Experienced Team</h5>
                <p class="text-secondary">
                    A skilled team delivering reliable IT solutions across multiple industries, backed by more than 15 years of experience.
                </p>
            </div>

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">hub</i>
                </div>
                <h5 class="fw-bold">Mastery in IT</h5>
                <p class="text-secondary">
                    Expertise in infrastructure, cloud, virtualization, media platforms, software development and mission-critical IT environments.
                </p>
            </div>

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">lightbulb</i>
                </div>
                <h5 class="fw-bold">Advice to Realization</h5>
                <p class="text-secondary">
                    From consultancy and architecture to implementation, integration and long-term operational support, we guide projects from initial concept to successful realization.
                </p>
            </div>

            <div class="col-md-3 mb-5">
                <div class="icon icon-shape bg-gradient-warning shadow text-center mb-3 mx-auto">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <h5 class="fw-bold">Collaboration</h5>
                <p class="text-secondary">
                    Close cooperation with clients and technology partners to build reliable, scalable and future-ready IT environments.
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
                    src="{{ asset('assets/img/ITerrific/ITerrific7.png') }}"
                    alt="Who We Are"
                    class="img-fluid rounded shadow"
                >
            </div>

            <!-- Text block -->
            <div class="col-lg-6">
                <h2 class="fw-bold text-dark">Who We Are</h2>
                <p class="text-secondary mt-3">
                    At ITerrific, we combine more than 15 years of hands-on experience with deep technical knowledge to deliver reliable, 
                    scalable and high-quality IT solutions. We support organizations across multiple industries with services ranging 
                    from infrastructure and cloud platforms to media workflows, software development, enterprise architecture and 
                    operational support.
                </p>

                <p class="text-secondary">
                    Over the years, we have helped customers around the world solve complex technical challenges by combining practical 
                    expertise with a strong focus on quality, continuity and long-term collaboration. Our approach is built around 
                    understanding business needs, delivering tailored solutions and maintaining the highest standards in every project 
                    we undertake.
                </p>
            </div>

        </div>
    </div>
</section>
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Approach</h2>
            <p class="text-secondary mt-2">
                Delivering reliable IT solutions through a structured and proven approach.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Consultancy & Discovery</h6>
                        <p class="text-secondary small mb-0">
                            Understanding business requirements and technical challenges.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Architecture & Design</h6>
                        <p class="text-secondary small mb-0">
                            Designing scalable, reliable and future-ready solutions.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Implementation & Integration</h6>
                        <p class="text-secondary small mb-0">
                            Deploying and integrating solutions into existing environments.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold">Monitoring & Support</h6>
                        <p class="text-secondary small mb-0">
                            Ensuring continuity, performance and operational stability.
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
                         alt="Client 9">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/in2itions.png') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 10">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/SES.svg') }}"
                         class="img-fluid opacity-7"
                         style="height: 140px; object-fit: contain;"
                         alt="Client 11">
                </div>

                <div class="col-6 col-md-3">
                    <img src="{{ asset('assets/img/clients/ilionx.jpg') }}"
                         class="img-fluid opacity-7"
                         alt="Client 12">
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
