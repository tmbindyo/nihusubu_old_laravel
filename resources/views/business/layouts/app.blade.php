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

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/dropzone/dropzone.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick-theme.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('inspinia') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('inspinia') }}/css/plugins/footable/footable.core.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('inspinia') }}/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick-theme.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

    <link href="{{ asset('css') }}/choices.min.css" rel="stylesheet">
    

    {{--  Tags  --}}
    <style>
        .tags-input-wrapper {
            background: #ffffff;
            padding: 10px;
            border-radius: 4px;
            max-width: 650px;
            border: 1px solid #ccc
        }

        .tags-input-wrapper input {
            border: none;
            background: transparent;
            outline: none;
            width: 150px;
        }

        .tags-input-wrapper .tag {
            display: inline-block;
            background-color: #009432;
            color: white;
            border-radius: 20px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>

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
