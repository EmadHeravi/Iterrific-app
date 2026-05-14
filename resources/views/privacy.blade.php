@extends('layouts.public')

@section('content')

<!-- =======================
 Privacy Hero
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
            ],
            [
                'image' => 'bg4.jpg',
            ],
            [
                'image' => 'bg5.jpg',
            ],
            [
                'image' => 'bg6.jpg',
            ],
            [
                'image' => 'bg7.jpg',
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
                                    ITerrific B.V.
                                </h1>

                                <p class="lead mt-3 text-white opacity-8">
                                    Privacy Policy - Your Data, Our Commitment to Protection and Transparency
                                </p>


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
 Privacy Content
======================== -->
<section class="py-7 bg-light">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="card shadow-sm border-0">

                    <div class="card-body p-5">

                        <p class="text-secondary mb-5">
                            Last updated: {{ now()->format('F Y') }}
                        </p>

                        <!-- Introduction -->
                        <h3 class="fw-bold mb-3">
                            1. Introduction
                        </h3>

                        <p class="text-secondary">
                            ITerrific B.V., located in Arnhem, The Netherlands,
                            values your privacy and handles personal data with care.
                            This Privacy Policy explains how we collect, process,
                            use, store, and protect personal information when you
                            use our website, communicate with us, or engage our services.
                        </p>

                        <!-- Company Information -->
                        <h3 class="fw-bold mt-5 mb-3">
                            2. Company Information
                        </h3>

                        <p class="text-secondary mb-1">
                            <strong>Company:</strong> ITerrific B.V.
                        </p>

                        <p class="text-secondary mb-1">
                            <strong>Address:</strong> Het Lemoen 92, 6846KE Arnhem, The Netherlands
                        </p>

                        <p class="text-secondary mb-1">
                            <strong>Email:</strong>
                            <a href="mailto:info@iterrific.nl">
                                info@iterrific.nl
                            </a>
                        </p>

                        <p class="text-secondary">
                            <strong>Website:</strong>
                            <a href="https://iterrific.nl">
                                https://iterrific.nl
                            </a>
                        </p>

                        <!-- Data Collection -->
                        <h3 class="fw-bold mt-5 mb-3">
                            3. Personal Data We Collect
                        </h3>

                        <p class="text-secondary">
                            Depending on your interaction with our website or services,
                            we may collect:
                        </p>

                        <ul class="text-secondary">
                            <li>Name and contact details</li>
                            <li>Email address and telephone number</li>
                            <li>Company information</li>
                            <li>IP address and browser information</li>
                            <li>Communication history</li>
                            <li>Technical logs and security-related information</li>
                            <li>Website usage and analytics data</li>
                        </ul>

                        <!-- Legal Basis -->
                        <h3 class="fw-bold mt-5 mb-3">
                            4. Legal Basis for Processing
                        </h3>

                        <p class="text-secondary">
                            We process personal data under one or more of the following legal bases:
                        </p>

                        <ul class="text-secondary">
                            <li>Your consent</li>
                            <li>Performance of a contract</li>
                            <li>Compliance with legal obligations</li>
                            <li>Legitimate business interests</li>
                        </ul>

                        <!-- Data Usage -->
                        <h3 class="fw-bold mt-5 mb-3">
                            5. How We Use Personal Data
                        </h3>

                        <p class="text-secondary">
                            Personal information may be used for:
                        </p>

                        <ul class="text-secondary">
                            <li>Responding to inquiries and contact requests</li>
                            <li>Providing IT consultancy and technical services</li>
                            <li>Security monitoring and fraud prevention</li>
                            <li>Improving website performance and user experience</li>
                            <li>Business administration and communication</li>
                            <li>Compliance with legal obligations</li>
                        </ul>

                        <!-- Sharing -->
                        <h3 class="fw-bold mt-5 mb-3">
                            6. Data Sharing
                        </h3>

                        <p class="text-secondary">
                            ITerrific B.V. does not sell personal data.
                            Information may only be shared with trusted service providers,
                            infrastructure partners, or authorities when legally required.
                        </p>

                        <!-- Retention -->
                        <h3 class="fw-bold mt-5 mb-3">
                            7. Data Retention
                        </h3>

                        <p class="text-secondary">
                            Personal data is retained only as long as necessary
                            for operational, contractual, legal, or security purposes.
                        </p>

                        <!-- Security -->
                        <h3 class="fw-bold mt-5 mb-3">
                            8. Data Security
                        </h3>

                        <p class="text-secondary">
                            We implement appropriate technical and organizational
                            security measures to protect personal information against
                            unauthorized access, disclosure, alteration, or destruction.
                        </p>

                        <!-- GDPR Rights -->
                        <h3 class="fw-bold mt-5 mb-3">
                            9. Your GDPR Rights
                        </h3>

                        <p class="text-secondary">
                            Under the General Data Protection Regulation (GDPR),
                            you may have the right to:
                        </p>

                        <ul class="text-secondary">
                            <li>Access your personal data</li>
                            <li>Request correction of inaccurate information</li>
                            <li>Request deletion of personal data</li>
                            <li>Restrict or object to processing</li>
                            <li>Request data portability</li>
                            <li>Withdraw consent at any time</li>
                            <li>Lodge a complaint with a supervisory authority</li>
                        </ul>

                        <!-- Cookies -->
                        <h3 class="fw-bold mt-5 mb-3">
                            10. Cookies
                        </h3>

                        <p class="text-secondary">
                            Our website may use cookies or similar technologies
                            for functionality, analytics, and security purposes.
                        </p>

                        <!-- Third Party -->
                        <h3 class="fw-bold mt-5 mb-3">
                            11. Third-Party Services
                        </h3>

                        <p class="text-secondary">
                            We may use third-party platforms or infrastructure providers
                            including cloud, analytics, communication, and security services
                            that process data in accordance with applicable regulations.
                        </p>

                        <!-- Contact -->
                        <h3 class="fw-bold mt-5 mb-3">
                            12. Contact
                        </h3>

                        <p class="text-secondary">
                            If you have questions regarding this Privacy Policy
                            or your personal data, please contact:
                        </p>

                        <p class="text-secondary mb-1">
                            <strong>ITerrific B.V.</strong>
                        </p>

                        <p class="text-secondary mb-1">
                            Het Lemoen 92
                        </p>

                        <p class="text-secondary mb-1">
                            6846KE Arnhem
                        </p>

                        <p class="text-secondary mb-1">
                            The Netherlands
                        </p>

                        <p class="text-secondary">
                            Email:
                            <a href="mailto:info@iterrific.nl">
                                info@iterrific.nl
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection