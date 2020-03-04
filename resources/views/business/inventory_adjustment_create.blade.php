@extends('business.layouts.app')

@section('title', 'Create Inventory Adjustment')

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
        <h2>Inventory Adjustment</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.inventory.adjustments',$institution->portal)}}">Inventory Adjustments</a>
            </li>
            <li class="active">
                <strong>Inventory Adjustment Create</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Create Inventory Adjustment</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" action="{{ route('business.inventory.adjustment.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                {{--  Mode of adjustment  --}}
                                {{--  todo only one should be selectable  --}}
                                <p>Mode of adjustment</p>
                                <div class="radio radio-inline">
                                    <input type="radio" id="value" value="value" name="mode_of_adjustment" checked="">
                                    <label for="value"> Value </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="quantity" value="quantity" name="mode_of_adjustment">
                                    <label for="quantity"> Quantity </label>
                                </div>
                                <br>
                                <label>  </label>

                                {{--  Date  --}}
                                <div class="has-warning" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="date" id="date" type="text" class="form-control input-lg" required>
                                    </div>
                                </div>

                                <br>

                                {{--  Account  --}}
                                <div class="has-warning">
                                    <label class="text-danger"></label>
                                    <select name="account"  class="chosen-select form-control input-lg">
                                        <option>Select Account</option>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>  </label>
                                {{--  Reason  --}}
                                <div class="has-warning">
                                    <select name="reason" class="chosen-select form-control input-lg">
                                        <option d>Select Reason</option>
                                        @foreach($reasons as $reason)
                                            <option value="{{$reason->id}}">{{$reason->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>  </label>
                                {{--  Warehouse  --}}
                                <div class="has-warning">
                                    <select onchange = "selectWarehouseToAdjust(this)" onfocus = "this.selectedIndex = 0" name="warehouse"  class="chosen-select form-control input-lg">
                                        <option disabled>Select Warehouse</option>
                                        @foreach($warehouses as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>  </label>
                                {{--  Description  --}}
                                <div class="">
                                    <textarea rows="5" id="description" name="description" required class="form-control input-lg" placeholder="Description"></textarea>
                                    <i>describe the purpose of the inventory adjustment</i>
                                </div>



                            </div>
                            <div class="col-md-4">
                                {{--  TODO Thumbnail  --}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="ibox-title">
                                <h5>Product Details </h5>
                            </div>
                            <div class="ibox-content">

                                <table class="table table-bordered" id = "adjustment_table">
                                    <thead>
                                    <tr>
                                        <th>Product Details</th>
                                        <th width="210px">Stock On Hand</th>
                                        <th width="210px">New Quantity On Hand</th>
                                        <th width="210px">Quantity Adjusted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select onchange = "returnProductDetails(this)" name = "item_details[0][details]" class="chosen-select form-control input-lg item-select">
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}" data-product-quantity="-20">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control input-lg items-on-hand" name = "item_details[0][on_hand]" value = "0" readonly>
                                        </td>
                                        <td>
                                            <input oninput = "modifyItemsOnHand(this)" type="number" class="form-control input-lg items-new-on-hand" name = "item_details[0][new_on_hand]">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control input-lg items-adjusted" placeholder="E.g +10, -10" name = "item_details[0][adjusted]" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
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

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- jQuery Tags Input -->
    <script src="{{ asset('js') }}/tagplug-master/index.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

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

    {{--  Get due date to populate   --}}
    <script>
        $(document).ready(function() {
            // Set date
            // console.log('var');
            var today = new Date();
            // console.log(today);
            var dd = today.getDate();
            var mm = today.getMonth();
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            mm ++;
            if (dd < 10){
                dd = '0'+dd;
            }
            if (mm < 10){
                mm = '0'+mm;
            }
            var date_today = mm + '/' + dd + '/' + yyyy;
            var time_curr = h + ':' + m;
            // console.log(time_curr);
            document.getElementById("date").value = date_today;
            // Populating the products in the warehouse by working with the initial value of the warehouse selection
            selectWarehouseToAdjust(document.getElementsByName("warehouse")[0])
            // Set time
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

        /*$("#ionrange_1").ionRangeSlider({
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
        });*/


    </script>

    {{--  Tag script  --}}
    <script>
        $(document).ready(function() {
            var tagInput = new TagsInput({
                selector: 'tag-input',
                duplicate: false
            });
        });
        var tableValueArrayIndex = 1;
        var selectedWarehouse = null;
        var products = {!! json_encode($products->toArray()) !!};
        var productsArray = [];
        function selectWarehouseToAdjust (e) {
            selectedWarehouse = e.value;
            productsArray = [];
            for (product of products) {
                var productDetails = {};
                var productQuantity = 0;
                if (product["inventory"] !== []) {
                    for (warehouse of product["inventory"]) {
                        if (warehouse["warehouse_id"] === selectedWarehouse) {
                            productQuantity = warehouse["quantity"];
                        };
                    };
                    productDetails = {
                        "product_quantity": productQuantity,
                        "product_name": product["name"],
                        "product_id": product["id"]
                    };
                    productsArray.push(productDetails);
                };
            };
            var productSelect = document.getElementsByClassName("item-select");
            for (singleSelect of productSelect) {
                clearDropdownOptions(singleSelect);
            };
            for (singleSelect of productSelect) {
                populateDropdownOptionsWithProducts(singleSelect);
            };
            e.blur();
        }
        function clearDropdownOptions (selectElement) {
            var numberOfOptions;
            for (numberOfOptions = selectElement.options.length - 1; numberOfOptions >= 0; numberOfOptions--) {
                selectElement.remove(numberOfOptions);
            }
        }
        function populateDropdownOptionsWithProducts (selectElement) {
            for (singleProduct of productsArray) {
                var newOption = document.createElement("option");
                newOption.value = singleProduct["product_id"];
                newOption.innerHTML = singleProduct["product_name"];
                newOption.setAttribute("data-product-quantity", singleProduct["product_quantity"]);
                selectElement.appendChild(newOption);
            }
        }
        // Function to add table rows
        function addTableRow() {
            if (productsArray.length === 0) {
                alert("Please select a warehouse");
            } else {
                var table = document.getElementById("adjustment_table");
                var row = table.insertRow();
                var firstCell = row.insertCell(0);
                var secondCell = row.insertCell(1);
                var thirdCell = row.insertCell(2);
                var fourthCell = row.insertCell(3);
                var fifthCell = row.insertCell(4);
                firstCell.innerHTML = "<select onchange = 'returnProductDetails(this)' class='chosen-select form-control input-lg item-select' name = 'item_details["+tableValueArrayIndex+"][details]'"+
                                        " data-placeholder='Choose an item...' style='width:100%;' tabindex='2' required></select>";
                secondCell.innerHTML = "<input type='number' class='form-control input-lg items-on-hand' name = 'item_details["+tableValueArrayIndex+"][on_hand]' value = '0' readonly>";
                thirdCell.innerHTML = "<input oninput = 'modifyItemsOnHand(this)'' type='number' class='form-control input-lg items-new-on-hand' name = 'item_details["+tableValueArrayIndex+"][new_on_hand]'>";
                fourthCell.innerHTML = "<input type='number' class='form-control input-lg items-adjusted' placeholder='E.g +10, -10' name = 'item_details["+tableValueArrayIndex+"][adjusted]' readonly>";
                fifthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
                var productSelect = document.getElementsByClassName("item-select");
                for (singleSelect of productSelect) {
                    populateDropdownOptionsWithProducts(singleSelect);
                };
                tableValueArrayIndex++;
                initSelector();
            };
        };
        function removeSelectedRow (e) {
            var selectedParentTd = e.parentElement.parentElement;
            var selectedTr = selectedParentTd.parentElement;
            var selectedTable = selectedTr.parentElement;
            var removed = selectedTr.getElementsByClassName("item-select")[0].getAttribute("name");
            adjustTableInputFieldsIndex(removed);
            selectedTable.removeChild(selectedTr);
            tableValueArrayIndex--;
        };
        function adjustTableInputFieldsIndex (removedFieldName) {
            // Fields whose values are submitted are:
            // 1. item_details[][details]
            // 2. item_details[][on_hand]
            // 3. item_details[][new_on_hand]
            // 4. item_details[][adjusted]
            var displacement = 0;
            var removedIndex;
            while (displacement < tableValueArrayIndex) {
                if (removedFieldName == "item_details["+displacement+"][details]"){
                    removedIndex = displacement;
                } else {
                    var detailsField = document.getElementsByName("item_details["+displacement+"][details]");
                    var onHandField = document.getElementsByName("item_details["+displacement+"][on_hand]");
                    var newOnHandField = document.getElementsByName("item_details["+displacement+"][new_on_hand]");
                    var adjustedField = document.getElementsByName("item_details["+displacement+"][adjusted]");
                    if (removedIndex) {
                        if (displacement > removedIndex) {
                            var newIndex = displacement - 1;
                            detailsField[0].setAttribute("name", "item_details["+newIndex+"][details]");
                            onHandField[0].setAttribute("name", "item_details["+newIndex+"][on_hand]");
                            newOnHandField[0].setAttribute("name", "item_details["+newIndex+"][new_on_hand]");
                            adjustedField[0].setAttribute("name", "item_details["+newIndex+"][adjusted]");
                        };
                    };
                };
                displacement++;
            };
        };
        // Function that handles selection of products to be adjusted
        function returnProductDetails (e) {
            var stockValue = e.options[e.selectedIndex].getAttribute("data-product-quantity");
            var selectedParentTd = e.parentElement;
            var selectedTr = selectedParentTd.parentElement;
            setValueOfInputFieldByClassName(selectedTr, "items-on-hand", stockValue);
        };
        // Function triggered whenever value of items on hand is set
        function modifyItemsOnHand (e) {
            var selectedParentTd = e.parentElement;
            var selectedTr = selectedParentTd.parentElement;
            var stockValue = selectedTr.getElementsByClassName("items-on-hand")[0].value;
            var adjustedValue = parseInt(e.value) - parseInt(stockValue);
            setValueOfInputFieldByClassName(selectedTr, "items-adjusted", adjustedValue);
        };
        // Multi-purpose function that handles setting of an input field value given the parentElement
        // and unique className within the element
        function setValueOfInputFieldByClassName (parentElement, targetElementClassName, value) {
            var targetElement = parentElement.getElementsByClassName(targetElementClassName)
            targetElement[0].value = value
        };
        // Makes the products dropdown searchable
        // Necessary to have this function since the elements edded dynamically are not searchable by default
        function initSelector () {
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
        };
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
        $(document).ready(function() {
            $('.select').select2({
                theme: "default"
            })
        });
    </script>
@endsection
