@extends('layouts.public')

@section('content')

<!-- =======================
 Services Hero
======================== -->
<section class="page-header min-vh-50 d-flex align-items-center"
    style="background-image:url('{{ asset('assets/img/Slide/bg2.jpg') }}');
           background-size:cover;
           background-position:center;">

    <span class="mask bg-gradient-dark opacity-6"></span>

    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="fw-bold text-white">Our Services</h1>
                <p class="lead text-white opacity-8 mt-3">
                    Professional IT services tailored to your organization —
                    from strategy and architecture to implementation and support.
                </p>
            </div>
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
                    ['id'=>'infrastructure','icon'=>'hub','title'=>'Infrastructure & Networking','text'=>'Stable, secure and scalable IT infrastructure solutions.'],
                    ['id'=>'cloud','icon'=>'cloud','title'=>'Cloud & Virtualization','text'=>'Hybrid, on-prem and cloud platforms for modern workloads.'],
                    ['id'=>'media','icon'=>'live_tv','title'=>'Media & Broadcast','text'=>'IT solutions for broadcast, production and streaming.'],
                    ['id'=>'support','icon'=>'support_agent','title'=>'Monitoring & Support','text'=>'Proactive monitoring and operational IT support.'],
                    ['id'=>'software','icon'=>'code','title'=>'Software & Development','text'=>'Tailor-made software and SaaS solutions.'],
                    ['id'=>'consultancy','icon'=>'architecture','title'=>'IT Consultancy & Architecture','text'=>'From as-is analysis to future-proof IT architecture.'],
                    ['id'=>'recruitment','icon'=>'groups','title'=>'Recruitment as a Service','text'=>'Finding the right IT experts for your organization.'],
                ];
            @endphp

            @foreach($services as $service)
                <div class="col-12 col-sm-6 col-lg-4">
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
                    We design, implement and maintain secure and scalable IT infrastructures
                    for mission-critical environments.
                </p>
                <p class="text-secondary">
                    From networking and servers to storage and redundancy,
                    we ensure long-term reliability aligned with your business goals.
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
                    Hybrid, on-prem and cloud platforms designed for performance,
                    scalability and security.
                </p>
                <p class="text-secondary">
                    We help organizations migrate, optimize and operate cloud
                    environments that truly add value.
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
                    Specialized IT solutions for broadcast, production and streaming
                    environments where uptime is critical.
                </p>
                <p class="text-secondary">
                    From studio infrastructure to content delivery,
                    we support media workflows end-to-end.
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
                <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Monitoring & Support</h3>
                <p class="text-secondary mt-3">
                    Proactive monitoring and fast response when it matters most.
                </p>
                <p class="text-secondary">
                    Ensuring continuity, visibility and peace of mind
                    for your IT operations.
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
                <img src="{{ asset('assets/img/Slide/bg2.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Software & Development</h3>
                <p class="text-secondary mt-3">
                    Tailor-made software and SaaS solutions aligned
                    with your business processes.
                </p>
                <p class="text-secondary">
                    From concept to production,
                    we deliver robust and scalable applications.
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
                <img src="{{ asset('assets/img/Slide/bg3.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">IT Consultancy & Architecture</h3>
                <p class="text-secondary mt-3">
                    From as-is analysis to future-proof IT architecture
                    aligned with your company vision.
                </p>
                <p class="text-secondary">
                    We help organizations modernize and build
                    reliable long-term IT foundations.
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
                <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="fw-bold">Recruitment as a Service</h3>
                <p class="text-secondary mt-3">
                    Finding the right IT experts who match
                    both technical requirements and company culture.
                </p>
                <p class="text-secondary">
                    Technical recruitment driven by real-world IT expertise.
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
