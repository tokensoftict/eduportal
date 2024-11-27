<!--====== PRELOADER PART START ======-->

<div class="preloader">
    <div class="loader rubix-cube">
        <div class="layer layer-1"></div>
        <div class="layer layer-2"></div>
        <div class="layer layer-3 color-1"></div>
        <div class="layer layer-4"></div>
        <div class="layer layer-5"></div>
        <div class="layer layer-6"></div>
        <div class="layer layer-7"></div>
        <div class="layer layer-8"></div>
    </div>
</div>

<!--====== PRELOADER PART START ======-->

<!--====== HEADER PART START ======-->

<header id="header-part">

    <div class="header-top d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="header-contact text-lg-left text-center">
                        <ul>
                            <li><img src="{{ asset("frontpage/images/all-icon/call.png") }}" alt="icon"><span>+2347032077620</span></li>
                            <li><img src="{{ asset("frontpage/images/all-icon/email.png") }}" alt="icon"><span>info@eduverifiedportal.com</span></li>
                            <li><img src="{{ asset("frontpage/images/all-icon/map.png") }}" alt="icon"><span>Kwara State Library Complex, Ilorin</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="header-social text-lg-right text-center">
                        <ul>
                            <li><a href="https://www.facebook.com/zenithalevels"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header top -->
    <style>
        .logo-container {
            text-align: left; /* Center-aligns the logo and tagline */
             /* Keeps the logo compact */
        }
        .logo {
            font-family: 'Arial Black', Arial, sans-serif;
            font-size: 2rem;
            font-weight: bold;
            color: #2A73E8;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: linear-gradient(90deg, #2A73E8, #32CD32);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        .powered-by {
            font-family: 'Arial Black', Arial, sans-serif;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: linear-gradient(90deg, #2A73E8, #32CD32);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            font-size: 0.75rem; /* Smaller size for the tagline */
            color: #555; /* Subtle, neutral color */
            margin-top: -5px; /* Space between logo and tagline */
            text-align: left;
        }
    </style>
    <div class="navigation navigation-2">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-11 col-md-10 col-sm-9 col-9">
                    <nav class="navbar navbar-expand-lg">
                        <div class="logo-container">
                            <a class="navbar-brand logo" href="{{ route("index") }}">
                                EDUVERIFIED
                            </a>
                            <div class="powered-by">Powered by Zenith Academy</div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a  href="{{ route("index") }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('about') }}">About us</a>
                                </li>
                                <!--
                                <li class="nav-item">
                                    <a href="#">Courses</a>
                                </li>
                                -->
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                                @if(auth('student')->check())
                                    <li class="nav-item pull-right">
                                        <a href="{{ route('student.dashboard') }}">My Account</a>
                                    </li>
                                    <li class="nav-item pull-right">
                                        <a href="{{ route('student.logout') }}">Logout</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav> <!-- nav -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>

</header>
