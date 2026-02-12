

<!DOCTYPE html>
<html lang="en-US">
<!-- Mirrored from jthemes.net/themes/html/Uyioghosa E. I-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Jul 2023 16:29:53 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="description" content="Uyioghosa E. I - Personal Portfolio & Resume">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(env('AUTHOR_IMAGE'))}}">

    <title>{{ $ogData['title'] ?? 'Uyioghosa E. I - Personal Portfolio & Resume' }}</title>

    <!-- Open Graph Metadata -->
    <meta property="og:title" content="{{ $ogData['title'] ?? '' }}">
    <meta property="og:description" content="{{ $ogData['description'] ?? '' }}">
    <meta property="og:image" content="{{ $ogData['image'] ?? '' }}">
    <meta property="og:url" content="{{ $ogData['url'] ?? '' }}">
    <meta property="og:type" content="{{ $ogData['type'] ?? 'website' }}">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/all.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/slick.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <script src="https://unpkg.com/vue@next"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

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
        <a href="index-2.html" class="logo"><img  style="height: 20em; width: 20em;"  src="{{asset(env('AUTHOR_IMAGE'))}}" alt="{{env('AUTHOR')}}" /></a>
        <a href="index-2.html" class="site-title dot ml-2">{{env('AUTHOR')}}</a>
    </div>

    <!-- header -->
    <header class="left float-left shadow-dark" id="header">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="header-inner d-flex align-items-start flex-column">
            <a href="#"><img style="height: 8em; width: 9em;" src="{{asset(env('AUTHOR_IMAGE'))}}" alt="Uyioghosa E.I" /></a>
            <a href="#" class="site-title dot mt-3">Uyioghosa E.I</a>
            <span class="site-slogan">Web App Developer</span>

            <!-- navigation menu -->
            <nav>
                <ul class="vertical-menu scrollspy">
                    <li><a href="#home" class="active"><i class="icon-home"></i>Home</a></li>
                    <li><a href="#about"><i class="icon-user"></i>About</a></li>
                    <li><a href="#services"><i class="icon-bulb"></i>Services</a></li>
                    <li><a href="#resume"><i class="icon-graduation"></i>Resume</a></li>
                    <li><a href="#works"><i class="icon-grid"></i>Works</a></li>
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

        <!-- section hero -->
        <section class="hero background parallax shadow-dark d-flex align-items-center" id="home" data-image-src="images/hero.jpg">
            <div class="cta mx-auto mt-2">
                <h1 class="mt-0 mb-4">I’m {{env('AUTHOR')}}<span class="dot"></span></h1>
                <p class="mb-4">I am the architect of digital possibilities, weaving lines of code into seamless experiences. With each keystroke, I unlock the doors to innovation and shape the online landscape. As a productive web developer, I blend creativity and efficiency, crafting digital marvels that inspire and empower.</p>
                <a href="cv.pdf" class="btn btn-default btn-lg mr-3"><i class="icon-grid"></i>View Resume</a>
                <div class="spacer d-md-none d-lg-none d-sm-none" data-height="10"></div>
                <a href="mailto:uyibis@outlook.com" class="btn btn-border-light btn-lg"><i class="icon-envelope"></i>Hire me</a>
            </div>
            <div class="overlay"></div>
        </section>

        <!-- section about -->
        <section id="about" class="shadow-blue white-bg padding">
            <h3 class="section-title">About Me</h3>
            <div class="spacer" data-height="80"></div>

            <div class="row">
                <div class="col-md-3">
                    <img src="{{asset(env('AUTHOR_IMAGE'))}}" alt="about" />
                </div>
                <div class="col-md-9">
                    <h2 class="mt-4 mt-md-0 mb-4">Hello,</h2>
                    <p class="mb-0">I am {{env('AUTHOR')}}, web developer from Benin, Nigeria. I have rich experience in web app design and building and customization, also I am good at application design.</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <p class="mb-2">Name: <span class="text-dark">{{env('AUTHOR')}}</span></p>
                            <p class="mb-0">Birthday: <span class="text-dark">01 August, 1989</span></p>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0 mt-sm-2">
                            <p class="mb-2">Location: <span class="text-dark">Nigeria, Benin</span></p>
                            <p class="mb-0">Email: <span class="text-dark">uyibis@outlook.com</span></p>
                        </div>
                    </div>
                    <a href="cv.pdf" class="btn btn-default mr-3"><i class="icon-cloud-download"></i>Download CV</a>
                    <a href="mailto:uyibis@outlook.com" class="btn btn-alt mt-2 mt-md-0 mt-xs-2"><i class="icon-envelope"></i>Hire me</a>
                </div>
            </div>
        </section>

        <!-- section skills -->
        <section id="skills" class="shadow-blue white-bg padding">
            <h3 class="section-title">My skills</h3>
            <div class="spacer" data-height="80"></div>

            <div class="row mt-5">

                <div class="col-md-6">
                    <!-- skill item -->
                    <div class="skill-item">
                        <div class="skill-info clearfix">
                            <h4 class="float-left mb-3 mt-0">PHP Laravel</h4>
                            <span class="float-right">90%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="95">
                            </div>
                        </div>
                        <div class="spacer" data-height="50"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- skill item -->
                    <div class="skill-item">
                        <div class="skill-info clearfix">
                            <h4 class="float-left mb-3 mt-0">C# Dotnet</h4>
                            <span class="float-right">90%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="90">
                            </div>
                        </div>
                        <div class="spacer" data-height="50"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- skill item -->
                    <div class="skill-item">
                        <div class="skill-info clearfix">
                            <h4 class="float-left mb-3 mt-0">HTML, CSS, JS, Vue3</h4>
                            <span class="float-right">90%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="90">
                            </div>
                        </div>
                        <div class="spacer d-md-none d-lg-none" data-height="50"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- skill item -->
                    <div class="skill-item">
                        <div class="skill-info clearfix">
                            <h4 class="float-left mb-3 mt-0">JAVA (Android) and Python</h4>
                            <span class="float-right">75%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="75">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- section facts -->
        <section id="facts" class="shadow-dark color-white background parallax padding-50" data-image-src="images/background-1.html">

            <div class="row relative z-1">
                <div class="col-md-3 col-sm-6">
                    <!-- fact item -->
                    <div class="fact-item text-center">
                        <i class="icon-like icon-circle"></i>
                        <h2 class="count">57</h2>
                        <span>Projects completed</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- fact item -->
                    <div class="fact-item text-center">
                        <i class="icon-cup icon-circle"></i>
                        <h2 class="count">Needed</h2>
                        <span style="color: #fff" data-toggle="modal" data-target="#exampleModal" class="btn btn-link">Cup of coffee</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- fact item -->
                    <div class="fact-item text-center">
                        <i class="icon-emotsmile icon-circle"></i>
                        <h2 class="count">60</h2>
                        <span>Happy customers</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!-- fact item -->
                    <div class="fact-item text-center">
                        <i class="icon-trophy icon-circle"></i>
                        <h2 class="count">10</h2>
                        <span>Awards won</span>
                    </div>
                </div>
            </div>

            <div class="overlay"></div>
        </section>

        <!-- section services -->
        <section id="services" class="shadow-blue white-bg padding">
            <h3 class="section-title">Services</h3>
            <div class="spacer" data-height="80"></div>

            <div class="row">

                <div class="col-md-4 col-sm-6">
                    <!-- service item -->
                    <div class="service-item text-center">
                        <i class="icon-globe icon-simple"></i>
                        <h4 class="my-3">Development</h4>
                        <p class="mb-0">As a versatile developer, I bring ideas to life through expertise in C# Blazor, .NET Windows applications, Laravel PHP, WordPress plugins, and Shopify apps, crafting seamless digital solutions one line of code at a time.</p>                    </div>
                    <div class="spacer" data-height="20"></div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- service item -->
                    <div class="service-item text-center">
                        <i class="icon-chemistry icon-simple"></i>
                        <h4 class="my-3">Design</h4>
                        <p class="mb-0">I blend creativity with code to craft dynamic applications and web experiences, transforming ideas into captivating digital realities that make a lasting impact.</p>                    </div>
                    <div class="spacer" data-height="20"></div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- service item -->
                    <div class="service-item text-center">
                        <i class="icon-directions icon-simple"></i>
                        <h4 class="my-3">Advertising</h4>
                        <p class="mb-0">I drive traffic through organic SEO and targeted marketing ads, using web design to capture attention, deliver clear messaging, and encourage user engagement.</p>                    </div>
                    <div class="spacer" data-height="20"></div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- service item -->
                    <div class="service-item text-center">
                        <i class="icon-rocket icon-simple"></i>
                        <h4 class="my-3">SEO</h4>
                        <p class="mb-0">SEO flourishes when paired with effective web design, where the seamless combination of aesthetics and functionality produces a digital experience that captivates both users and search engines.</p>   </div>
                    <div class="spacer d-md-none d-lg-none" data-height="20"></div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- service item -->
                    <div class="service-item text-center">
                        <i class="icon-note icon-simple"></i>
                        <h4 class="my-3">Data Analyst</h4>
                        <p class="mb-0">A good data analyst transforms raw data into meaningful insights, unraveling the hidden stories that empower informed decisions and shape the future.</p>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="20"></div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- service item -->
                    <div class="service-item text-center">
                        <i class="icon-bubbles icon-simple"></i>
                        <h4 class="my-3">Support</h4>
                        <p class="mb-0">Good support is like a guiding hand that lifts you up, empowers you, and reminds you that you're never alone in your journey.</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- section experience -->
        <section id="resume" class="shadow-blue white-bg padding">
            <h3 class="section-title">Certification</h3>
            <div class="spacer" data-height="80"></div>

            <!-- timeline -->
            <div class="timeline">
                <div class="entry">
                    <div class="title">
                        <span>2023</span>
                    </div>
                    <div class="body">
                        <h4 class="mt-0">Software Engineering</h4>
                        {{-- <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit aenean commodo ligula eget dolor aenean massa.</p>--}}
                    </div>
                </div>
                <div class="entry">
                    <div class="title">
                        <span>2020</span>
                    </div>
                    <div class="body">
                        <h4 class="mt-0">Data Science</h4>
                        {{-- <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit aenean commodo ligula eget dolor aenean massa.</p>--}}
                    </div>
                </div>
                <div class="entry">
                    <div class="title">
                        <span>2015 - 2010</span>
                    </div>
                    <div class="body">
                        <h4 class="mt-0">Bachelor’s of Engineering</h4>
                        {{--  <p>Lorem ipsum dolor sit amet consectetuer adipiscing elit aenean commodo ligula eget dolor aenean massa.</p>--}}
                    </div>
                </div>
                <span class="timeline-line"></span>
            </div>
        </section>


        <!-- section works -->
        <section id="works" class="shadow-blue white-bg padding">
            <h3 class="section-title">Projects</h3>
            <div class="spacer" data-height="80"></div>

            <!-- portfolio filter (desktop) -->

            <!-- portfolio filter (mobile) -->
