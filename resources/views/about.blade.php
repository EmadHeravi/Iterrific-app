@extends('layouts.public')

@section('content')

<!-- Hero -->
 <section class="p-0">
    <div id="homeCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="5000">

        <div class="carousel-inner">
            @php
        $slides = [
            [
                'image' => 'trust.png',
                'title' => 'Trusted Through Long-Term Partnerships',
                'text'  => 'We believe trust is built through consistency, transparency and delivering results. Our long-term 
                relationships with clients and partners are based on reliability, technical expertise and a commitment to quality 
                in every project we undertake.',
                'link'  => '/services#infrastructure',
            ],
            [
                'image' => 'exprience2.png',
                'title' => 'More Than 15 Years of Hands-On Experience',
                'text'  => 'With more than 15 years of experience across multiple industries, we have supported organizations worldwide 
                in solving complex IT and media challenges through practical expertise and proven solutions.',
                'link'  => '/services#cloud',
            ],
            [
                'image' => 'technology.png',
                'title' => 'Technology Driven. Business Focused.',
                'text'  => 'ITerrific combines deep technical knowledge with a strong understanding of business operations. Our goal is to 
                deliver solutions that are not only technically strong, but also aligned with long-term business objectives.',
                'link'  => '/services#media',
            ],
            [
                'image' => 'quality1.png',
                'title' => 'Built Around Quality and Continuity',
                'text'  => 'Our philosophy is centered around building reliable, scalable and maintainable environments that create 
                long-term value. We focus on sustainable solutions rather than short-term fixes.',
                'link'  => '/services#support',
            ],
            [
                'image' => 'standards.png',
                'title' => 'Committed to High Standards',
                'text'  => 'Quality is embedded in every stage of our work — from consultancy and architecture to implementation and operational support. We maintain high standards to ensure stability, performance and customer satisfaction.',
                'link'  => '/services#software',
            ],
        ];
        @endphp

            @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="page-header min-vh-75 d-flex align-items-center w-100"
                    style="
                        background-image: url('{{ asset('assets/img/about/' . $slide['image']) }}');
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
                                    Get in Touch
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

<!-- Mission & Vision -->
<section class="py-6 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Mission & Vision</h2>
            <p class="text-secondary mt-2">
                Building reliable technology foundations for long-term success.
            </p>
        </div>

        <div class="row g-4">

            <!-- Mission -->
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5">

                    <div class="mb-4">
                        <div class="icon icon-shape bg-gradient-warning shadow text-center">
                            <i class="material-icons opacity-10">track_changes</i>
                        </div>
                    </div>

                    <h3 class="fw-bold">
                        Our Mission
                    </h3>

                    <p class="text-secondary mt-3">
                        Our mission is to design and deliver reliable, scalable and future-ready IT solutions that help organizations operate efficiently, securely and without interruption.
                    </p>

                    <p class="text-secondary">
                        By combining deep technical expertise with practical business understanding, we build technology environments that create long-term value and support sustainable growth.
                    </p>

                </div>
            </div>

            <!-- Vision -->
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5">

                    <div class="mb-4">
                        <div class="icon icon-shape bg-gradient-warning shadow text-center">
                            <i class="material-icons opacity-10">visibility</i>
                        </div>
                    </div>

                    <h3 class="fw-bold">
                        Our Vision
                    </h3>

                    <p class="text-secondary mt-3">
                        We envision a future where technology empowers organizations through stability, innovation and seamless digital transformation.
                    </p>

                    <p class="text-secondary">
                        ITerrific strives to be a trusted long-term technology partner for organizations worldwide by maintaining the highest standards in quality, continuity and technical excellence.
                    </p>

                </div>
            </div>

        </div>

    </div>
</section>

