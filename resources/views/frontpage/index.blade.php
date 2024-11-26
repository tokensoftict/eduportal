@extends("frontpage.layout.main")
@section('title')
   EDUVERIFIED PORTAL | POWERED BY ZENITH ACADEMY
@endsection

@section('content')

    <section id="slider-part" class="slider-active">
        <div class="single-slider slider-2 bg_cover" style="background-image: url({{ asset('img/newbanner.jpg') }})" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-cont">
                            <h1 style="font-size: 39px;line-height: 50px;" data-animation="bounceInLeft" data-delay="1s">Welcome to Eduverified Portal,<br/> for Jupeb Programme Mobilization of Adekunle Ajasin University Akungba, Ondo State.</h1>
                            <a data-animation="fadeInUp" data-delay="1.3s" href="{{ route('student.register') }}" class="main-btn">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="category-2-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title mt-50">
                        <h5>Adekunle Ajasin University, Akungba, Ondo State.</h5>
                        <p>Joint Universities Preliminary Examinations Board ( JUPEB )</p>
                    </div>
                    <div class="about-cont">
                        <p>Zenith Academy, the Consultant to Adekunle Ajasin University, Akungba on mobilization of candidates for Jupeb- A- level programme, invite suitably qualified candidate for 2024/2025 academic session of Adekunle Ajasin University Jupeb programme.</p>
                        <p>Venue: The lectures shall take place only in the University campus.</p>
                    </div>
                    <div class="about-cont">
                        <p>Overview of the programme : Jupeb-A- level programme is an advanced level course, basically for a year duration. Candidates undergoing the course are assumed to be in 100 level in the university, upon completion of the programme, candidates shall sit for national examination, conducted by Jupeb examination body, with venue at Adekunle Ajasin university. The result of the examination, is what various candidates would use to obtain Direct Entry form ( DE )from Jamb, in order to process 200 level admission into university of their choice.</p>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="category-form">
                        <div class="form-title text-center">
                            <h3>Interested</h3>
                            <span>Sign up now </span>
                        </div>
                        <div class="main-form">
                            @livewire('front-end.signup')
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

@endsection
