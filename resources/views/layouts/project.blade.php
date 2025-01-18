

<!DOCTYPE html>
<html lang="en-US">
<!-- Mirrored from jthemes.net/themes/html/Uyioghosa E. I-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Jul 2023 16:29:53 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/update/uyi_c.png')}}">
    <title>{{ $ogData['title'] ?? 'Uyioghosa E. I - Personal Portfolio & Resume' }}</title>
    <!-- Open Graph Metadata -->
    <meta property="og:title" content="{{ $ogData['title'] ?? 'Uyioghosa E. I - Personal Portfolio & Resume' }}">
    <meta property="og:description" content="{{ $ogData['description'] ?? '' }}">
    <meta property="og:image" content="{{ $ogData['image'] ?? '' }}">
    <meta property="og:url" content="{{ $ogData['url'] ?? '' }}">
    <meta property="og:type" content="{{ $ogData['type'] ?? 'website' }}">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}} " type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/simple-line-icons.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all">
    <script src="https://unpkg.com/vue@next"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @yield('style')
</head>

<body id="app">

<!-- preloader -->
<div id="preloader">
    <div class="outer">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>

<!-- site wrapper -->
<div class="site-wrapper">

    <!-- mobile header -->
    <div class="mobile-header py-2 px-3 mt-4">
        <button class="menu-icon mr-2">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a href="index-2.html" class="logo"><img  style="height: 20em; width: 20em;"  src="{{asset('images/update/uyi_c.png')}}" alt="Uyioghosa E.I" /></a>
        <a href="index-2.html" class="site-title dot ml-2">Uyioghosa E.I</a>
    </div>

    <!-- header -->
    <header class="left float-left shadow-dark" id="header">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="header-inner d-flex align-items-start flex-column">
            <a href="#"><img style="height: 8em; width: 9em;" src="{{asset('images/update/uyi_c.png')}}" alt="Uyioghosa E.I" /></a>
            <a href="#" class="site-title dot mt-3">Uyioghosa E.I</a>
            <span class="site-slogan">Web App Developer</span>

            <!-- navigation menu -->
            <nav>
                <ul class="vertical-menu scrollspy">
                    <li><a href="{{asset('')}}#home" class="active"><i class="icon-home"></i>Home</a></li>
                    <li><a href="{{asset('')}}#about"><i class="icon-user"></i>About</a></li>
                    <li><a href="{{asset('')}}#services"><i class="icon-bulb"></i>Services</a></li>
                    <li><a href="{{asset('')}}#resume"><i class="icon-graduation"></i>Resume</a></li>
                    <li><a href="{{asset('')}}#works"><i class="icon-grid"></i>Works</a></li>
                    <!--                    <li><button style="color: #fff" data-toggle="modal" data-target="#exampleModal" class="btn btn-link" ><i class="icon-pencil"></i>buy me coffee</button></li>-->
                    <li><a href="mailto:uyibis@outlook.com"><i class="icon-envelope"></i>Contact</a></li>
                </ul>
            </nav>

            <!-- footer -->
            <div class="footer mt-auto">

                <!-- social icons -->
                <ul class="social-icons list-inline">
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/ighodaro-uyioghosa-b9352b138/"><i class="fab fa-linkedin"></i></a></li>

                    <li class="list-inline-item"><a href="https://github.com/uyibis"><i class="fab fa-github"></i></a></li>

                </ul>
            </div>
        </div>
    </header>

    <!-- main content area -->
    <main class="content float-right">


        <!-- section about -->
        <section id="about" class="shadow-blue white-bg padding">
            <h3>
                @yield('content_title')
            </h3>
            <h3 class="section-title">

            </h3>
            <div class="spacer" data-height="80"></div>
            <div>
               @yield('content')
            </div>
        </section>


    </main>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buy me a coffee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="paymentForm">
                    <div class="form-group">
                        <input placeholder="Email Address" class="form-control" type="email" id="email-address" required />
                    </div>
                    <div class="form-group">
                        <input placeholder="Amount" class="form-control" type="tel" id="amount" required />
                    </div>
                    <div class="form-group">

                        <input placeholder="First Name" class="form-control" type="text" id="first-name" />
                    </div>
                    <div class="form-group">

                        <input placeholder="Last Name" class="form-control" type="text" id="last-name" />
                    </div>
                    <div class="form-submit">
                        <button class="btn btn-light" type="submit" onclick="payWithPaystack()"> Buy Now </button>
                    </div>
                </form>

                <script src="https://js.paystack.co/v1/inline.js"></script>
            </div>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>--}}
        </div>
    </div>
</div>
<!-- Go to top button -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- SCRIPTS -->
<script src="{{asset('js/jquery-1.12.3.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('js/infinite-scroll.min.js')}}"></script>
<script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/contact.js')}}"></script>
<script src="{{asset('js/validator.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

</body>

<!-- Mirrored from jthemes.net/themes/html/Uyioghosa E. I-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Jul 2023 16:30:18 GMT -->
</html>
