@extends('business.layouts.app')

@section('title', 'Create Client')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
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
@endsection



@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.sales')}}">Sales</a>
            </li>
            <li>
                <a href="{{route('business.clients')}}">Clients</a>
            </li>
            <li class="active">
                <strong>Client Create</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Clients</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" action="{{ route('business.client.store') }}" autocomplete="off" class="form-horizontal form-label-left">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        {{--  Product  --}}
                        <div class="row">
                            <div class="col-md-12">
                                {{--  Customer type  --}}
                                {{--  todo only one should be selectable  --}}
                                <p>Customer Type</p>
                                <div class="radio radio-inline">
                                    <input type="radio" id="individual" value="individual" name="customer_type" checked="">
                                    <label for="individual"> Individual </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="business" value="business" name="customer_type">
                                    <label for="business"> Business </label>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        {{--  First name  --}}
                                        <div class="has-warning">
                                            <input type="text" id="first_name" name="first_name" required="required" class="form-control input-lg" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{--  Last name  --}}
                                        <div class="has-warning">
                                            <input type="text" id="last_name" name="last_name" required="required" class="form-control input-lg" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                {{--  Comapny name  --}}
                                <div class="has-warning">
                                    <input type="text" id="company_name" name="company_name" required="required" class="form-control input-lg" placeholder="Company Name">
                                </div>
                                <br>
                                {{--  Customer phone number  --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            <input type="email" id="email" name="email" required="required" class="form-control input-lg" placeholder="Customer Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            <input type="text" id="phone_number" name="phone_number" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Work Phone">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                {{--  Website  --}}
                                <div class="">
                                    <input type="text" id="website" name="website" required="required" class="form-control input-lg" placeholder="Website">
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#other_details"> Other Details</a></li>
                                    <li class=""><a data-toggle="tab" href="#address">Address</a></li>
                                    <li class=""><a data-toggle="tab" href="#contact_persons"> Contact Persons </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="other_details" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="">
                                                <div class="">
                                                    {{--  Opening balance  --}}
                                                    <div class="has-warning">
                                                        <input type="number" id="opening_balance" name="opening_balance" class="form-control input-lg" placeholder="Opening balance" required>
                                                    </div>
                                                    <br>
                                                    {{--  Payment terms  --}}
                                                    <div class="has-warning">
                                                        <select name="payment_term" class="form-control input-lg" required>
                                                            <option>Select Payment Term</option>
                                                            @foreach($paymentTerms as $paymentTerm)
                                                                <option value="{{$paymentTerm->id}}">{{$paymentTerm->name}}</option>
                                                            @endforeach()
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="address" class="tab-pane">
                                        <div class="panel-body">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3 class="text-center">Billing Address</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="text-center">Shipping Address</h3>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <input type="text" id="billing_street" name="billing_street" placeholder="Street" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="billing_town" id="billing_town" class="form-control input-lg" placeholder="Town">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" id="billing_po_box" name="billing_po_box" placeholder="P.O. Box" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="billing_postal_code" id="billing_postal_code" class="form-control input-lg" placeholder="Postal Code">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" id="billing_address_line_1" name="billing_address_line_1" placeholder="Address Line 1" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="billing_address_line_2" id="billing_address_line_2" class="form-control input-lg" placeholder="Address Line 2">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" id="billing_address_email" name="billing_address_email" placeholder="Email" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="billing_address_phone_number" id="billing_address_phone_number" class="form-control input-lg" placeholder="Phone number">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <input type="text" id="shipping_street" name="shipping_street" placeholder="Street" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="shipping_town" id="shipping_town" class="form-control input-lg" placeholder="Town">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" id="shipping_po_box" name="shipping_po_box" placeholder="P.O. Box" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="shipping_postal_code" id="shipping_postal_code" class="form-control input-lg" placeholder="Postal Code">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" id="shipping_address_line_1" name="shipping_address_line_1" placeholder="Address Line 1" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="shipping_address_line_2" id="shipping_address_line_2" class="form-control input-lg" placeholder="Address Line 2">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" id="shipping_address_email" name="shipping_address_email" placeholder="Email" class="form-control input-lg">
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <input type="text" name="shipping_address_phone_number" id="shipping_address_phone_number" class="form-control input-lg" placeholder="Phone number">
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="contact_persons" class="tab-pane">
                                        <div class="panel-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone number</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-control input-lg">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control input-lg">
                                                    </td>
                                                    <td>
                                                        <input type="email" class="form-control input-lg">
                                                    </td>
                                                    <td>
                                                        <input type="phone_number" class="form-control input-lg">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <hr>
                        <br>

                        <div class="ln_solid"></div>

                        <br>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Save') }}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>


@endsection

@section('js')


    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Chosen -->
    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- JSKnob -->
    <script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- NouSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- jQuery Tags Input -->
    <script src="{{ asset('js') }}/tagplug-master/index.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('js') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    {{--  Tag script  --}}
    <script>
        $(document).ready(function() {
            var tagInput = new TagsInput({
                selector: 'tag-input',
                duplicate: false
            });
        });
    </script>

    {{--  Script to prevent form submit on enter key press  --}}
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                        files = this.files,
                        file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

        $("#basic_slider").noUiSlider({
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#range_slider").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#drag-fixed").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });


    </script>
@endsection
