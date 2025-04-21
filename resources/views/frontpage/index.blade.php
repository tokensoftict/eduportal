@extends("frontpage.layout.main")
@section('title')
    EDUVERIFIED PORTAL | POWERED BY ZENITH ACADEMY
@endsection

@section('content')
    <style>
        .faq-section .mb-0 > a {
            display: block;
            position: relative;
        }

        .faq-section .mb-0 > a:after {
            content: "\f067";
            font-family: "Font Awesome 5 Free";
            position: absolute;
            right: 0;
            font-weight: 600;
        }

        .faq-section .mb-0 > a[aria-expanded="true"]:after {
            content: "\f068";
            font-family: "Font Awesome 5 Free";
            font-weight: 600;
        }
    </style>
    <section id="slider-part" class="slider-active">
        <div class="single-slider slider-2 bg_cover" style="background-image: url({{ asset('img/explore_apu.jpg') }})" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-cont">
                            <h1 style="font-size: 39px;line-height: 50px;" data-animation="bounceInLeft" data-delay="1s" >Welcome to official web page for IJMB Programme,<br/> of Ahman Pategi University, Patigi, Kwara
                            State.</h1>
                            <a data-animation="fadeInUp" data-delay="1.3s" href="{{ route('student.register') }}" class="main-btn">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--
        <div class="single-slider slider-2 bg_cover" style="background-image: url({{ asset('img/banner2.jpg') }})" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10">
                        <div class="slider-cont">
                            <h1 style="font-size: 39px;line-height: 50px;" data-animation="bounceInLeft" data-delay="1s">Zenith Academy, an accredited affiliate of The Polytechnic Ibadan, <br/>offers weekend part-time Ordinary and Higher Diploma programs.</h1>
                            <a data-animation="fadeInUp" data-delay="1.3s" href="{{ route('student.register') }}" class="main-btn">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->


    </section>

    <section id="category-2-part" style="margin-bottom: 30px; height: auto; min-height: 70vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-sm-6">
                    <div class="section-title mt-50">
                        <h5>Welcome to official web page for IJMB Programme of Ahman Pategi University, Patigi, Kwara
                            State.</h5>
                    </div>
                    <!--
                    <div class="section-title mt-50">
                        <h5>ADEKUNLE AJASIN UNIVERSITY, AKUNGBA, ONDO STATE.</h5>
                        <p>Joint Universities Preliminary Examinations Board ( JUPEB )</p>
                    </div>
                    <div class="about-cont">
                        <p>Zenith Academy, the Consultant to Adekunle Ajasin University, Akungba on mobilization of candidates for Jupeb- A- level programme, invite suitably qualified candidate for 2024/2025 academic session of Adekunle Ajasin University Jupeb programme.</p>
                        <p><strong>Venue:</strong> The lectures shall take place only on the University campus.</p>
                    </div>
                          <div class="section-title mt-50">
                        <h5>OVERVIEW OF THE PROGRAMME</h5>
                    </div>
                    <div class="about-cont">
                        <p>Jupeb-A- level programme is an advanced level course, basically for a year duration. Candidates undergoing the course are assumed to be in 100 level in the university, upon completion of the programme, candidates shall sit for national examination, conducted by Jupeb examination body, with venue at Adekunle Ajasin university. The result of the examination, is what various candidates would use to obtain Direct Entry form ( DE )from Jamb, in order to process 200 level admission into university of their choice.</p>
                    </div>


                    <div class="section-title mt-50">
                        <h5>WHY CHOOSE ZENITH ACADEMY.</h5>
                        <p>At Zenith Academy, we provide a seamless registration platform for JUPEB programme of Adekunle
                            Ajasin University Akungba, using EDUVERIFIED.</p>
                        <p>We recommend candidate for immediate placement and commencement of lectures in the JUPEB
                            section of the University.</p>
                        <p>We provide conducive accommodation to ease stress of searching for a shelter.</p>
                        <p>Free tutorial classes by our team of experienced instructors make the difference.</p>
                        <p>Our guidance to candidate on choosing course of study and University is second to none.</p>
                        <p>Our partnership with the University gave room for flexibility in school fees payment by candidates.</p>
                        <p>We provide free accommodation for the first 50 candidates that pay all fees at once.</p>
                        <p>Candidate can resume for lectures, with payment of just application form and admission acceptance,
                            what are you still waiting for?</p>
                    </div>
                    -->
                    <div class="section-title mt-50">
                        <h5>INTERIM JOINT MATRICULATION BOARD ( IJMB )</h5>
                        <p>
                            IJMB-A- level programme is an advanced level course, basically for a year duration. Candidates
                            undergoing the course are assumed to be in 100 level in the university, upon completion of the
                            programme, candidates shall sit for national examination, conducted by IJMB examination body,
                            with venue at Ahman Pategi University. The result of the examination, is what various
                            candidates would use to obtain Direct Entry form ( DE ) from Jamb, in order to process 200 level
                            admission into university of their choice.
                        </p>
                        <br/>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading-1">
                                    <h5 class="mb-0">
                                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" style="color:black" aria-controls="collapse-1">
                                            WHY CHOOSE ADEKUNLE AJASIN UNIVERSITY AKUNGBA, FOR YOUR JUPEB PROGRAMME
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-1" class="collapse" data-parent="#accordion" aria-labelledby="heading-1">
                                    <div class="card-body">
                                        <p>1.We provide conducive learning environment that is second to none.</p>
                                        <p>2. Ahman Pategi University, provide you with seamless IJMB programme</p>
                                        <p>3. Ahman Pategi University, would provide you with experienced instructors for a successful IJMB
                                        programme.</p>
                                        <p>4.We have sufficient learning aid</p>
                                        <p>5.We have well equipped laboratory.</p>
                                        <p>6.We provide topnotch accommodation.</p>
                                        <p>7.Our school fees is affordable.</p>
                                        <p>8.Candidates can further their course in Law, Nursing, Medical laboratory Science, MBBS,</p>
                                        <p>9.Accounting, Economics etc, upon completion of the IJMB programme, in Ahman Pategi
                                        University, or any other University, starting at 200 Level!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading-2">
                                    <h5 class="mb-0">
                                        <a role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="true" style="color:black" aria-controls="collapse-2">
                                            ELIGIBILITY
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-2" class="collapse" data-parent="#accordion" aria-labelledby="heading-2">
                                    <div class="card-body">
                                        <div class="section-title mt-20">
                                            <p>
                                                <b>i.All eligible candidates must not be less than 15 years at the commencement of the
                                                    2025/2026 academic session</b>
                                            </p>
                                            <p>
                                                ii. Candidates are advised to correctly upload all their O’Level results on the portal. A
                                                maximum of <b>two (2) sittings is allowed in the case of O’Level requirements.</b>
                                            </p>
                                            <p>
                                                iii. Ahman Pategi University accepts <b>WAEC</b>, <b>NECO</b> and <b>NABTEB O’Level results.</b>
                                            </p>
                                            <p>
                                                iv. Candidates with deficiency in O’level can still apply, such candidate admission will be
                                                scrutinized and necessary recommendations provided.
                                            </p>
                                            <p>
                                                v. Candidates with deficiency in O’level can still apply, such candidate admission will be
                                                scrutinized and necessary recommendations provided.
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading-3">
                                    <h5 class="mb-0">
                                        <a role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="true" style="color:black" aria-controls="collapse-3">
                                            REGISTRATION PROCEDURES FOR THE JUPEB PROGRAMME
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-3" class="collapse" data-parent="#accordion" aria-labelledby="heading-3">
                                    <div class="card-body">


                                        <div class="section-title mt-20">
                                            <p>
                                                Prospective candidate should log on to,” <a href="https://www.eduverifiedportal.com/">https://www.eduverifiedportal.com/</a> “
                                                Click register and supply a working email.
                                                Fill the application form, make payment for application form.
                                                Notification of admission would be received in the email provided, upon review of
                                                documents submitted.
                                                Candidates considered for admission into the IJMB programme, should proceed with
                                                payment of admission acceptance, and school fees on their portal.
                                                Regular registration would closes on 30 th of June, 2025
                                                Late registration would attract extra fees, commencing on 1 st of July, 2025
                                                For any hitches, contact <a href="mailto:info@eduverifiedportal.com">info@eduverifiedportal.com</a> , for instant response.
                                                <br/>
                                            </p>
                                            <h6 class="mt-3 mb-3">NOTE ON FEES PAYABLE</h6>
                                            <p>Application Form is N 10,000 ( Ten Thousand Naira Only )</p>
                                            <p>Admission Acceptance is N 40,000 ( Forty Thousand Naira Only )</p>
                                            <p>School Fees is N 150,000 ( One hundred and Fifty Thousand Naira Only )</p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading-4">
                                    <h5 class="mb-0">
                                        <a role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="true" style="color:black" aria-controls="collapse-4">
                                            RESUMPTION PROCEDURE
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-4" class="collapse" data-parent="#accordion" aria-labelledby="heading-3">
                                    <div class="card-body">

                                        <div class="section-title mt-20">
                                            <p>
                                                Candidates are to provide evidence of payments at the University mini campus, Ahman Pategi
                                                University, flower Garden, GRA, Ilorin, for commencement of lectures.
                                            </p>
                                            <p>
                                                Candidates at far distance could reach us on phone for further enquiries on resumption,
                                                via 08034983798.
                                            </p>
                                        </div>
                                        <div class="section-title mt-20">
                                            <p>Candidate can resume for lectures, with payment of just application form and admission acceptance,
                                                what are you still waiting for?</p>
                                            <b> Addresses :</b> <br/>
                                            <p>Ilorin Address, Ahman Pategi University, flower Garden, GRA, Ilorin.</p>
                                            <p>Pategi address, Km 3 Patigi-Kpada road, Patigi, Kwara State.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

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
