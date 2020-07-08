<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="{{ asset('nihusubu.ico') }}" >
    <title>Nihusubu | @yield('title')</title>

    {{--  google analytics  --}}
    @include('layouts.google_analytics')

    <!-- Hotjar Tracking Code for http://nihusubu.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1891042,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    @yield('css')

</head>

<body>
<div id="wrapper">

    <!-- nav -->
    @include('personal.layouts.navbars.left_sidebar')
    <!-- nav -->

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- top navbar -->
        @include('personal.layouts.navbars.header')
        <!-- top navbar -->

        <!-- popup -->
        @include('personal.layouts.popover.popover')
        <!-- popup -->

        <!-- page content -->
        @yield ('content')
        <!-- /page content -->

        <!-- footer -->
    @include('personal.layouts.navbars.footer')
        <!-- /footer -->

    </div>
    <!-- chat content -->
    @include('personal.layouts.navbars.chat')
    <!-- /chat content -->

    <!-- right sidebar content -->
    @include('personal.layouts.navbars.right_sidebar')
    <!-- /right sidebar content -->

</div>

@yield('js')
</body>
</html>
