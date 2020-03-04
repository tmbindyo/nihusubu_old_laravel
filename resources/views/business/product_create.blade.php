@extends('business.layouts.app')

@section('title', 'Products')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

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

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">


@endsection
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Products</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li class="active">
                <strong>Products</strong>
            </li>
        </ol>
    </div>
</div>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Products</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="">
                            <form method="post" action="{{ route('business.product.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                    <div class="col-md-8">
                                        {{--  Product type  --}}
                                        {{--  todo only one should be selectable  --}}
                                        <p>Product Type</p>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="goods" value="goods" name="product_type" checked="" onclick = "productTypeSelected(this)">
                                            <label for="goods"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="services" value="services" name="product_type" onclick = "productTypeSelected(this)">
                                            <label for="services"> Service </label>
                                        </div>
                                        {{--  Name  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <input type="text" id="name" name="name" required="required" class="form-control input-lg" placeholder="Name">
                                            <i>name</i>
                                        </div>
                                        {{--  Product Unit  --}}
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label>  </label>
                                                    <select name="unit" data-placeholder="Choose a Country..." class="chosen-select input-lg" style="width:100%;" tabindex="2" required>
                                                        <option value="" selected disabled>Select Unit</option>
                                                        @foreach($units as $unit)
                                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                        @endforeach()
                                                    </select>
                                                </div>
                                                <i>unit</i>
                                            </div>

                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="The item will be measured in terms of this unit (e.g.:kg,dozen,litres)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>

                                        </div>

                                        <br>
                                        {{--  <label>  </label>  --}}
                                        {{--  Product returnable  --}}
                                        {{--todo description tooltip--}}
                                        <div class="checkbox">
                                            <input id="is_returnable" name="is_returnable" type="checkbox">
                                            <label for="is_returnable">
                                                Returnable Product
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-2x fa-question-circle"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{--  TODO Thumbnail  --}}
                                    </div>
                                </div>
                                <br>
                                {{--  Description  --}}
                                <textarea id="summernote" class="summernote" name="description">
                                    <h3>Sample description format</h3>
                                        dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry</strong> standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                        <br/>
                                        <br/>
                                        <ul>
                                            <li>Remaining essentially unchanged</li>
                                            <li>Make a type specimen book</li>
                                            <li>Unknown printer</li>
                                        </ul>
                                </textarea>
                                <hr>

                                {{--  Sales and purchase information  --}}
                                <h3 class="text-center">SALES AND PURCHASE INFORMATION</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="text-center">SALES INFORMATION</h4>
                                        {{--  Product purchase account  --}}
                                        <div class="row">

                                            <div class="col-md-11">
                                                <label></label>
                                                <select name="selling_account" data-placeholder="Choose a Country..." class="chosen-select input-lg" style="width:100%;" tabindex="2" required>
                                                    <option value="" selected disabled>Select Selling Account</option>
                                                    @foreach($salesAccounts as $account)
                                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                                    @endforeach()
                                                </select>
                                                <i>selling account</i>
                                            </div>
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-center">PURCHASE INFORMATION</h4>
                                        {{--  Product selling account  --}}
                                        <div class="row">

                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select name="purchase_account" data-placeholder="Choose a Country..." class="chosen-select input-lg" style="width:100%;" tabindex="2" required>
                                                        <option value="" selected disabled>Select Purchase Account</option>

                                                        <optgroup label="Exepense">
                                                            @foreach($expenseAccounts as $account)
                                                                <option value="{{$account->id}}">{{$account->name}}</option>
                                                            @endforeach()
                                                        </optgroup>

                                                        <optgroup label="Costs Of Goods Sold">
                                                            @foreach($costOfGoodsSoldAccounts as $account)
                                                                <option value="{{$account->id}}">{{$account->name}}</option>
                                                            @endforeach()
                                                        </optgroup>

                                                    </select>
                                                    <i>purchase account</i>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Selling price  --}}
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <input type="text" id="selling_price" name="selling_price" required="required" placeholder="Selling Price" class="form-control input-lg">
                                            <i>selling price</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Purchase price  --}}
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <input type="text" id="purchase_price" name="purchase_price" required="required" placeholder="Purchase Price" class="form-control input-lg">
                                            <i>purchase price</i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product Tax  --}}
                                        <label></label>
                                        <select name="taxes[]" data-placeholder="Select Taxes" class="chosen-select input-lg" multiple style="width:100%;" tabindex="2">
                                            @foreach($taxes as $tax)
                                                <option value="{{$tax->id}}">{{$tax->name}}[{{$tax->amount}}@if($tax->is_percentage == True)%@endif]</option>
                                            @endforeach()
                                        </select>
                                        <i>taxes</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-info">
                                            <input id="is_created" name="is_created" type="checkbox">
                                            <label for="is_created">
                                                Product Manufactured/Created
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the product is manufactured, created or a period of time is used by this business to add value to it." class="fa fa-2x fa-question-circle"></i></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" id="creation_time" name="creation_time" placeholder="Creation/Value addition time" class="form-control input-lg">
                                        <i>Average time taken to manufacture/create or add value to it in minutes.</i>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" id="creation_cost" name="creation_cost" placeholder="Average Creation/Value Addition cost" class="form-control input-lg">
                                        <i>Average cost of manufacturing/creation or value addition process. Include items acquired and cost of time.</i>
                                    </div>
                                </div>
                                <hr>

                                {{--  Inventory information  --}}
                                <h3 class="text-center" name = "inventory_information_header">INVENTORY INFORMATION</h3>
                                <div class="row" name = "inventory_information_label">
                                    <div class="col-md-6">
                                        {{--  Inventory account  --}}
                                        <div class="row">

                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select name="inventory_account" name="inventory_account" data-placeholder="Select Inventory Account" class="chosen-select inventory-account-chosen input-lg" style="width:100%;" tabindex="2">
                                                        <option value="" selected disabled>Select Inventory Account</option>
                                                        @foreach($stockAccounts as $account)
                                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach()
                                                    </select>
                                                </div>
                                                <i>inventory account</i>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="row" name = "inventory_information">
                                    <div class="col-md-6">
                                        {{--  Opening stock  --}}
                                        <div class="row">

                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="number" id="opening_stock" name="opening_stock" required="required" class="form-control input-lg inventory" placeholder="Opening Stock">
                                                <i>opening stock</i>
                                            </div>
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Opening stock value  --}}
                                        {{--  todo Make KES (currency) dynamic  --}}
                                        <div class="row">

                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="number" id="opening_stock_value" name="opening_stock_value" required="required" class="form-control input-lg inventory" placeholder="Opening Stock Value">
                                                <i>opening stock value</i>
                                            </div>
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Opening stock value refers to the average purchase price of your opening stock. (Per unit in KES)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" name = "inventory_information">
                                    <div class="col-md-6">
                                        {{--  Reorder Level  --}}
                                        <div class="row">

                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="number" id="reorder_level" name="reorder_level" required="required" class="form-control input-lg inventory" placeholder="Reorder Level">
                                                <i>reorder level</i>
                                            </div>
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Reorder level refers to the quantity of an item below which, an item is considered to be low on stock." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

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

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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

    {{--  <!-- Date range use moment.js same as full calendar plugin -->  --}}
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

        });
        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };
    </script>

    <script>
        function productTypeSelected (e) {
            if (e.value === "goods") {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (input of parent.getElementsByTagName("input")){
                        // Removing the readonly attribute
                        input.removeAttribute("readonly", true)
                    }
                }
                // Enabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.removeAttribute("disabled", true)
                // Instance of chosen on the select element
                $(".inventory-account-chosen").chosen(
                    {allow_single_deselect:true},
                    {disable_search_threshold:10},
                    {no_results_text:'Oops, nothing found!'},
                    {width:"95%"}
                );
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION"
            } else if (e.value === "services") {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (inputElement of parent.getElementsByTagName("input")){
                        // Setting each element to readonly
                        inputElement.setAttribute("readonly", true)
                    }
                }
                // Destroying the instance of chosen that was making it hard to disable the inventory account select element
                $(".inventory-account-chosen").chosen("destroy");
                // Disabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.setAttribute("disabled", true)
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION (Not Applicable for a Service)"
            }
        }
    
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
