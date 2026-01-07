@extends('layouts.public')

@section('content')

<!-- References Hero -->
<section class="page-header min-vh-50 d-flex align-items-center"
         style="background-image:url('{{ asset('assets/img/Slide/bg2.jpg') }}');
                background-size:cover;
                background-position:center;">
    <span class="mask bg-gradient-dark opacity-7"></span>

    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-white">
                    References & Partnerships
                </h1>
                <p class="lead text-white opacity-9 mt-3">
                    Trusted by organizations who value reliability, expertise and long-term collaboration.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Clients & Partners -->
<section class="py-6 bg-light">
    <div class="container">

        <div class="row mb-5 text-center">
            <div class="col">
                <h2 class="fw-bold">Clients & Partners</h2>
                <p class="text-secondary mt-2">
                    Organizations we proudly work with.
                </p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">

            @foreach (range(1,6) as $i)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm text-center p-4">
                    <img src="{{ asset('assets/img/partners/logo-placeholder.jpg') }}"
                         alt="Partner logo"
                         class="img-fluid mx-auto"
                         style="max-height:80px;">
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>
<!-- Customer Stories -->
<section class="py-6 bg-dark text-white">
    <div class="container">

        <div class="row mb-6">
            <div class="col text-center">
                <h2 class="fw-bold text-uppercase">
                    What Our Clients Say
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">

                <!-- Story item -->
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
                        <img src="{{ asset('assets/img/Slide/bg1.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Customer story">
                    </div>

                    <div class="col-lg-7">
                        <h4 class="fw-bold">Enterprise Infrastructure Project</h4>
                        <p class="text-light mt-3">
                            “ITerrific helped us redesign our entire IT infrastructure.
                            From architecture to implementation, everything was delivered
                            professionally and reliably.”
                        </p>
                        <p class="text-warning fw-bold mb-0">
                            — Head of IT, Enterprise Client
                        </p>
                    </div>
                </div>

                <!-- Story item -->
                <div class="row position-relative mb-6">
                    <div class="col-1 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                  style="width:40px;height:40px;">
                                <i class="material-icons text-dark">cloud</i>
                            </span>
                            <div class="flex-grow-1 border-start border-warning mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg2.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Customer story">
                    </div>

                    <div class="col-lg-7">
                        <h4 class="fw-bold">Cloud & Virtualization Journey</h4>
                        <p class="text-light mt-3">
                            “The ITerrific team guided us through a complex cloud migration.
                            Their expertise and calm approach made a big difference.”
                        </p>
                        <p class="text-warning fw-bold mb-0">
                            — CTO, Technology Partner
                        </p>
                    </div>
                </div>

                <!-- Last item (no line) -->
                <div class="row position-relative">
                    <div class="col-1 d-flex justify-content-center">
                        <span class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                              style="width:40px;height:40px;">
                            <i class="material-icons text-dark">handshake</i>
                        </span>
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/img/Slide/bg3.jpg') }}"
                             class="img-fluid rounded shadow"
                             alt="Customer story">
                    </div>

                    <div class="col-lg-7">
                        <h4 class="fw-bold">Long-Term Partnership</h4>
                        <p class="text-light mt-3">
                            “What we value most is the partnership mindset.
                            ITerrific feels like an extension of our own team.”
                        </p>
                        <p class="text-warning fw-bold mb-0">
                            — Managing Director, Media Company
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
