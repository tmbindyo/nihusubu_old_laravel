<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- Begin Head -->
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nihusubu | @yield('title')</title>
    <meta name="keywords" content="Nihusubu" />
    <meta name="description" content="Nihusubu">
    <meta name="author" content="fluidtechglobal.com">

    <link rel="shortcut icon" href="{{ asset('nihusubu.ico') }}" >

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
@include('landing.layouts.footer')
<!--========== END FOOTER ==========-->

<!--========== START JAVASCRIPTS ==========-->
@yield('js')
<!--========== END JAVASCRIPTS ==========-->

</body>
<!-- End Body -->
</html>
