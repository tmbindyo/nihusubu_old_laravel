<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="{{ asset('nihusubu.ico') }}" >
    <title>Nihusubu | @yield('title')</title>

    @yield('css')

</head>

<body>
<div id="wrapper">

    <!-- nav -->
    @include('business.layouts.navbars.left_sidebar')
    <!-- nav -->

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- top navbar -->
        @include('business.layouts.navbars.header')
        <!-- top navbar -->

        <!-- popup -->
        @include('business.layouts.popover.popover')
        <!-- popup -->

        <!-- page content -->
        @yield ('content')
        <!-- /page content -->

        <!-- footer -->
    @include('business.layouts.navbars.footer')
        <!-- /footer -->

    </div>
    <!-- chat content -->
    {{--  @include('business.layouts.navbars.chat')  --}}
    <!-- /chat content -->

    <!-- right sidebar content -->
    @include('business.layouts.navbars.right_sidebar')
    <!-- /right sidebar content -->

</div>

@yield('js')
</body>
</html>
