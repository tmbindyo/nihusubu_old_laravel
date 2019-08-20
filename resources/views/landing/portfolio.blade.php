@extends('landing.layouts.app')

@section('title', 'About')

@section('css')

        <!-- Web Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">

        <!-- Vendor Styles -->
        <link href="{{ asset('landing') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/css/animate.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/vendor/themify/themify.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/vendor/scrollbar/scrollbar.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/vendor/swiper/swiper.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/vendor/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="{{ asset('landing') }}/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/css/global/global.css" rel="stylesheet" type="text/css"/>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('landing') }}/img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('landing') }}/img/apple-touch-icon.png">
@endsection()
@section('content')
        <!--========== PROMO BLOCK ==========-->
        <div class="g-bg-color--sky-light">
            <div class="container g-padding-y-125--xs">
                <div class="g-padding-y-50--xs">
                    <h1 class="g-font-size-35--xs g-font-size-55--sm g-font-size-70--lg">We're Megakit</h1>
                    <p class="g-font-size-22--xs g-font-size-24--md g-margin-b-0--xs">Reimagining the real app experience and leading brands.</p>
                </div>
            </div>
        </div>
        <!--========== END PROMO BLOCK ==========-->

        <!--========== PAGE CONTENT ==========-->
        <!-- Portfolio Filter -->
        <div class="container g-padding-y-100--xs">
            <div class="s-portfolio">
                <div id="js__filters-portfolio-gallery" class="s-portfolio__filter-v1 cbp-l-filters-text cbp-l-filters-center">
                    <div data-filter="*" class="s-portfolio__filter-v1-item cbp-filter-item cbp-filter-item-active">Show All</div>
                    <div data-filter=".graphic" class="s-portfolio__filter-v1-item cbp-filter-item">Graphic</div>
                    <div data-filter=".logos" class="s-portfolio__filter-v1-item cbp-filter-item">Logo</div>
                    <div data-filter=".motion" class="s-portfolio__filter-v1-item cbp-filter-item">Motion</div>
                </div>
            </div>
        </div>
        <!-- End Portfolio Filter -->

        <!-- Portfolio Gallery -->
        <div class="container">
            <div id="js__grid-portfolio-gallery" class="cbp">
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos motion">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/400x500/01.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h2 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h2>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/400x500/01.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/970x647/06.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h3 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h3>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/970x647/06.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/400x500/02.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/400x500/02.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/400x550/01.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/400x550/01.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/970x647/09.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/970x647/09.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/970x647/04.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/970x647/04.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/400x500/03.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/400x500/03.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/400x500/04.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/400x500/04.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/970x647/07.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/970x647/07.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('landing') }}/img/970x647/05.jpg" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolio Item</h4>
                            <p class="g-color--white-opacity">by KeenThemes Inc.</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('landing') }}/img/970x647/05.jpg" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by KeenThemes Inc.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Item -->
            </div>
            <!-- End Portfolio Gallery -->
        </div>
        <!-- End Portfolio -->

        <!-- Clients -->
        <div class="g-container--md g-padding-y-80--xs g-padding-y-125--sm">
            <!-- Swiper Clients -->
            <div class="s-swiper js__swiper-clients">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".1s">
                            <img class="s-clients-v1" src="{{ asset('landing') }}/img/clients/01-dark.png" alt="Clients Logo">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".2s">
                            <img class="s-clients-v1" src="{{ asset('landing') }}/img/clients/02-dark.png" alt="Clients Logo">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".3s">
                            <img class="s-clients-v1" src="{{ asset('landing') }}/img/clients/03-dark.png" alt="Clients Logo">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".4s">
                            <img class="s-clients-v1" src="{{ asset('landing') }}/img/clients/04-dark.png" alt="Clients Logo">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                            <img class="s-clients-v1" src="{{ asset('landing') }}/img/clients/05-dark.png" alt="Clients Logo">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Swiper Clients -->
        </div>
        <!-- End Clients -->
        <!--========== END PAGE CONTENT ==========-->
@endsection()
@section('js')
    <!-- Back To Top -->
    <a href="javascript:void(0);" class="s-back-to-top js__back-to-top"></a>

    <!--========== JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) ==========-->
    <!-- Vendor -->
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.migrate.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.smooth-scroll.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.back-to-top.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/swiper/swiper.jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.wow.min.js"></script>

    <!-- General Components and Settings -->
    <script type="text/javascript" src="{{ asset('landing') }}/js/global.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/header-sticky.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/scrollbar.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/swiper.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/portfolio-3-col.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/wow.min.js"></script>
    <!--========== END JAVASCRIPTS ==========-->
@endsection()
