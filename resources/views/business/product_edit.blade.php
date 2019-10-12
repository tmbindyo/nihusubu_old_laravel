@extends('business.layouts.app')

@section('title', 'Product Edit')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

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

    <link href="{{ asset('inspinia') }}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@include('business.layouts.modals.product_discount_create')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Product Edit</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.products')}}">Products</a>
            </li>
            <li class="active">
                <strong>Product Edit</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">

        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"> Data</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3"> Discount</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-lg" value="{{$product->name}}" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Price:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-lg" value="{{$product->selling_price}}" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                    <div class="col-sm-10">
                                        <textarea id="summernote" class="summernote" name="description">
                                            {!! $product->description !!}
                                        </textarea>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">

                            <fieldset class="form-horizontal">
                                <div class="form-group"><label class="col-sm-2 control-label">Tax Class:</label>
                                    <div class="col-sm-10">
                                        <select name="taxes[]" data-placeholder="Select Taxes" class="chosen-select input-lg" multiple style="width:100%;" tabindex="2">
                                            @foreach($taxes as $tax)
                                                <option value="{{$tax->id}}">{{$tax->name}}[{{$tax->amount}}@if($tax->is_percentage == True)%@endif]</option>
                                            @endforeach()
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Unit:</label>
                                    <div class="col-sm-10">
                                        <select name="unit" data-placeholder="Choose a Country..." class="chosen-select input-lg" style="width:100%;" tabindex="2" required>
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach()
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Minimum quantity:</label>
                                    <div class="col-sm-10">
                                        <select class="select2_demo_3 form-control">
                                            <option></option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Sort order:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-lg" placeholder="0">
                                    </div>
                                </div>
                            </fieldset>


                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="pull-right">
                                    <button data-toggle="modal" data-target="#productDiscountRegistration" aria-expanded="false" class="btn btn-outline btn-primary"> <span class="fa fa-plus"></span> Add Discount</button>
                                </div>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered">

                                    <thead>
                                    <tr>
                                        <th>
                                            Group
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Discount
                                        </th>
                                        <th style="width: 20%">
                                            Date start
                                        </th>
                                        <th style="width: 20%">
                                            Date end
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->product_taxes as $discount)
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="{{$discount->quantity}}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="{{$discount->discount}}">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" value="{{$discount->start_date}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" value="{{$discount->end_date}}">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning"><i class="fa fa-pencil"></i> </button>
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                    <tr>
                                        <th>
                                            Image preview
                                        </th>
                                        <th>
                                            Sort order
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/2s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/1s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="2">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/3s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="3">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/4s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="4">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/5s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="5">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/6s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="6">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('inspinia') }}/img/gallery/7s.jpg">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="7">
                                        </td>
                                        <td>
                                            <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
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

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

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

<!-- SUMMERNOTE -->
<script src="{{ asset('inspinia') }}/js/plugins/summernote/summernote.min.js"></script>

<script>
    $(document).ready(function(){

        $('.summernote').summernote();

        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
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
