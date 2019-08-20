@extends('landing.layouts.app')

@section('title', 'Events')

@section('css')
    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">

    <!-- Vendor Styles -->
    <link href="{{ asset('landing') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('landing') }}/css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('landing') }}/vendor/themify/themify.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('landing') }}/vendor/scrollbar/scrollbar.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('landing') }}/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('landing') }}/vendor/swiper/swiper.min.css" rel="stylesheet" type="text/css"/>

    <!-- Theme Styles -->
    <link href="{{ asset('landing') }}/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('landing') }}/css/global/global.css" rel="stylesheet" type="text/css"/>

    <!-- Theme Skins -->
    <link href="{{ asset('landing') }}/css/theme/red.css" rel="stylesheet" type="text/css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('landing') }}/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('landing') }}/img/apple-touch-icon.png">
@endsection()
@section('content')
        <!--========== PROMO BLOCK ==========-->
        <div class="s-promo-block-v3 g-bg-position--center g-fullheight--sm" style="background: url('{{ asset('landing') }}/img/1920x1080/09.jpg');">
            <div class="container g-ver-center--sm g-padding-y-125--xs g-padding-y-0--sm">
                <div class="g-margin-t-30--xs g-margin-t-0--sm g-margin-b-30--xs g-margin-b-70--md">
                    <h1 class="g-font-size-35--xs g-font-size-45--sm g-font-size-50--lg g-color--white">The New York<br>Event. Megakit.</h1>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-push-4 g-margin-b-50--xs g-margin-b-0--md">
                        <div class="s-promo-block-v3__divider g-display-none--xs g-display-block--md"></div>
                        <div class="row">
                            <div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
                                <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".4s">
                                    <p class="g-font-size-18--xs g-color--white-opacity">The time has come to bring those ideas and plans to life. This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>
                                </div>
                            </div>
                            <div class="col-sm-5 col-sm-offset-1">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".3s">
                                            <span class="s-promo-block-v3__date g-font-size-100--xs g-font-size-135--lg g-font-weight--300 g-color--primary">21</span>
                                        </div>
                                    </div>
                                    <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".1s">
                                        <span class="s-promo-block-v3__month g-font-size-18--xs g-font-size-22--lg g-font-weight--300 g-color--white-opacity-light">Dec</span>
                                        <span class="s-promo-block-v3__year g-font-size-18--xs g-font-size-22--lg g-font-weight--300 g-color--white-opacity-light">2016</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-sm-pull-8">
                        <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".5s">
                            <a class="js__popup__youtube" href="https://www.youtube.com/watch?v=lcFYdgZKZxY" title="Intro Video">
                                <i class="s-icon s-icon--lg s-icon--white-bg g-radius--circle ti-control-play"></i>
                                <span class="text-uppercase g-font-size-13--xs g-color--white g-padding-x-15--xs">Watch the Overview</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--========== END PROMO BLOCK ==========-->

        <!--========== PAGE CONTENT ==========-->
        <!-- Masonry -->
        <div class="g-hor-divider__dashed--sky-light">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="row">
                    <div class="col-md-5 col-md-push-7 g-margin-t-0--xs g-margin-t-70--lg g-margin-b-60--xs g-margin-b-0--lg">
                        <div class="g-margin-b-40--xs">
                            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Culture</p>
                            <h2 class="g-font-size-32--xs g-font-size-36--sm g-margin-b-30--xs">Megakit Event in New York</h2>
                            <p>The time has come to bring those ideas and plans to life. This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>
                            <p>We strive to embrace and drive change in our industry which allows us to keep our clients relevant and ready to adapt.</p>
                            <p>We hope to dramatically improve customers’ lives and acquire new customers—or expand our relationship with existing customers—by designing effortless experiences for them.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-pull-5">
                        <!-- Masonry Grid -->
                        <div class="row g-row-col--5 js__masonry">
                            <div class="col-xs-6 col-sm-6 col-md-1 js__masonry-sizer"></div>
                            <div class="col-xs-6 g-full-width--xs g-margin-b-10--xs js__masonry-item">
                                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing') }}/img/500x750/01.jpg" alt="Image">
                            </div>
                            <div class="col-xs-6 g-full-width--xs g-margin-t-25--md g-margin-b-10--xs js__masonry-item">
                                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing') }}/img/450x215/01.jpg" alt="Image">
                            </div>
                            <div class="col-xs-6 g-full-width--xs g-margin-b-10--xs js__masonry-item">
                                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing') }}/img/500x750/02.jpg" alt="Image">
                            </div>
                            <div class="col-xs-6 g-full-width--xs g-margin-b-10--xs js__masonry-item">
                                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing') }}/img/450x295/01.jpg" alt="Image">
                            </div>
                        </div>
                        <!-- End Masonry Grid -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Masonry -->

        <!-- Features -->
        <div class="container g-padding-y-80--xs g-padding-y-125--sm">
            <div class="row g-margin-b-60--xs g-margin-b-70--md">
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".1s">
                                <i class="g-font-size-28--xs g-color--primary ti-desktop"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Responsive Layout</h3>
                            <p class="g-margin-b-0--xs">This is where we sit down, grab a cup of coffee and dial in the details.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".2s">
                                <i class="g-font-size-28--xs g-color--primary ti-settings"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Fully Customizable</h3>
                            <p class="g-margin-b-0--xs">This is where we sit down, grab a cup of coffee and dial in the details.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".3s">
                                <i class="g-font-size-28--xs g-color--primary ti-ruler-alt-2"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Pixel Perfect</h3>
                            <p class="g-margin-b-0--xs">This is where we sit down, grab a cup of coffee and dial in the details.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".4s">
                                <i class="g-font-size-28--xs g-color--primary ti-package"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Endless Possibilities</h3>
                            <p class="g-margin-b-0--xs">This is where we sit down, grab a cup of coffee and dial in the details.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 g-margin-b-60--xs g-margin-b-0--md">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".5s">
                                <i class="g-font-size-28--xs g-color--primary ti-star"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Powerful Performance</h3>
                            <p class="g-margin-b-0--xs">This is where we sit down, grab a cup of coffee and dial in the details.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="clearfix">
                        <div class="g-media g-width-30--xs">
                            <div class="wow fadeInDown" data-wow-duration=".3" data-wow-delay=".6s">
                                <i class="g-font-size-28--xs g-color--primary ti-panel"></i>
                            </div>
                        </div>
                        <div class="g-media__body g-padding-x-20--xs">
                            <h3 class="g-font-size-18--xs">Parallax Support</h3>
                            <p class="g-margin-b-0--xs">This is where we sit down, grab a cup of coffee and dial in the details.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Features -->

        <!-- Upcoming Event -->
        <div class="s-promo-block-v2 js__parallax-window" style="background: url(img/1920x1080/03.jpg) 50% 0 no-repeat fixed; background-size: cover;">
            <div class="container">
                <div class="row g-hor-centered-row--md">
                    <div class="col-md-7 g-hor-centered-row__col g-padding-y-80--xs">
                        <h2 class="g-font-size-40--xs g-font-size-50--sm g-font-size-60--md g-color--white">Request a Quote</h2>
                        <div class="g-margin-b-20--xs">
                            <span class="g-font-size-30--xs g-font-weight--700 g-color--white">21</span>
                            <span class="g-font-size-14--xs g-color--white">st</span>
                            <span class="g-font-size-30--xs g-color--white g-padding-x-5--xs"><i>of</i></span>
                            <span class="g-font-size-30--xs g-font-weight--700 g-color--white">December</span>
                        </div>
                        <p class="g-font-size-18--xs g-color--white-opacity g-margin-b-40--xs">We aim high at being focused on building relationships with our clients and community. Working together on the daily requires each individual to let the greater good of the team’s work surface above their own ego.</p>
                        <a href="http://keenthemes.com/" class="text-uppercase s-btn s-btn--md s-btn--white-brd g-radius--50 g-padding-x-50--xs g-margin-b-20--xs">Find out More</a>
                    </div>
                    <div class="col-md-5 g-hor-centered-row__col g-margin-b-80--xs">
                        <form class="center-block s-promo-block-v2__form g-width-100-percent--xs g-width-400--sm g-bg-color--dark-light g-padding-x-50--xs g-padding-y-80--xs g-radius--4">
                            <div class="g-text-center--xs g-margin-b-40--xs">
                                <h2 class="g-font-size-30--xs g-color--white">Join Event</h2>
                            </div>
                            <div class="g-margin-b-40--xs">
                                <input type="text" class="form-control s-form-v3__input" placeholder="* Name">
                            </div>
                            <div class="g-margin-b-40--xs">
                                <input type="email" class="form-control s-form-v3__input" placeholder="* Email">
                            </div>
                            <div class="g-margin-b-40--xs">
                                <input type="text" class="form-control s-form-v3__input" placeholder="* Phone">
                            </div>
                            <div class="g-text-center--xs">
                                <button type="submit" class="text-uppercase btn-block s-btn s-btn--md s-btn--white-bg g-radius--50 g-padding-x-50--xs g-margin-b-20--xs">Join Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Upcoming Event -->

        <!-- Speakers -->
        <div class="g-hor-divider__dashed--sky-light">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="g-text-center--xs g-margin-b-80--xs">
                    <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Crew</p>
                    <h2 class="g-font-size-32--xs g-font-size-36--sm">Who Can you Hear?</h2>
                </div>
                <div class="row g-overflow--hidden">
                    <div class="col-xs-6 g-full-width--xs g-margin-b-30--xs g-margin-b-0--lg">
                        <!-- Speaker -->
                        <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                            <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing') }}/img/400x400/02.jpg" alt="Image">
                            <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                                <div class="g-bg-color--primary g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                                    <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">Anna Kusaikina</h4>
                                </div>
                                <p class="g-font-weight--700">Designer</p>
                                <p>Now that we've aligned the details, it's time to get things mapped out and organized. This part is really crucial in keeping the project in line to completion.</p>
                            </div>
                        </div>
                        <!-- End Speaker -->
                    </div>
                    <div class="col-xs-6 g-full-width--xs">
                        <!-- Speaker -->
                        <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                            <img class="img-responsive g-width-100-percent--xs" src="{{ asset('landing') }}/img/400x400/01.jpg" alt="Image">
                            <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                                <div class="g-bg-color--primary g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                                    <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">Lucas Richardson</h4>
                                </div>
                                <p class="g-font-weight--700">Senior Developer</p>
                                <p>Now that we've aligned the details, it's time to get things mapped out and organized. This part is really crucial in keeping the project in line to completion.</p>
                            </div>
                        </div>
                        <!-- End Speaker -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Speakers -->

        <!-- Plan -->
        <div class="container g-padding-y-80--xs g-padding-y-125--sm">
            <div class="row g-row-col--0 g-overflow--hidden">
                <div class="col-md-3 col-xs-6 g-full-width--xs">
                    <!-- Plan v2 -->
                    <div class="s-plan-v2 g-text-center--xs g-margin-t-0--xs g-margin-t-45--lg">
                        <div class="g-padding-x-30--xs g-padding-y-30--xs">
                            <h4 class="g-font-size-18--xs g-color--primary g-margin-b-5--xs">Online</h4>
                            <p><i>Online people</i></p>
                        </div>
                        <ul class="list-unstyled g-ul-li-tb-15--xs g-margin-b-0--xs">
                            <li class="g-bg-color--sky-light">
                                <span class="g-font-size-18--xs g-font-weight--700 g-color--primary">$</span>
                                <span class="g-font-size-26--xs g-font-weight--700 g-color--primary">19.00</span>
                            </li>
                            <li class="g-hor-divider__solid--sky-light">Live</li>
                            <li>Badge</li>
                        </ul>
                        <div class="g-padding-x-40--xs g-padding-y-40--xs">
                            <button type="button" class="text-uppercase btn-block s-btn s-btn--sm s-btn--primary-brd g-radius--50">Signup</button>
                        </div>
                    </div>
                    <!-- End Plan v2 -->
                </div>
                <div class="col-md-3 col-xs-6 g-full-width--xs">
                    <!-- Plan v2 -->
                    <div class="s-plan-v2 g-text-center--xs g-margin-t-0--xs g-margin-t-45--lg">
                        <div class="g-padding-x-30--xs g-padding-y-30--xs">
                            <h4 class="g-font-size-18--xs g-color--primary g-margin-b-5--xs">Standard</h4>
                            <p><i>Beginner</i></p>
                        </div>
                        <ul class="list-unstyled g-ul-li-tb-15--xs g-margin-b-0--xs">
                            <li class="g-bg-color--sky-light">
                                <span class="g-font-size-18--xs g-font-weight--700 g-color--primary">$</span>
                                <span class="g-font-size-26--xs g-font-weight--700 g-color--primary">29.00</span>
                            </li>
                            <li class="g-hor-divider__solid--sky-light">Live</li>
                            <li>Badge</li>
                        </ul>
                        <div class="g-padding-x-40--xs g-padding-y-40--xs">
                            <button type="button" class="text-uppercase btn-block s-btn s-btn--sm s-btn--primary-brd g-radius--50">Signup</button>
                        </div>
                    </div>
                    <!-- End Plan v2 -->
                </div>
                <div class="col-md-3 col-xs-6 g-full-width--xs">
                    <!-- Plan v2 -->
                    <div class="s-plan-v2__main g-text-center--xs">
                        <div class="g-padding-x-30--xs g-padding-y-30--xs">
                            <i class="g-display-none--xs g-display-block--lg g-font-size-30--xs g-color--primary g-margin-b-20--xs ti-crown"></i>
                            <h4 class="g-font-size-18--xs g-color--primary g-margin-b-5--xs">Enterprise</h4>
                            <p><i>Professional</i></p>
                        </div>
                        <ul class="list-unstyled g-ul-li-tb-15--xs g-margin-b-0--xs">
                            <li class="g-bg-color--sky-light">
                                <span class="g-font-size-18--xs g-font-weight--700 g-color--primary">$</span>
                                <span class="g-font-size-26--xs g-font-weight--700 g-color--primary">39.00</span>
                            </li>
                            <li class="g-hor-divider__solid--sky-light">Live</li>
                            <li>Badge</li>
                        </ul>
                        <div class="g-padding-x-40--xs g-padding-y-40--xs">
                            <button type="button" class="text-uppercase btn-block s-btn s-btn--sm s-btn--primary-bg g-radius--50">Signup</button>
                        </div>
                    </div>
                    <!-- End Plan v2 -->
                </div>
                <div class="col-md-3 col-xs-6 g-full-width--xs g-margin-t-0--xs g-margin-t-45--lg">
                    <!-- Plan v2 -->
                    <div class="s-plan-v2 u-text--c g-text-center--xs">
                        <div class="g-padding-x-30--xs g-padding-y-30--xs">
                            <h4 class="g-font-size-18--xs g-color--primary g-margin-b-5--xs">VIP</h4>
                            <p><i>Special Guests</i></p>
                        </div>
                        <ul class="list-unstyled g-ul-li-tb-15--xs g-margin-b-0--xs">
                            <li class="g-bg-color--sky-light">
                                <span class="g-font-size-18--xs g-font-weight--700 g-color--primary">$</span>
                                <span class="g-font-size-26--xs g-font-weight--700 g-color--primary">79.00</span>
                            </li>
                            <li class="g-hor-divider__solid--sky-light">Live</li>
                            <li>Badge</li>
                        </ul>
                        <div class="g-padding-x-40--xs g-padding-y-40--xs">
                            <button type="button" class="text-uppercase btn-block s-btn s-btn--sm s-btn--primary-brd g-radius--50">Signup</button>
                        </div>
                    </div>
                    <!-- End Plan v2 -->
                </div>
            </div>
        </div>
        <!-- End Plan -->

        <!-- Promo Section -->
        <div class="g-promo-section">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="row">
                    <div class="col-sm-5 col-sm-push-7">
                        <div class="g-margin-b-30--xs">
                            <h3 class="g-font-size-32--xs g-font-size-36--sm"><a href="{{route('event',1)}}">Events in Paris</a></h3>
                            <p>It’s important to stay detail oriented with every project we tackle. Staying focused allows us to turn every project we complete into something we love.</p>
                        </div>
                        <a href="{{route('event',1)}}" class="text-uppercase s-btn s-btn--sm s-btn--primary-brd g-radius--50 g-padding-x-40--xs">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-pull-6 g-promo-section__img-right--md g-promo-section__img-left--md g-bg-position--center g-height-400--xs g-height-100-percent--md js__fullwidth-img">
                <img class="img-responsive" src="{{ asset('landing') }}/img/970x970/01.jpg" alt="Image">
            </div>
        </div>
        <!-- End Promo Section -->

        <!-- Promo Section -->
        <div class="g-promo-section">
            <div class="container g-padding-y-80--xs g-padding-y-125--sm">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="g-margin-b-30--xs">
                            <h3 class="g-font-size-32--xs g-font-size-36--sm"><a href="{{route('event',1)}}">November Event</a></h3>
                            <p>It’s important to stay detail oriented with every project we tackle. Staying focused allows us to turn every project we complete into something we love.</p>
                        </div>
                        <a href="{{route('event',1)}}" class="text-uppercase s-btn s-btn--sm s-btn--primary-brd g-radius--50 g-padding-x-40--xs">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 g-promo-section__img-right--md g-bg-position--center g-height-400--xs g-height-100-percent--md js__fullwidth-img">
                <img class="img-responsive" src="{{ asset('landing') }}/img/970x970/02.jpg" alt="Image">
            </div>
        </div>
        <!-- End Promo Section -->

        <!-- Clients -->
        <div class="g-padding-y-80--xs g-padding-y-125--sm">
            <div class="g-container--sm">
                <div class="g-text-center--xs g-margin-b-80--xs">
                    <h2 class="g-font-size-32--xs g-font-size-36--sm">Sponsors</h2>
                    <p class="g-font-size-18--md">Whether through commerce or just an experience to tell your brand's story, the time has come to start using development languages that fit your projects needs.</p>
                </div>
            </div>
            <div class="g-container--md">
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
        </div>
        <!-- End Clients -->

        <!-- Google Map -->
        <section class="s-google-map">
            <div id="js__google-container" class="s-google-container g-height-400--xs"></div>
        </section>
        <!-- End Google Map -->
        <!--========== END PAGE CONTENT ==========-->
@endsection
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
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/swiper/swiper.jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/masonry/jquery.masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/masonry/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.parallax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsXUGTFS09pLVdsYEE9YrO2y4IAncAO2U"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.wow.min.js"></script>

    <!-- General Components and Settings -->
    <script type="text/javascript" src="{{ asset('landing') }}/js/global.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/header-sticky.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/scrollbar.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/magnific-popup.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/swiper.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/masonry.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/parallax.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/google-map2.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/wow.min.js"></script>
    <!--========== END JAVASCRIPTS ==========-->
@endsection()
