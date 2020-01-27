@extends('business.layouts.app')

@section('title', 'Assets')

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

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">


    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Assets</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.assets',$institution->portal)}}">Assets</a>
            </li>
            <li class="active">
                <strong>Asset Create</strong>
            </li>
        </ol>
    </div>
</div>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Assets</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="btn btn-outline-primary" data-toggle="modal" data-target="#assetGroupRegistration">
                                <i class="fa fa-plus-circle"> Add Asset</i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="">
                            <form method="post" action="{{ route('business.asset.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                {{--  Asset  --}}
                                <div class="row">
                                    <div class="col-md-8">
                                        {{--  Asset type  --}}
                                        {{--  todo only one should be selectable  --}}
                                        <p>Asset Type</p>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="good" value="option1" name="good" checked="">
                                            <label for="inlineRadio1"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="inlineRadio2" value="option2" name="service">
                                            <label for="inlineRadio2"> Service </label>
                                        </div>
                                        {{--  Asset name  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <input type="text" id="asset_name" name="asset_name" required="required" class="form-control input-lg" placeholder="Asset name">
                                            <i>Give your asset a name</i>
                                        </div>
                                        {{--  Asset Unit  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <select class="select2_demo_3 form-control input-lg">
                                                <option>Select Unit</option>
                                                <option value="Bahamas">Bahamas</option>
                                            </select>
                                        </div>
                                        <label>  </label>
                                        {{--  Asset returnable  --}}
                                        {{--todo description tooltip--}}
                                        <div class="checkbox">

                                            <label for="returnable">
                                                Returnable Asset
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-question-circle"></i></span>
                                            <input id="returnable" name="returnable" type="checkbox">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{--  TODO Thumbnail  --}}
                                    </div>
                                </div>
{{--                                <hr>--}}

                                {{--  Asset information  --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Asset Dimensions  --}}
                                        <label></label>
                                        <input type="text" class="form-control input-lg" data-mask="999999.999999.999999" placeholder="Dimensions (cm)">
                                        <i>(Length X Width X Height)</i>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Asset Weight  --}}
                                        <label></label>
                                        <input type="text" class="form-control input-lg" data-mask="$ 999999" placeholder="Weight (kg)">
                                        <i>(Length X Width X Height)</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Asset Manufacturer  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Select Manufacturer</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Asset Brand  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Select Brand</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>

                                {{--  Sales and purchase information  --}}
                                <h3 class="text-center">SALES AND PURCHASE INFORMATION</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Selling price  --}}
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <input type="text" id="selling_price" name="selling_price" required="required" placeholder="Selling Price" class="form-control input-lg">
                                            <i>Give your asset a price</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Purchase price  --}}
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <input type="text" id="purchase_price" name="purchase_price" required="required" placeholder="Purchase Price" class="form-control input-lg">
                                            <i>Give your asset a price</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Asset selling account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you sell will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Account</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Asset purchase account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <select class="select2_demo_3 form-control input-lg">
                                                    <option>Select Account</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Asset Tax  --}}
                                        <label></label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Select tax</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>

                                </div>
                                <hr>

                                {{--  Inventory information  --}}
                                <h3 class="text-center">INVENTORY INFORMATION</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Inventory account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Account</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Opening stock  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="text" id="opening_stock" name="opening_stock" required="required" class="form-control input-lg" placeholder="Opening Stock">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Opening stock value  --}}
                                        {{--  todo Make KES (currency) dynamic  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Opening stock value refers to the average purchase price of your opening stock. (Per unit in KES)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="text" id="opening_stock_value" name="opening_stock_value" required="required" class="form-control input-lg" placeholder="Opening Stock Value">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Reorder Level  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Reorder level refers to the quantity of an item below which, an item is considered to be low on stock." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="text" id="reorder_level" name="reorder_level" required="required" class="form-control input-lg" placeholder="Reorder Level">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Preferred vendor  --}}
                                        <label></label>
                                        <select id="preferred_vendor" name="preferred_vendor" class="select2_demo_3 form-control input-lg">
                                            <option>Select Preferred Vendor</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <br />

                                <div class="ln_solid"></div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg btn-outline mt-4">{{ __('Save') }}</button>
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

    <!-- Datatables -->
    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

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

    <!-- Page-Level Scripts -->
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
            '.chosen-select-width'     : {width:"100%"}
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


    {{--  Data tables  --}}
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

    </script>

@endsection
