@extends('landing.layouts.app')

@section('title', 'About')

@section('css')

        <!-- Web Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">

        <!-- Vendor Styles -->
        <link href="{{ asset('landing') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/vendor/themify/themify.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/vendor/scrollbar/scrollbar.min.css" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="{{ asset('landing') }}/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('landing') }}/css/global/global.css" rel="stylesheet" type="text/css"/>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('landing') }}/img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('landing') }}/img/apple-touch-icon.png">
@endsection()
@section('content')
        <!--========== PAGE CONTENT ==========-->
        <div class="g-bg-position--center g-fullheight--xs" style="background: url('{{ asset('landing') }}/img/1920x1080/08.jpg');">
            <div class="container js__ver-center-aligned">
                <div class="g-text-center--xs">
                    <div class="g-margin-t-40--xs g-margin-b-60--xs g-margin-b-80--sm">
                        <h1 class="g-font-size-32--xs g-font-size-50--sm g-font-size-60--md g-margin-b-30--xs">Website Coming Soon</h1>
                        <p class="text-uppercase g-font-size-20--md g-font-weight--300">Be the first to know when we launch</p>
                    </div>
                    <form>
                        <div class="row g-margin-b-80--xs">
                            <div class="col-sm-4 col-sm-offset-2 col-xs-6 g-full-width--xs g-margin-b-30--xs g-margin-b-0--md">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <i class="s-form-v4__icon ti-user"></i>
                                    </span>
                                    <input type="text" class="form-control s-form-v4__input" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-6 g-full-width--xs">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <i class="s-form-v4__icon ti-email"></i>
                                    </span>
                                    <input type="email" class="form-control s-form-v4__input" placeholder="Your Email">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="text-uppercase s-btn s-btn--md s-btn--dark-brd g-radius--50 g-padding-x-50--xs g-margin-b-20--xs">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!--========== END PAGE CONTENT ==========-->
@endsection
@section('js')

    <!--========== JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) ==========-->
    <!-- Vendor -->
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.migrate.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/jquery.smooth-scroll.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/vendor/scrollbar/jquery.scrollbar.min.js"></script>

    <!-- General Components and Settings -->
    <script type="text/javascript" src="{{ asset('landing') }}/js/global.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing') }}/js/components/scrollbar.min.js"></script>
    <!--========== END JAVASCRIPTS ==========-->
@endsection