<!-- Our Story -->
<section class="py-6 bg-white">
    <div class="container">

        <div class="row align-items-center">

            <!-- Left -->
            <div class="col-lg-6 mb-5 mb-lg-0">

                <span class="text-warning fw-bold text-uppercase small">
                    Our Journey
                </span>

                <h2 class="fw-bold mt-2">
                    More Than Technology
                </h2>

                <p class="text-secondary mt-4">
                    ITerrific was founded with a clear vision: helping organizations build reliable, scalable and future-ready technology environments that truly support business operations.
                </p>

                <p class="text-secondary">
                    Over the years, we have supported customers across multiple industries by combining deep technical expertise with practical business understanding. From infrastructure and cloud platforms to media workflows and enterprise architecture, our focus has always remained the same — delivering quality without compromise.
                </p>

                <p class="text-secondary">
                    Today, we continue to grow through long-term partnerships, technical excellence and a strong commitment to continuity, reliability and innovation.
                </p>

            </div>

            <!-- Right -->
            <div class="col-lg-6">

                <div class="row g-4">

                    <div class="col-6">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <h2 class="fw-bold text-warning">15+</h2>
                            <p class="text-secondary mb-0">
                                Years of Experience
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <h2 class="fw-bold text-warning">Global</h2>
                            <p class="text-secondary mb-0">
                                Customer Projects
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <h2 class="fw-bold text-warning">Multi</h2>
                            <p class="text-secondary mb-0">
                                Industry Expertise
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <h2 class="fw-bold text-warning">Long-Term</h2>
                            <p class="text-secondary mb-0">
                                Partnerships
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- Company Values -->
<!-- Theme 1 
<section class="py-6 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">What We Stand For</h2>

            <p class="text-secondary mt-2">
                The principles that shape our approach, partnerships and long-term vision.
            </p>
        </div>

        <div class="row g-4">

            
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">

                    <div class="icon icon-shape bg-gradient-warning shadow mx-auto mb-4">
                        <i class="material-icons opacity-10">handshake</i>
                    </div>

                    <h5 class="fw-bold">
                        Partnership
                    </h5>

                    <p class="text-secondary mb-0">
                        Building long-term relationships based on trust, collaboration and shared success.
                    </p>

                </div>
            </div>

            
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">

                    <div class="icon icon-shape bg-gradient-warning shadow mx-auto mb-4">
                        <i class="material-icons opacity-10">insights</i>
                    </div>

                    <h5 class="fw-bold">
                        Expertise
                    </h5>

                    <p class="text-secondary mb-0">
                        Combining deep technical knowledge with practical real-world experience.
                    </p>

                </div>
            </div>

            
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">

                    <div class="icon icon-shape bg-gradient-warning shadow mx-auto mb-4">
                        <i class="material-icons opacity-10">security</i>
                    </div>

                    <h5 class="fw-bold">
                        Reliability
                    </h5>

                    <p class="text-secondary mb-0">
                        Delivering stable, scalable and dependable environments built for continuity.
                    </p>

                </div>
            </div>

            
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">

                    <div class="icon icon-shape bg-gradient-warning shadow mx-auto mb-4">
                        <i class="material-icons opacity-10">lightbulb</i>
                    </div>

                    <h5 class="fw-bold">
                        Innovation
                    </h5>

                    <p class="text-secondary mb-0">
                        Designing future-ready solutions that evolve with technology and business needs.
                    </p>

                </div>
            </div>

        </div>

    </div>
</section> -->
<!-- Theme 2 -->

<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What We Stand For</h2>

            <p class="text-secondary mt-2">
                The principles that shape our approach, partnerships and long-term vision.
            </p>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">handshake</i>
                <h5 class="fw-bold">Partnership</h5>
                <p class="text-secondary">Building long-term relationships based on trust, collaboration and shared success.</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">insights</i>
                <h5 class="fw-bold">Expertise</h5>
                <p class="text-secondary">Combining deep technical knowledge with practical real-world experience.</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">security</i>
                <h5 class="fw-bold">Reliability</h5>
                <p class="text-secondary">Delivering stable, scalable and dependable environments built for continuity.</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center">
                <i class="material-icons text-warning mb-2" style="font-size:40px;">lightbulb</i>
                <h5 class="fw-bold">Innovation</h5>
                <p class="text-secondary">Designing future-ready solutions that evolve with technology and business needs.</p>
            </div>
        </div>
    </div>
</section>
<!-- =======================
 Proud of Our Journey
