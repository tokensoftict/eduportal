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
                        <h5>This webpage is owned by Zenith Academy, a consultant to Adekunle Ajasin University Akungba,
                            Ondo State, on mobilization of candidates for JUPEB programme.</h5>
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
                    -->



                    <div class="section-title mt-50">
                        <h5>JUPEB OVERVIEW</h5>
                        <p>
                            Jupeb-A- level programme is an advanced level course, basically for a year duration. Candidates
                            undergoing the course are assumed to be in 100 level in the university, upon completion of the
                            programme, candidates shall sit for national examination, conducted by Jupeb examination
                            body, with venue at Adekunle Ajasin university. The result of the examination, is what various
                            candidates would use to obtain Direct Entry form ( DE ) from Jamb, in order to process 200 level
                            admission into university of their choice.
                        </p>
                        <br/>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading-1">
                                    <h5 class="mb-0">
                                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            WHY CHOOSE ADEKUNLE AJASIN UNIVERSITY AKUNGBA, FOR YOUR JUPEB PROGRAMME
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-1" class="collapse" data-parent="#accordion" aria-labelledby="heading-1">
                                    <div class="card-body">
                                        <p>We provide conducive learning environment that is second to none.</p>
                                        <p>Adekunle Ajasin University Akungba, provide you with seamless JUPEB programme</p>
                                        <p>Adekunle Ajasin University Akungba, would provide you with experienced instructors for a
                                            successful JUPEB programme.</p>
                                        <p>We have sufficient learning aid</p>

                                        <p>We have well equipped laboratory.</p>
                                        <p>We provide topnotch accommodation.</p>
                                        <p>Our school fees is affordable.</p>
                                        <p>Candidates can further their course in Law, Nursing, Medical laboratory Science, MBBS,
                                            Accounting, Economics etc, upon completion of the JUPEB programme, in Adekunle Ajasin
                                            University Akungba, or any other University, starting at 200 Level!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="section-title mt-20">
                        <h5>Eligibility</h5>
                        <p>
                            <b>i.All eligible candidates must not be less than 16 years at the commencement of the
                                2024/2025 academic session</b>
                        </p>
                        <p>
                            ii. Candidates are advised to correctly upload all their O’Level results on the portal. A
                            maximum of two (2) sittings is allowed in the case of O’Level requirements.
                        </p>
                        <p>
                            iii. AAUA accepts WAEC, NECO and NABTEB O’Level results.
                        </p>
                        <p>
                            iv. Candidates are advised to read the O’Level requirements of their courses and select
                            the right subject combinations, which must include Credit passes in English
                            Language and Mathematics.
                        </p>
                        <p>
                            v. Candidates with deficiency in O’level can still apply, such candidate admission will be
                            scrutinized and necessary recommendations provided.
                        </p>

                    </div>
                    <div class="section-title mt-20">
                        <h5>Registration Procedures for the JUPEB programme</h5>
                        <p>
                            Prospective candidate should log on to,” https//:www. eduverifiedportal.com “
                            Click register and supply a working email.
                            Fill the application form, make payment for application form.
                            Notification of admission would be received in the email provided, upon review of
                            documents submitted.
                            Candidates considered for admission into the JUPEB programme, should proceed with
                            payment of admission acceptance, and school fees on their portal.
                            For any hitches, contact <a href="mailto:info@eduverifiedportal.com">info@eduverifiedportal.com</a> , for instant response.
                            <br/>
                        </p>
                        <h6 class="mt-3 mb-3">NOTE ON FEES PAYABLE</h6>
                        <p>
                            Application Form is N 10,000 ( Ten Thousand Naira Only )
                            Admission Acceptance is N 40,000 ( Forty Thousand Naira Only )
                            Accommodation or Hostel Fee is N 30,000 ( Thirty Thousand Naira Only )
                            School Fees is N 220,000 ( Two Hundred and Twenty Thousand Naira Only )
                        </p>
                    </div>

                    <div class="section-title mt-20">
                        <h5>Resumption procedure</h5>
                        <p>
                            Candidates are to provide evidence of payments at nearest Zenith Academy office, for
                            onward transfer to the University for commencement of lectures.
                        </p>
                        <p>
                            Candidates at far distance could reach us on phone for onward transfer to our
                            representative in the University, on 08034983798.
                        </p>
                    </div>

                    <div class="section-title mt-20">
                        <p>Candidate can resume for lectures, with payment of just application form and admission acceptance,
                            what are you still waiting for?</p>
                        <b> Addresses :</b> <br/>
                        Zenith Academy, No 2 Akin-Osinyemi Street, off Allen avenue, Ikeja, Lagos.
                        Zenith Academy, Kwara State Library Complex, No 1, Zulu Gambari Road, Ilorin,
                        Kwara State.
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
