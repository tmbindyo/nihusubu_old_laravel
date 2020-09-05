@extends('business.layouts.app')

@section('title', 'Item '.$item->name.' Edit')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Item {{$item->name}} Edit</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('business.calendar',$institution->portal)}}">Home</a></strong>
                </li>
                <li class="active">
                    <strong><a href="{{route('business.items',$institution->portal)}}">Items</a></strong>
                </li>
                <li class="active">
                    <strong><a href="{{route('business.items',$institution->portal)}}">Item {{$item->name}} Edit</a></strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Item {{$item->name}} <small>Edit</small></h5>
                </div>
                <div class="ibox-content">

                    <div class="">
                        <form method="post" enctype="multipart/form-data" action="{{ route('business.item.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
{{--                            <br>--}}
                            {{--  Item  --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="has-warning">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <input type="text" id="name" name="name" value="{{ $item->name }}" required class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                                        <i>name</i>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="has-warning">
                                        @if ($errors->has('unit'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('unit') }}</strong>
                                                    </span>
                                        @endif
                                        <select name="unit" class="select2_unit form-control input-lg {{ $errors->has('unit') ? ' is-invalid' : '' }}" required>
                                            <option></option>
                                            @foreach($units as $unit)
                                                <option @if($item->unit_id == $unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach()
                                        </select>
                                        <i>unit</i> <span><i data-toggle="tooltip" data-placement="right" title="The item will be measured in terms of this unit (e.g.:kg,dozen,litres)" class="fa fa-question-circle fa-x text-warning"></i></span>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">

                                <div class="col-md-6">
                                    {{--  Product selling account  --}}
                                    <div class="has-warning">
                                        @if ($errors->has('purchase_account'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('purchase_account') }}</strong>
                                            </span>
                                        @endif
                                        <select name="purchase_account" class="select2_purchase_account form-control input-lg {{ $errors->has('purchase_account') ? ' is-invalid' : '' }}" required>
                                            <option></option>
                                            <optgroup label="Exepense">
                                                @foreach($expenseAccounts as $account)
                                                    <option @if($item->purchase_account_id == $account->id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                @endforeach()
                                            </optgroup>

                                            <optgroup label="Costs Of Goods Sold">
                                                @foreach($costOfGoodsSoldAccounts as $account)
                                                    <option @if($item->purchase_account_id == $account->id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                @endforeach()
                                            </optgroup>

                                        </select>
                                        <i>purchase account</i> <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-x text-warning"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{--  Purchase price  --}}
                                    @if ($errors->has('purchase_price'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('purchase_price') }}</strong>
                                        </span>
                                    @endif
                                    <div class="has-warning">
                                        <input type="number" id="purchase_price" name="purchase_price" value="{{ $item->purchase_price }}" required="required" placeholder="Purchase Price" class="form-control input-lg {{ $errors->has('purchase_price') ? ' is-invalid' : '' }}">
                                        <i>purchase price</i>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <hr>

                            {{--  Inventory information  --}}
                            <h3 class="text-center" name = "inventory_information_header">INVENTORY INFORMATION</h3>
                            <br>
                            <div class="checkbox checkbox-primary">
                                <input id="is_inventory" name="is_inventory" type="checkbox" @if($item->is_inventory) checked="checked" @endif onclick="notInventory(this)" class="{{ $errors->has('is_inventory') ? ' is-invalid' : '' }}" disabled>
                                <label for="is_inventory">
                                    Track Inventory for this item
                                </label>
                                <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the product is manufactured, created or a period of time is used by this business to add value to it." class="fa fa-2x fa-question-circle"></i></span>
                            </div>
                            <br>
                            <div class="row" name = "inventory_information_label">
                                <div class="col-md-6">
                                    {{--  Inventory account  --}}
                                    @if ($errors->has('inventory_account'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('inventory_account') }}</strong>
                                        </span>
                                    @endif
                                    <div class="has-warning">
                                        <select name="inventory_account" name="inventory_account"  class="select2_inventory_account form-control input-lg {{ $errors->has('inventory_account') ? ' is-invalid' : '' }}" required>
                                            <option></option>
                                            @foreach($stockAccounts as $account)
                                                <option @if($item->inventory_account_id == $account->id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                            @endforeach()
                                        </select>
                                        <i>inventory account</i> <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-x text-warning"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{--  Reorder Level  --}}
                                    <div class="row">
                                        @if ($errors->has('reorder_level'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('reorder_level') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-12">
                                            <input type="number" id="reorder_level" name="reorder_level" value="{{ $item->reorder_level }}" required="required" class="form-control input-lg inventory  {{ $errors->has('reorder_level') ? ' is-invalid' : '' }}" placeholder="Reorder Level">
                                            <i>reorder level</i> <span><i data-toggle="tooltip" data-placement="right" title="Reorder level refers to the quantity of an item below which, an item is considered to be low on stock." class="fa fa-question-circle fa-x text-warning"></i></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" name = "inventory_information">
                                <div class="col-md-6">
                                    {{--  Opening stock  --}}
                                    <div class="row">
                                        @if ($errors->has('opening_stock'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('opening_stock') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-12">
                                            <input type="number" id="opening_stock" name="opening_stock" value="{{ $item->opening_stock }}" required="required" class="form-control input-lg inventory {{ $errors->has('opening_stock') ? ' is-invalid' : '' }}" placeholder="Opening Stock">
                                            <i>opening stock</i> <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-question-circle fa-x text-warning"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{--  Opening stock value  --}}
                                    {{--  todo Make KES (currency) dynamic  --}}
                                    <div class="row">
                                        @if ($errors->has('opening_stock_value'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('opening_stock_value') }}</strong>
                                            </span>
                                        @endif
                                        <div class="col-md-12">
                                            <input type="number" id="opening_stock_value" name="opening_stock_value" value="{{ $item->opening_stock_value }}" required="required" class="form-control input-lg inventory {{ $errors->has('opening_stock_value') ? ' is-invalid' : '' }}" placeholder="Opening Stock Value">
                                            <i>opening stock value</i> <span><i data-toggle="tooltip" data-placement="right" title="Opening stock value refers to the average purchase price of your opening stock. (Per unit in KES)" class="fa fa-question-circle fa-x text-warning"></i></span>
                                        </div>

                                    </div>
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

    <!-- DROPZONE -->
    <script src="{{ asset('inspinia') }}/js/plugins/dropzone/dropzone.js"></script>

    {{-- FILEINPUT --}}
    <script src="{{ asset('inspinia') }}/js/plugins/fileinput/fileinput.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/fileinput/theme.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/popper/popper.min.js"></script>

    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/image-view",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
    </script>

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
        $(document).ready(function() {

            $('.enableCreationInformation').on('click',function(){
                if (document.getElementById('is_created').checked) {
                    // enable end_time input
                    document.getElementById("creation_time").disabled = false;
                    document.getElementById("creation_cost").disabled = false;
                } else {
                    // disable input
                    document.getElementById("creation_time").disabled = true;
                    document.getElementById("creation_cost").disabled = true;
                }
            });


        });

    </script>

    <script>
        $(document).ready(function(){
            Dropzone.options.myDropzone= {
                url: 'upload.php',
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 12,
                maxFilesize: 3,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                init: function() {
                    dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

                    // for Dropzone to process the queue (instead of default form behavior):
                    document.getElementById("submit-all").addEventListener("click", function(e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        dzClosure.processQueue();
                    });

                    //send all the form data along with the files:
                    this.on("sendingmultiple", function(data, xhr, formData) {
                        formData.append("firstname", jQuery("#firstname").val());
                        formData.append("lastname", jQuery("#lastname").val());
                    });
                }
            }
        });
    </script>


    <script>
        function notInventory (e) {
            console.log("e.value")
            console.log(e)
            if (e.checked == true) {
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
                // reorder level
                document.getElementById("reorder_level").disabled = false;
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION"
            } else if (e.checked == false) {
                // Getting the parent container
                var invInformationSection = document.getElementsByName("inventory_information")
                // Getting each element in the parent that's an input field
                for (parent of invInformationSection){
                    for (inputElement of parent.getElementsByTagName("input")){
                        // Setting each element to readonly
                        inputElement.setAttribute("readonly", true)
                    }
                }
                // reorder level
                document.getElementById("reorder_level").disabled = true;
                // Destroying the instance of chosen that was making it hard to disable the inventory account select element
                $(".inventory-account-chosen").chosen("destroy");
                // Disabling the select element
                var invInformationSectionLabel = document.getElementsByName("inventory_account")[0]
                invInformationSectionLabel.setAttribute("disabled", true)
                // Changing the inventory information section heading
                var inventoryHeading = document.getElementsByName("inventory_information_header")[0]
                inventoryHeading.innerHTML = "INVENTORY INFORMATION (Not tracking for this product)"
            }
        }

    </script>

    <script>
        $(document).ready(function(){

            $(".select2_unit").select2({
                placeholder: "Select Unit",
                allowClear: true
            });

            $(".select2_brand").select2({
                placeholder: "Select Brand",
                allowClear: true
            });

            $(".select2_selling_account").select2({
                placeholder: "Select Selling Account",
                allowClear: true
            });

            $(".select2_product_sub_category").select2({
                placeholder: "Select Product Sub Category",
                allowClear: true
            });

            $(".select2_purchase_account").select2({
                placeholder: "Select Purchase Account",
                allowClear: true
            });

            $(".select2_taxes").select2({
                placeholder: "Select Taxes",
                allowClear: true
            });

            $('.tax_method-select').select2({
                theme: "default",
                placeholder: "Select tax method",
            });

            $(".select2_inventory_account").select2({
                placeholder: "Select Inventory Account",
                allowClear: true
            });

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
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
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
            $(".select2_unit").select2({
                placeholder: "Select Unit",
                allowClear: true
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

        $(".select2").select2();

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

    </script>


@endsection