<!--            <div class="pf-filter-wrapper mb-4">
                <select class="portfolio-filter-mobile">
                    <option value="*">Everything</option>
                    <option value=".creative">Creative</option>
                    <option value=".video">Video</option>
                    <option value=".design">Design</option>
                    <option value=".branding">Branding</option>
                </select>
            </div>-->

            <!-- portolio wrapper -->
            <div class="row portfolio-wrapper">
                <!-- portfolio item -->

                <!-- portfolio item -->
                @foreach($posts as $post)
                     <div class="col-md-4 col-sm-6 grid-item creative design">
                    <a href="{{ route('projects.show', $post->slug) }}">
                        <div class="portfolio-item">
                            <div class="details">
                                <h4 class="title">{{ $post->title }}</h4>
<!--                                <span class="term">Project, Tags</span> -->
                                <!-- Adjust as needed for categories/tags -->
                            </div>
                            <span class="plus-icon">+</span>
                            <div class="thumb">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" />
                                <div class="mask"></div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <hr/>
            <ul class="portfolio-filter list-inline">
                <li class="current list-inline-item" data-filter="*">
                    <a style="color:white" href="{{route('projects.list')}}">
                    More Projects
                    </a>
                </li>
            </ul>

            <!-- more button -->

        </section>

        <!-- section pricing table -->





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
<script src="js/jquery-1.12.3.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/infinite-scroll.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/contact.js"></script>
<script src="js/validator.js"></script>
<script src="js/custom.js"></script>

