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

<!-- =======================
 Services Overview Cards
======================== -->
<section class="py-6 bg-white">
    <div class="container">
        <div class="row g-4">

            @php
                $services = [
                    [
                        'id'=>'infrastructure',
                        'icon'=>'hub',
                        'title'=>'Infrastructure & Networking',
                        'text'=>'Secure, scalable and high-performance infrastructure solutions for modern IT environments.'
                    ],

                    [
                        'id'=>'cloud',
                        'icon'=>'cloud',
                        'title'=>'Cloud & Virtualization',
                        'text'=>'Flexible cloud and virtualization platforms designed for reliability, efficiency and growth.'
                    ],

                    [
                        'id'=>'media',
                        'icon'=>'live_tv',
                        'title'=>'Media & Broadcast',
                        'text'=>'Advanced OTT, streaming and broadcast solutions for modern media workflows.'
                    ],

                    [
                        'id'=>'support',
                        'icon'=>'support_agent',
                        'title'=>'Monitoring & Support',
                        'text'=>'24/7 monitoring and operational support for business-critical systems and services.'
                    ],

                    [
                        'id'=>'software',
                        'icon'=>'code',
                        'title'=>'Software & Development',
                        'text'=>'Custom software and SaaS solutions tailored to operational and business requirements.'
                    ],

                    [
                        'id'=>'consultancy',
                        'icon'=>'architecture',
                        'title'=>'IT Consultancy & Architecture',
                        'text'=>'Strategic consulting and enterprise architecture aligned with long-term business objectives.'
                    ],

                    [
                        'id'=>'recruitment',
                        'icon'=>'groups',
                        'title'=>'Recruitment as a Service',
                        'text'=>'Connecting organizations with skilled IT professionals and specialized technical expertise.'
                    ],
                ];
            @endphp

            @foreach($services as $service)
                <!-- <div class="col-12 col-sm-6 col-lg-4"> -->
                <div class="col-12 col-sm-6 col-lg-4 {{ count($services) % 3 == 1 && $loop->last ? 'mx-auto' : '' }}">
                    <a href="#{{ $service['id'] }}" class="text-decoration-none text-dark d-block h-100">
                        <div class="card h-100 shadow-sm text-center p-4">
                            <i class="material-icons text-warning mb-3" style="font-size:48px;">
                                {{ $service['icon'] }}
                            </i>
                            <h5 class="fw-bold">{{ $service['title'] }}</h5>
                            <p class="text-secondary">{{ $service['text'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- =======================
 Service Details
======================== -->

<!-- Infrastructure (image LEFT → darker bg) -->
<section id="infrastructure" class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Infrastructure & Networking</h3>
                <p class="text-secondary mt-3">
                    We design, implement and maintain secure, scalable and high-performance IT infrastructures for environments where
                     reliability and continuity are essential.
                </p>

                <p class="text-secondary">
                    From enterprise networking and virtualization to storage, redundancy and datacenter solutions, we build future-ready 
                    platforms aligned with long-term business objectives.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Cloud (image RIGHT → lighter bg) -->
<section id="cloud" class="py-6 bg-white">
    <div class="container">
        <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg2.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Cloud & Virtualization</h3>
                <p class="text-secondary mt-3">
                    Flexible cloud and virtualization platforms designed to improve scalability, efficiency and operational continuity 
                    across modern IT environments.
                </p>

                <p class="text-secondary">
                    We help organizations design, migrate, optimize and manage hybrid, private and public cloud infrastructures tailored 
                    to their operational needs.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Media (image LEFT → darker bg) -->
<section id="media" class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg3.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Media & Broadcast</h3>
                <p class="text-secondary mt-3">
                    Specialized solutions for broadcast, OTT and streaming environments where performance, reliability and uptime are 
                    business-critical.
                </p>

                <p class="text-secondary">
                    From playout and media processing to distribution and delivery platforms, we support modern media workflows 
                    end-to-end.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Support (image RIGHT → lighter bg) -->
<section id="support" class="py-6 bg-white">
    <div class="container">
        <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg4.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Monitoring & Support</h3>
                <p class="text-secondary mt-3">
                    Proactive monitoring and operational support designed to ensure stability, visibility and continuity across critical 
                    IT environments.
                </p>

                <p class="text-secondary">
                    Our support services focus on rapid response, issue prevention and long-term operational reliability for 
                    business-critical systems.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Software (image LEFT → darker bg) -->
<section id="software" class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg5.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Software & Development</h3>
                <p class="text-secondary mt-3">
                    Custom software solutions and platform development tailored to business processes, operational workflows and
                     technical requirements.
                </p>

                <p class="text-secondary">
                    From internal business applications to scalable SaaS platforms, we develop reliable and maintainable software
                     built for long-term growth.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Consultancy (image RIGHT → lighter bg) -->
<section id="consultancy" class="py-6 bg-white">
    <div class="container">
        <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg6.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">IT Consultancy & Architecture</h3>
                <p class="text-secondary mt-3">
                    Strategic IT consultancy and enterprise architecture services focused on scalability, modernization and long-term 
                    technology alignment.
                </p>

                <p class="text-secondary">
                    We help organizations transform complex IT landscapes into structured, reliable and future-ready environments 
                    aligned with business goals.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Recruitment (image LEFT → darker bg) -->
<section id="recruitment" class="py-6 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/Slide/bg7.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Recruitment as a Service</h3>
                <p class="text-secondary mt-3">
                    Technical recruitment services focused on connecting organizations with experienced IT professionals and 
                    specialized technical expertise.
                </p>

                <p class="text-secondary">
                    Combining recruitment with real-world IT knowledge allows us to better understand technical requirements, 
                    team dynamics and long-term project success.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- =======================
 Call To Action
======================== -->
<section class="py-6 bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">

                <h2 class="fw-bold text-white">
                    Ready to discuss your IT challenges?
                </h2>

                <p class="text-white opacity-8 mt-3">
                    Whether you need strategy, implementation or ongoing support,
                    our team is ready to help.
                </p>

                <div class="mt-4">
                    <a href="/contact" class="btn btn-warning btn-lg me-2">
                        Get in Touch
                    </a>
                    <a href="/about" class="btn btn-outline-light btn-lg">
                        Who We Are
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
