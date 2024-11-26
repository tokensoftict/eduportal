@extends("frontpage.layout.main")
@section('title')
    ABOUT US | POWERED BY ZENITH ACADEMY
@endsection

@section('content')

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{ asset('img/newbanner.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>About Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>



    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>About us</h5>
                        <h2>Welcome to Eduverified Portal, Powered By Zenith Academy </h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>Zenith Academy is a private educational institution that was established in 2010.</p>
                        <p>We received full approval from the Kwara State Government’s Ministry of Tertiary Education and Agency for Mass Education in the year 2015. Ever since, we have positioned as leaders in the Nigerian advanced educational programme landscape.</p>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{ asset('frontpage/images/about/about-2.jpg') }}" alt="About">
                    </div>  <!-- about imag -->
                </div>
            </div> <!-- row -->
            <div class="about-items pt-60">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-singel-items mt-30">
                            <span>01</span>
                            <h4>Why Choose us</h4>
                            <p>We provide conusive learning environment, with seamless programme programme without strike, and experienced friendly instructors and free accomodation for the first 50 candidates</p>
                        </div> <!-- about singel -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-singel-items mt-30">
                            <span>02</span>
                            <h4>Our Mission</h4>
                            <p></p>
                        </div> <!-- about singel -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-singel-items mt-30">
                            <span>03</span>
                            <h4>Our vission</h4>
                            <p></p>
                        </div> <!-- about singel -->
                    </div>
                </div> <!-- row -->
            </div> <!-- about items -->
        </div> <!-- container -->
    </section>
@endsection
