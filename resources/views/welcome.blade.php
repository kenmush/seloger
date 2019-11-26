<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Max Ventures</title>
    <link rel="icon" href="assets/icons/favicon.png" type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}"> <!-- Resource style -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}"> <!-- Resource style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <script src="https://kit.fontawesome.com/cc8a5ea2c5.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <div class="container container-s">
            <a class="navbar-brand" href="#">Max ventures.</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#products">Features</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="btn-cta nav-link js-scroll-trigger" href="{{ route('login') }}">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav><!-- Navbar End -->


    <div id="main" class="main">
        <div class="home"><!-- Hero Section-->
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="hero-img wow fadeIn">
                            <img class="img-fluid" src="{{ asset('assets/images/big.png') }}" alt="Home">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="hero-content wow fadeIn">
                            <h1>Multi purpose listing scraper.</h1>
                            <p>Get listing data by the price per square metre from the major listing sites.</p>
                            <a class="btn-action js-scroll-trigger" href="#signup">Register now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- Hero End -->


        <div id="products" class="features wow fadeInDown">
            <div class="container-m">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="features-intro">
                            <h2>Welcome to Max Ventures, where data matters.</h2>
                            <p>We’ll Deliver the relevant listings that you need to your email every day. </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-list">
                            <div class="card-icon">
                                <div class="card-img">
                                    <i class="fas fa-file-excel fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-text">
                                <h3>Excel</h3>
                                <p>Get listings as an excel report</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-list">
                            <div class="card-icon">
                                <div class="card-img">
                                    <i class="fas fa-envelope-open-text fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-text">
                                <h3>Email</h3>
                                <p>Get listings as an email report</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-list">
                            <div class="card-icon">
                                <div class="card-img">
                                    <i class="far fa-file-pdf fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-text">
                                <h3>PDF</h3>
                                <p>Get listings as a pdf report</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="ar-ft-single wow fadeIn d-flex justify-content-center">
            <div class="col-md-7 ">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Postal Code</td>
                            <td>URL</td>
                            <td>Price</td>
                            <td>Price/m<sup>2</sup></td>
                            <td>Type</td>
                            <td>m<sup>2</sup></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Results::all()->sortByDesc('created_at')->take(5) as $result)
                            <tr class="ar-text">
                                <td><p>{{$loop->iteration }}</p></td>
                                <td><p>{{ $result->postcode }}</p></td>
                                <td>
                                    <a href="{{ $result->url }}" target="_blank">
                                        {{ \Illuminate\Support\Str::afterLast($result->url,'/') }}
                                    </a>
                                </td>
                                <td><p>{{ $result->price }}</p></td>
                                <td><p>{{ $result->squareMeterPrice }}</p></td>
                                <td><p>{{ $result->type }}</p></td>
                                <td><p>{{ $result->m2 }}</p></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <a class="btn-action js-scroll-trigger centered" href="{{ route('register') }}">Register now</a>

            </div>
        </div>

        <div id="pricing" class="pricing-section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pricing-intro wow fadeInDown">
                            <h1>Pricing Plans.</h1>
                            <p>
                                Our plans are designed to meet the requirements of both beginners <br class="hidden-xs">
                                and advanced users.
                                Get the right plan that suits you.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <div class="table-left wow fadeInDown">
                                    <div class="pricing-details">
                                        <h2>Freemium</h2>
                                        <img src="assets/icons/free.png" width="60" alt="Icon">

                                        <span>$0.00</span>
                                        <ul>
                                            <li>Email Report</li>
                                            <li>Excel Report</li>
                                            <li>PDF Report</li>
                                        </ul>
                                        <button class="btn-action" href="{{ route('register') }}">Get Plan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="table-right wow fadeInDown">
                                    <div class="pricing-details">
                                        <h2>Beginner</h2>
                                        <img src="assets/icons/paid.png" width="60" alt="Icon">
                                        <span>$0.00</span>
                                        <ul>
                                            <li>Email Report</li>
                                            <li>Excel Report</li>
                                            <li>PDF Report</li>
                                        </ul>
                                        <button class="btn-action" href="{{ route('register') }}">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Array Pricing Ends -->

        <!-- CTA Signup Section -->
        <div id="signup" class="cta-sm">
            <div class="container-m text-center">
                <div class="cta-content">
{{--                    <h4>GRAB ARRAY FOR BEST PRICE TODAY</h4>--}}
                    <h1>Start now and get your reports every day.</h1>
                    <div class="form wow fadeIn" data-wow-delay="0.2s">
                        <form id="chimp-form" class="subscribe-form wow zoomIn"
                              action="" method="post"
                              accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="off"
                              novalidate>
                            <input class="mail" id="chimp-email" type="email" name="email"
                                   placeholder="Enter your email address" autocomplete="off">
                            <input class="submit-button" type="submit" value="Sign up now">
                        </form>
                        <div id="response"></div>
                    </div>
                    <div class="form-note">
                        <p>14-day free trial and no credit card required.</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Array Footer Section -->
        <div class="footer-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a class="footer-logo" href="#">max Ventures.</a>
                    </div>
                    <div class="col-md-4">
                        <h6>&copy; Max Ventures {{ date('Y') }} Rights Reserved</h6>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Linkedin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Scroll To Top -->
        <div id="back-top" class="bk-top">
            <div class="bk-top-txt">
                <a class="back-to-top js-scroll-trigger" href="#main">top</a>
            </div>
        </div>
        <!-- Scroll To Top Ends-->

    </div> <!-- Main -->
</div>


<!-- Jquery and Js Plugins -->
<script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>