@verbatim
    <script>
        const App = Vue.createApp({
            methods:{
                viewmore(){
                    $("#exampleModal").show();
//alert("he");
                },closemodal(){
                    $("#exampleModal").hide();
                }
            }
        })
        App.component('greeting-message', {
            data() {
                return { msg: 'Hello, Vue!'
                    ,
                    message:{
                        "name":"",
                        "email":"",
                        "subject":"",
                        "msg":""
                    }
                }
            },
            template: `
<h3 class="section-title">Get in touch</h3>
            <div class="spacer" data-height="80"></div>

            <div class="row">

                <div class="col-md-4 mb-4 mb-md-0">
                    <!-- contact info -->
                    <div class="contact-info mb-5">
                        <i class="icon-phone"></i>
                        <div class="details">
                            <h5>Phone</h5>
                            <span>+2348164815827</span>
                        </div>
                    </div>
                    <div class="contact-info mb-5">
                        <i class="icon-envelope"></i>
                        <div class="details">
                            <h5>Email address</h5>
                            <span>uyibis@outlook.com</span>
                        </div>
                    </div>
                    <div class="contact-info">
                        <i class="icon-location-pin"></i>
                        <div class="details">
                            <h5>Location</h5>
                            <span>Nigeria, Benin</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Contact Form -->
                    <form id="contact-form" class="contact-form" method="post" @submit.prevent="processForm">

                        <div class="messages"></div>

                        <div class="row">
                            <div class="column col-md-6">
                                <!-- Name input -->
                                <div class="form-group">
                                    <input v-model="message.name" type="text" class="form-control" name="InputName" id="InputName" placeholder="Your name" required="required" data-error="Name is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="column col-md-6">
                                <!-- Email input -->
                                <div class="form-group">
                                    <input type="email" v-model="message.email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Email address" required="required" data-error="Email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="column col-md-12">
                                <!-- Email input -->
                                <div class="form-group">
                                    <input v-model="message.subject" type="text" class="form-control" id="InputSubject" name="InputSubject" placeholder="Subject" required="required" data-error="Subject is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="column col-md-12">
                                <!-- Message textarea -->
                                <div class="form-group">
                                    <textarea v-model="message.msg" name="InputMessage" id="InputMessage" class="form-control" rows="5" placeholder="Message" required="required" data-error="Message is required."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <button id="button"  type="submit" class="btn btn-default"><i class="icon-paper-plane"></i><span id="content"> Send Message</span></button><!-- Send Button -->

                    </form>
                    <!-- Contact Form end -->
                </div>

            </div>
`,
            methods:{

                async processForm() {
                    let text = $("#content").html();
                    $("#content").html("processing");
                    //console.log(text)
                    if (text == "processing") {
                        alert("Processing please wait");
                        return;
                    }
                    document.getElementById("button").disable = true;
                    $("#button").disable = true;
                    console.log(this.message);
                    const url = 'api/contactme'; // Replace with your API endpoint
                    const dataToSend = this.message

// Options for the fetch request
                    const options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json', // Set the content type to JSON
                            // Add any other required headers here, e.g., authentication headers
                        },
                        body: JSON.stringify(dataToSend), // Convert the data to JSON format
                    };

// Make the POST request using fetch
                    fetch(url, options)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json(); // Parse the JSON response
                        })
                        .then(data => {
                            // Handle the response data here
                            let d=data;
                            console.log('Response data:', d);
                            if(d.status==1){
                                toast(d.message,"green");
                                $("#content").html(d.message);
                            }else{
                                toast("Failed, please try again or use my email","red");
                            }
                        })
                        .catch(error => {
                            // Handle any errors that occurred during the fetch request
                            toast("Failed, please try again or use my email","red");
                            console.error('Error:', error);
                        });

                    $("#content").html(text);
                }
            }
        })
        App.mount('#app')
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        function payWithPaystack(e) {
            e.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_live_7ab39ad8a9195b60e7d53487ed4728260932feb6', // Replace with your public key
                email: document.getElementById("email-address").value,
                amount: document.getElementById("amount").value * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // label: "Optional string that replaces customer email"
                onClose: function(){
                    alert('Window closed.');
                },
                callback: function(response){
                    // let message = 'Payment complete! Reference: ' + response.reference;
                    alert("thanks");
                }
            });

            handler.openIframe();
        }
        function toast(text,bgColor){
            Toastify({
                text: text,
                className: "info",
                style: {
                    background: bgColor,
                }
            }).showToast();
        }
    </script>
@endverbatim
</body>

<!-- Mirrored from jthemes.net/themes/html/Uyioghosa E. I-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Jul 2023 16:30:18 GMT -->
</html>
