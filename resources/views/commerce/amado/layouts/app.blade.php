<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>{{$institution->name}} | @yield('title')</title>

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

{{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8FFXhb8U-H-NRDEyefX6uNjgqsjXXmCs&libraries=places"></script>--}}


    <script>
        var input = document.getElementById('city');
        var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});
        google.maps.event.addListener(autocomplete, 'place_changed', function(){
            var place = autocomplete.getPlace();
        })
    </script>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('e_commerce/amado') }}/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('e_commerce/amado') }}/css/core-style.css">
    <link rel="stylesheet" href="{{ asset('e_commerce/amado') }}/style.css">

    @yield('css')

</head>

<body>
<!-- Search Wrapper Area Start -->
@include('commerce.amado.layouts.search')
<!-- Search Wrapper Area End -->

<!-- ##### Main Content Wrapper Start ##### -->
<div class="main-content-wrapper d-flex clearfix">

    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
            <a href="{{route('commerce.index',$institution->portal)}}"><img src="{{ asset('e_commerce/amado') }}/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Header Area Start -->
    @include('commerce.amado.layouts.header')
    <!-- Header Area End -->

    <!-- Product Catagories Area Start -->
    @yield('content')

    <!-- Product Catagories Area End -->
</div>
<!-- ##### Main Content Wrapper End ##### -->

<!-- ##### Newsletter Area Start ##### -->
@include('commerce.amado.layouts.newsletter')
<!-- ##### Newsletter Area End ##### -->

<!-- ##### Footer Area Start ##### -->
@include('commerce.amado.layouts.footer')
<!-- ##### Footer Area End ##### -->

<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="{{ asset('e_commerce/amado') }}/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="{{ asset('e_commerce/amado') }}/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="{{ asset('e_commerce/amado') }}/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="{{ asset('e_commerce/amado') }}/js/plugins.js"></script>
<!-- Active js -->
<script src="{{ asset('e_commerce/amado') }}/js/active.js"></script>

<!-- js content -->
@yield ('js')
<!-- /js content -->

</body>

</html>
