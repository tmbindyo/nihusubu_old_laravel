@extends('business.layouts.app')

@section('title', 'Transfer Order Create')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Transfer Order</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.warehouses',$institution->portal)}}">Inventory</a>
            </li>
            <li>
                <a href="{{route('business.transfer.orders',$institution->portal)}}">Transfer Orders</a>
            </li>
            <li class="active">
                <strong>Transfer Order Create</strong>
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
                <h5>Create Transfer Order</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" action="{{ route('business.transfer.order.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                            <div class="col-md-6">
                                {{--  Mode of adjustment  --}}
                                <div class="has-warning" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i></span>
                                        <input type="text" name="date" id="date" class="form-control input-lg">
                                    </div>
                                    <i>date</i>
                                </div>
                                <label>  </label>
                                {{--  Reason  --}}
                                <div class="has-warning">
                                    <textarea rows="5" name="reason" required class="select form-control input-lg" placeholder="Reason"></textarea>
                                    <i>description</i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{--  TODO Thumbnail  --}}
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="has-warning">
                                    <select onchange = "returnWarehouseDetails(this)" onfocus = "this.selectedIndex = 0" name="source_warehouse" class="select2 form-control input-lg">
                                        <option disabled>Select Source Warehouse</option>
                                        @foreach($warehouses as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                    </select>
                                    <i>source warehouse</i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="has-warning">
                                    <select onchange = "destinationwarehouseSelected(this)" onfocus = "this.selectedIndex = 0" name="destination_warehouse" class="select2 form-control input-lg">
                                        <option disabled>Select Destination Warehouse</option>
                                        @foreach($warehouses as $warehouse)
                                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                    </select>
                                    <i>destination warehouse</i>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="ibox-title">
                                <h5>Transfer Details </h5>
                            </div>
                            <div class="ibox-content">

                                <table class="table table-bordered" id = "transfer_order_table">
                                    <thead>
                                    <tr>
                                        <th>Item Details</th>
                                        <th width="240px">Current Availability</th>
                                        <th width="180px">Transfer Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select onchange = "returnProductDetails(this)" class="select2 form-control input-lg items-select" name = "item_details[0][product_id]" style = "width: 100%">
                                                <option>Select Item</option>
                                                {{-- <option value="Bahamas">Bahamas</option> --}}
                                                @foreach($products as $product)
                                                    <option value = "{{$product->id}}" data-product-source-quantity = "-20" data-product-destination-quantity = "-20">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <small class="control-label" for="quantity">Source Stock</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <small class="col-form-label-sm" >Destination Stock</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-center source_stock_value" for="quantity">0</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="col-form-label-sm text-center destination_stock_value">0</p>
                                                </div>
                                            </div>
{{--                                            <input type="number" class="form-control input-lg">--}}
                                        </td>
                                        <td>
                                            <input type="number" class="form-control input-lg transfer_quantity" placeholder="E.g +10, -10" name = "item_details[0][transfer_quantity]">
                                        </td>
                                        {{-- <td width="10px">
                                            <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-times-circle fa-2x text-danger"></i></span>
                                        </td> --}}
                                    </tr>
                                    </tbody>
                                </table>
                                <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
                            </div>
                        </div>

                        <hr>

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
            {{-- console.log('var'); --}}
            var today = new Date();
            {{-- console.log(today); --}}
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
            {{-- console.log(time_curr); --}}
            document.getElementById("date").value = date_today;
            // Populating the products' details by working with the initial value of the warehouse selection
            returnWarehouseDetails(document.getElementsByName("source_warehouse")[0])
            destinationwarehouseSelected(document.getElementsByName("destination_warehouse")[0])
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
        
        $(".select2").select2();

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

    <script>
        // productsArray populates options of select element
        var productsArray = [];
        // Get all products returned and prepare for manipulation
        var products = {!! json_encode($products->toArray()) !!};
        var sourceWarehouseId = "";
        var destinationWarehouseId = "";
        function returnWarehouseDetails (e) {
            sourceWarehouseId = e.value;
            // Get all product dropdowns
            var productSelect = document.getElementsByClassName("items-select");
            // Clear all options from the dropdown
            for (singleSelect of productSelect) {
                clearDropdownOptions(singleSelect);
            };
            e.blur();
        }
        function destinationwarehouseSelected (e) {
            // Sets this to an empty array when the source warehouse is changed
            productsArray = [];
            destinationWarehouseId = e.value;
            // TODO: Have this as a notification somewhere on the UI
            if (destinationWarehouseId === sourceWarehouseId) {
                console.log("The source and the destination are the same.")
            }
            var productDetails = {};
            var sourceWarehouseProductQuantity = 0;
            var destinationWarehouseProductQuantity = 0;
            for (product of products) {
                for (warehouse of product["inventory"]) {
                    // Comparison with selected source warehouse
                    if (warehouse["warehouse_id"] === sourceWarehouseId) {
                        sourceWarehouseProductQuantity = warehouse["quantity"];
                    }
                    // Comparison with selected destination warehouse
                    if (warehouse["warehouse_id"] === destinationWarehouseId) {
                        destinationWarehouseProductQuantity = warehouse["quantity"];
                    }
                }
                productDetails = {
                    "product_quantity_source": sourceWarehouseProductQuantity,
                    "product_quantity_destination": destinationWarehouseProductQuantity,
                    "product_name": product["name"],
                    "product_id": product["id"]
                };
                productsArray.push(productDetails);
            };
            // Get all product dropdowns
            var productSelect = document.getElementsByClassName("items-select");
            // Clear all options from the dropdown
            for (singleSelect of productSelect) {
                clearDropdownOptions(singleSelect);
            };
            // Add options to dropdown
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
                newOption.setAttribute("data-product-source-quantity", singleProduct["product_quantity_source"]);
                newOption.setAttribute("data-product-destination-quantity", singleProduct["product_quantity_destination"]);
                selectElement.appendChild(newOption);
            }
        }
        function returnProductDetails (e) {
            var sourceQuantity = e.options[e.selectedIndex].getAttribute("data-product-source-quantity");
            var destinationQuantity = e.options[e.selectedIndex].getAttribute("data-product-destination-quantity");
            var selectedParentTd = e.parentElement;
            var selectedTr = selectedParentTd.parentElement;
            var transferQuantityInputField = selectedTr.getElementsByClassName("transfer_quantity");
            var sourceStockLabel = selectedTr.getElementsByClassName("source_stock_value");
            var destinationStockLabel = selectedTr.getElementsByClassName("destination_stock_value");
            // Setting the minimum and maximum allowable values for the transfer quantity input field
            transferQuantityInputField[0].setAttribute("min", 1);
            transferQuantityInputField[0].setAttribute("max", sourceQuantity);
            // Setting values of labels
            sourceStockLabel[0].innerHTML = sourceQuantity;
            destinationStockLabel[0].innerHTML = destinationQuantity;
        }
        var tableValueArrayIndex = 1;
        function addTableRow () {
            if (productsArray.length === 0) {
                alert("Please select a source and destination warehouse.")
            } else {
                var table = document.getElementById("transfer_order_table");
                var row = table.insertRow();
                var firstCell = row.insertCell(0);
                var secondCell = row.insertCell(1);
                var thirdCell = row.insertCell(2);
                var fourthCell = row.insertCell(3)
                firstCell.innerHTML = "<select onchange = 'returnProductDetails(this)' class='select2 form-control input-lg items-select'"+
                                        "name = 'item_details["+tableValueArrayIndex+"][product_id]' style = 'width: 100%'></select>";
                secondCell.innerHTML = "<div class='row'>"+
                                        "<div class='col-md-6'>"+
                                        "<small class='control-label'>Source Stock</small>"+
                                        "</div>"+
                                        "<div class='col-md-6'>"+
                                        "<small class='col-form-label-sm'>Destination Stock</small>"+
                                        "</div>"+
                                        "</div>"+
                                        "<div class='row'>"+
                                        "<div class='col-md-6'>"+
                                        "<p class='text-center source_stock_value'>0</p>"+
                                        "</div>"+
                                        "<div class='col-md-6'>"+
                                        "<p class='col-form-label-sm text-center destination_stock_value'>0</p>"+
                                        "</div>"+
                                        "</div>";
                thirdCell.innerHTML = "<input type='number' class='form-control input-lg transfer_quantity' placeholder='E.g +10, -10'"+
                                        "name = 'item_details["+tableValueArrayIndex+"][transfer_quantity]'>";
                fourthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
                fourthCell.setAttribute("style", "width: 1em;")
                var selectElement = row.getElementsByClassName("items-select");
                populateDropdownOptionsWithProducts(selectElement[0]);
                tableValueArrayIndex++;

                $(".select2").select2();
            };
        };
        function removeSelectedRow (e) {
            var selectedParentTd = e.parentElement.parentElement;
            var selectedTr = selectedParentTd.parentElement;
            var selectedTable = selectedTr.parentElement;
            var removed = selectedTr.getElementsByClassName("items-select")[0].getAttribute("name");
            adjustTableInputFieldsIndex(removed);
            selectedTable.removeChild(selectedTr);
            tableValueArrayIndex--;
        };
        function adjustTableInputFieldsIndex (removedFieldName) {
            // Fields whose values are submitted are:
            // 1. item_details[][product_id]
            // 2. item_details[][transfer_quantity]
            var displacement = 0;
            var removedIndex;
            while (displacement < tableValueArrayIndex) {
                if (removedFieldName == "item_details["+displacement+"][product_id]"){
                    removedIndex = displacement;
                } else {
                    var productIdField = document.getElementsByName("item_details["+displacement+"][product_id]");
                    var transferQuantityField = document.getElementsByName("item_details["+displacement+"][transfer_quantity]");
                    if (removedIndex) {
                        if (displacement > removedIndex) {
                            var newIndex = displacement - 1;
                            productIdField[0].setAttribute("name", "item_details["+newIndex+"][product_id]");
                            transferQuantityField[0].setAttribute("name", "item_details["+newIndex+"][transfer_quantity]");
                        };
                    };
                };
                displacement++;
            };
        };
    </script>
@endsection
