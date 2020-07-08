<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- Begin Head -->
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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

    <meta name="keywords" content="Nihusubu" />
    <meta name="description" content="Nihusubu">
    <meta name="author" content="fluidtechglobal.com">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" >

    @yield('css')

</head>
<!-- End Head -->

<!-- Body -->
<body>

<!--========== HEADER ==========-->
@include('landing.layouts.header')
<!--========== END HEADER ==========-->

<!--========== PAGE CONTENT ==========-->
@yield ('content')
<!--========== END PAGE CONTENT ==========-->

<!--========== FOOTER ==========-->
{{-- @include('landing.layouts.footer') --}}
<!--========== END FOOTER ==========-->

<!--========== START JAVASCRIPTS ==========-->
@yield('js')
<!--========== END JAVASCRIPTS ==========-->

</body>
<!-- End Body -->
</html>