======================== -->
<section class="py-7 bg-white text-dark">
    <div class="container">

        <!-- Section title -->
        <div class="row mb-6">
            <div class="col-lg-8 mx-auto text-center">

                <span class="text-warning fw-bold text-uppercase small">
                    Our Journey
                </span>

                <h2 class="fw-bold mt-2">
                    Built Through Experience, Challenges and Growth
                </h2>

                <p class="text-secondary mt-3">
                    From humble beginnings to international projects, our story is built around passion for technology, continuous learning and long-term partnerships.
                </p>

            </div>
        </div>

        <!-- Timeline -->
        <div class="row">
            <div class="col-lg-11 mx-auto">

                <!-- The Early Years -->
                <div class="row position-relative mb-7">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">

                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                                  style="width:50px;height:50px;">

                                <i class="material-icons text-dark">
                                    engineering
                                </i>

                            </span>

                            <div class="flex-grow-1 border-start border-2 border-warning mt-3"></div>

                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/about/early-years.png') }}"
                             class="img-fluid rounded-4 shadow"
                             alt="The Early Years">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            The Early Years
                        </span>

                        <h3 class="fw-bold mt-2">
                            Where It All Started
                        </h3>

                        <p class="text-secondary mt-4">
                            Long before ITerrific officially existed, the journey started in 2010 from a small garage workspace while working full-time as an engineer. What began as freelance support for small businesses quickly evolved into solving increasingly complex infrastructure and media-related technical challenges.
                        </p>

                        <p class="text-secondary">
                            From the beginning, the focus was never simply about technology itself — it was about building dependable solutions that businesses could truly rely on.
                        </p>

                    </div>

                </div>

                <!-- Expanding Horizons -->
                <div class="row position-relative mb-7">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">

                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                                  style="width:50px;height:50px;">

                                <i class="material-icons text-dark">
                                    public
                                </i>

                            </span>

                            <div class="flex-grow-1 border-start border-2 border-warning mt-3"></div>

                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/about/expanding-horizons.png') }}"
                             class="img-fluid rounded-4 shadow"
                             alt="Expanding Horizons">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            Expanding Horizons
                        </span>

                        <h3 class="fw-bold mt-2">
                            From Engineering to International Projects
                        </h3>

                        <p class="text-secondary mt-4">
                            In 2015, ITerrific officially became a company. As projects became larger and more complex, the company expanded beyond traditional infrastructure work into large-scale media, broadcast and enterprise environments across Europe.
                        </p>

                        <p class="text-secondary">
                            Operating from the Netherlands meant thinking internationally from the very beginning. This mindset opened opportunities to work across industries, technologies and cultures while continuously expanding technical and business expertise.
                        </p>

                    </div>

                </div>

                <!-- Beyond Engineering -->
                <div class="row position-relative mb-7">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">

                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                                  style="width:50px;height:50px;">

                                <i class="material-icons text-dark">
                                    analytics
                                </i>

                            </span>

                            <div class="flex-grow-1 border-start border-2 border-warning mt-3"></div>

                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/about/beyond-engineering.png') }}"
                             class="img-fluid rounded-4 shadow"
                             alt="Beyond Engineering">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            Beyond Engineering
                        </span>

                        <h3 class="fw-bold mt-2">
                            Bridging Technology and Business
                        </h3>

                        <p class="text-secondary mt-4">
                            Over time, ITerrific evolved beyond purely technical engineering. By deeply understanding how systems operated behind the scenes, we became capable of translating complex technical environments into meaningful business insights, KPIs and strategic improvements.
                        </p>

                        <p class="text-secondary">
                            This ability to bridge technical expertise with business understanding became one of the company’s strongest differentiators. We were no longer only building systems — we were helping organizations understand, optimize and grow through technology.
                        </p>

                    </div>

                </div>

                <!-- Today & Beyond -->
                <div class="row position-relative">

                    <!-- Timeline -->
                    <div class="col-1 d-flex justify-content-center">

                        <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center shadow"
                              style="width:50px;height:50px;">

                            <i class="material-icons text-dark">
                                auto_awesome
                            </i>

                        </span>

                    </div>

                    <!-- Image -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/about/today-beyond.png') }}"
                             class="img-fluid rounded-4 shadow"
                             alt="Today and Beyond">
                    </div>

                    <!-- Text -->
                    <div class="col-lg-7">

                        <span class="text-warning fw-bold text-uppercase small">
                            Today & Beyond
                        </span>

                        <h3 class="fw-bold mt-2">
                            Built on Knowledge, Trust and Resilience
                        </h3>

                        <p class="text-secondary mt-4">
                            Through changing markets, economic challenges, technological shifts and global events such as COVID, ITerrific continued to grow through resilience, adaptability and commitment to quality.
                        </p>

                        <p class="text-secondary">
                            While many larger companies disappeared during difficult periods, we continued moving forward by staying focused on knowledge, reliability and long-term relationships. Today, ITerrific remains driven by curiosity, innovation and the belief that there is always more to learn, improve and build.
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
