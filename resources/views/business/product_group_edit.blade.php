@extends('business.layouts.app')

@section('title', 'Create Product Group')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Product Groups</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.products',$institution->portal)}}">Products</a>
                </li>
                <li>
                    <a href="{{route('business.product.groups',$institution->portal)}}">Product Groups</a>
                </li>
                <li class="active">
                    <strong>Product Group Edit</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Product Groups</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="">
                    <form method="post" action="{{ route('business.product.group.update',['portal'=>$institution->portal,'id'=>$productGroup->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                <p>Product Type</p>
                                <div class="radio radio-inline">
                                    <input type="radio" id="goods" value="goods" name="product_type" @if($productGroup->is_service == 0) checked @endif>
                                    <label for="goods"> Goods </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="services" value="services" name="product_type" @if($productGroup->is_service == 1) checked @endif>
                                    <label for="services"> Service </label>
                                </div>

                                <br>
                                <label>  </label>
                                {{--  Product group name  --}}
                                <div class="has-warning">
                                    <input type="text" id="product_name" name="product_name" required="required" class="form-control input-lg" value="{{$productGroup->name}}">
                                    <i>name</i>
                                </div>
                                <br>
                                {{--  Product Unit  --}}
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <label>  </label>
                                            <select name="unit" class="select form-control input-lg" required>
                                                <option value="" selected disabled>Select Unit</option>
                                                @foreach($units as $unit)
                                                    <option @if ($unit->id == $productGroup->unit_id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                                @endforeach()
                                            </select>
                                            <i>unit</i>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label></label>
                                        <span><i data-toggle="tooltip" data-placement="right" title="The item will be measured in terms of this unit (e.g.:kg,dozen,litres)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                </div>
                                <br>
                                {{--  Product returnable  --}}
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
                            {!! $productGroup->description!!}
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
                                        <select name="selling_account" class="select form-control input-lg" required>
                                            <option value="" selected disabled>Select Selling Account</option>
                                            @foreach($salesAccounts as $account)
                                                <option @if($account->id == $productGroup->selling_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
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
                                            <select name="purchase_account" class="select form-control input-lg" required>
                                                <option value="" selected disabled>Select Purchase Account</option>

                                                <optgroup label="Exepense">
                                                    @foreach($expenseAccounts as $account)
                                                        <option @if($account->id == $productGroup->purchase_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                    @endforeach()
                                                </optgroup>

                                                <optgroup label="Costs Of Goods Sold">
                                                    @foreach($costOfGoodsSoldAccounts as $account)
                                                        <option @if($account->id == $productGroup->purchase_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
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
                        <br>
                        {{--  Inventory information  --}}
                        <div class="row">
                            <div class="col-md-6">
                                {{--  Product Tax  --}}
                                <label></label>
                                <select name="taxes[]" class="taxes-select form-control input-lg" multiple="multiple">
                                    <option value="" disabled>Select Taxes</option>
                                    @foreach($taxes as $tax)
                                        @foreach($productGroup->product_group_taxes as $productTax)
                                            <option @if($productTax->tax_id == $tax->id) selected @endif value="{{$tax->id}}">{{$tax->name}}[{{$tax->amount}}@if($tax->is_percentage == True)%@endif]</option>
                                        @endforeach()
                                    @endforeach()
                                </select>
                                <i>taxes</i>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox checkbox-info">
                                    <input id="is_created" name="is_created" type="checkbox" @if($productGroup->is_created == 1)checked @endif >
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
                                <input type="number" id="creation_time" name="creation_time" required="required" value="{{$productGroup->creation_time}}" class="form-control input-lg">
                                <i>Average time taken to manufacture/create or add value to it in minutes.</i>
                            </div>
                            <div class="col-md-6">
                                <input type="number" id="creation_cost" name="creation_cost" required="required" value="{{$productGroup->creation_cost}}" class="form-control input-lg">
                                <i>Average cost of manufacturing/creation or value addition process. Include items acquired and cost of time.</i>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3 class="text-center">INVENTORY INFORMATION</h3>
                        <div class="row">
                            <div class="col-md-6">
                                {{--  Inventory account  --}}
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <select name="inventory_account" class="select form-control input-lg">
                                                <option value="" disabled>Select Inventory Account</option>
                                                @foreach($stockAccounts as $account)
                                                    <option @if($account->id == $productGroup->inventory_account_id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                @endforeach()
                                            </select>
                                            <i>inventory account</i>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="text-danger"></label>
                                        <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3 class="text-center">PRODUCTS</h3>
                        <br>
                        {{-- <hr> --}}
                        {{-- <div class="row" id="product_group_attribute">
                            <div class="col-md-6"> --}}
                                {{--  Product Group attribute  --}}
                                {{-- <div class="row"> --}}
{{--                                    <label class="text-danger">Attribute</label>--}}
                                    {{-- <div class="col-md-1">
                                        <span><i data-toggle="tooltip" data-placement="right" title="Attributes for the product groups, can be a range of different colors of one product, or sizes. " class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <input type="text" name="attribute[]" class="form-control input-lg" placeholder="Attributes e.g Color" required>
                                        </div>
                                    </div>
                                </div>

                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="row"> --}}
                                    {{--                                    <label class="text-danger">Attribute</label>--}}
                                    {{-- <div class="col-md-1">
                                        <span><i data-toggle="tooltip" data-placement="right" title="Attributes options, if the attribute is color, we can have a black, blue, green, white or grey variation of the same product." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="has-warning">
                                            <input type="text" name="attribute_options[]" class="form-control input-lg" id="tag-input" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <table class = "table" id = "attributes_master">
                            <tbody id = "attributes_master_tbody">
                                <tr>
                                    <td style = "width: 50%">
                                        <div class="has-warning">
                                            <input type="text" name="attribute[]" class="form-control input-lg" value="{{$productGroup->attributes}}" required>
                                            <br>
                                            <i>attributes</i>
                                        </div>
                                    </td>
                                    <td style = "width: 50%">
                                        <div class="has-warning">
                                            <input type="text" value="{{$productAttributes}}" name="attribute_options[]" class="form-control input-lg" id="tag-input" required >
                                            <i>attribute options</i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>

                        <div class="ln_solid"></div>

                        <table class="table table-bordered" id = "attribute_table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Opening Stock</th>
                                    <th>Opening Stock Value</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Reorder Level</th>
                                </tr>
                            </thead>
                            <tbody id = "attribute_tbody">
                                @php
                                    $itemIndex = 0;
                                @endphp

                                @foreach ($productGroup->products as $product)
                                    <tr class="gradeA">
                                        <td><input type = 'text' class = 'form-control input-md' name = products[{{$itemIndex}}][name] value = "{{$product->name}}"</td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][opening_stock] value = "{{$product->opening_stock}}"></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][opening_stock_value] value = "{{$product->opening_stock_value}}"></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][purchase_price] value = "{{$product->purchase_price}}"></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][selling_price] value = "{{$product->selling_price}}"></td>
                                        <td><input type = 'number' class = 'form-control input-md' name = products[{{$itemIndex}}][reorder_level] value = "{{$product->reorder_level}}"></td>
                                    </tr>
                                    @php
                                        $itemIndex ++;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>

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

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

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

    <!-- jQuery Tags Input -->
    <!-- <script src="{{ asset('js') }}/tagplug-master/index.js"></script> -->

    <script src="{{ asset('js') }}/choices.min.js"></script>

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



    {{--  Tag script  --}}
    <script>
        // https://github.com/jshjohnson/Choices
        var productName = document.getElementById("product_name")
        var tagField = document.getElementById("tag-input");
        var tagsChoices = new Choices(tagField, {
            delimiter: ',',
            editItems: true,
            removeItems: true,
            removeItemButton: true,
            duplicateItemsAllowed: false
        });
        // Event handler for adding items
        tagField.addEventListener("addItem", function (event) {
            modifyAttrTable(event.detail, true)
        });
        // Event handler for removing items
        tagField.addEventListener("removeItem", function (event) {
            // This is the only reliable way to remove an element from the store of items in the list...so far
            // console.log(tagsChoices._store.items)
            var itemIndex = event.detail.id - 1 // Item IDs start from 1 rather than 0, hence the need to subtract
            tagsChoices._store.items.splice(itemIndex, 1)
            modifyAttrTable(event.detail, false)
        });
        // Function responsible for propulating the attributes list table whenever a change is made
        function modifyAttrTable (tagItem, addItem) {
            var tableBody = document.getElementById("attribute_tbody")
            var itemIndex = tagItem.id - 1 // See explanation in tagField.addEventListener("addItem")
            if (addItem === true) {
                var row = tableBody.insertRow(itemIndex)
                var first_cell = row.insertCell(0)
                var second_cell = row.insertCell(1)
                var third_cell = row.insertCell(2)
                var fourth_cell = row.insertCell(3)
                var fifth_cell = row.insertCell(4)
                var sixth_cell = row.insertCell(5)
                // var seventh_cell = row.insertCell(6)
                first_cell.innerHTML = "<input type = 'text' class = 'form-control input-md' name = products["+itemIndex+"][name] value = ''>"
                second_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][opening_stock] value = 0>"
                third_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][opening_stock_value] value = 0>"
                fourth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][purchase_price] value = 0>"
                fifth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][selling_price] value = 0>"
                sixth_cell.innerHTML = "<input type = 'number' class = 'form-control input-md' name = products["+itemIndex+"][reorder_level] value = 0>"
                var fieldValue = (productName.value) + "-" + (tagItem.value)
                document.getElementsByName("products["+itemIndex+"][name]")[0].value = fieldValue
            } else if (addItem === false) {
                var row = tableBody.deleteRow(itemIndex)
            }
        };
        function addToAttrMasterTable () {};
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
            }),
            $('.taxes-select').select2({
                theme: "default",
                placeholder: "Select taxes",
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

            /*var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });*/

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

       /* $("#basic_slider").noUiSlider({
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

@endsection
