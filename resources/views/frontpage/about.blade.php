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
                        <h2>Welcome to official web page for IJMB Programme, of Ahman Pategi University, Patigi, Kwara
                            State. </h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>INTERIM JOINT MATRICULATION BOARD ( IJMB )</p>
                        <p>IJMB-A- level programme is an advanced level course, basically for a year duration. Candidates undergoing the course are assumed to be in 100 level in the university, upon completion of the programme, candidates shall sit for national examination, conducted by IJMB examination body, with venue at Ahman Pategi University. The result of the examination, is what various candidates would use to obtain Direct Entry form ( DE ) from Jamb, in order to process 200 level admission into university of their choice.</p>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{ asset('img/aboutus.jpg') }}" alt="About">
                    </div>  <!-- about imag -->
                </div>
            </div> <!-- row -->
            <div class="about-items pt-60">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-singel-items mt-30">
                            <span>01</span>
                            <h4>WHY CHOOSE AHMAN PATEGI UNIVERSITY</h4>
                            <p>We provide conducive learning environment, with seamless programme devoid of strike, candidates would have access to experienced and friendly instructors.</p>
                        </div> <!-- about singel -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-singel-items mt-30">
                            <span>02</span>
                            <h4>Our Mission</h4>
                            <p>We focus on making tertiary education accessible to all intended candidate, by removing all bottle neck that could pose hitches to accessibility.</p>
                        </div> <!-- about singel -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-singel-items mt-30">
                            <span>03</span>
                            <h4>Our vision</h4>
                            <p>In the nearest future, our organization of Zenith Academy would be household name.</p>
                        </div> <!-- about singel -->
                    </div>
                </div> <!-- row -->
            </div> <!-- about items -->
        </div> <!-- container -->
    </section>
@endsection
