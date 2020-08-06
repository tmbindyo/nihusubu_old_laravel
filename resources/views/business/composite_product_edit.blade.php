@extends('business.layouts.app')

@section('title', ' Composite products')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Composite Products</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.products',$institution->portal)}}">Products</a>
                </li>
                <li class="active">
                    <a href="{{route('business.composite.products',$institution->portal)}}">Composite Products</a>
                </li>
                <li class="active">
                    <a href="{{ route('business.composite.product.show', ['portal'=>$institution->portal, 'id'=>$compositeProduct->id]) }}">Composite Product</a>
                </li>
                <li class="active">
                    <strong>Create Composite Products</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="">
                            <form method="post" enctype="multipart/form-data" action="{{ route('business.composite.product.update',['portal'=>$institution->portal, 'id'=>$compositeProduct->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                        {{--  Product type  --}}
                                        @if ($errors->has('product_type'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('product_type') }}</strong>
                                            </span>
                                        @endif
                                        <p>Product Type</p>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="goods" value="goods" name="product_type" checked="" class="{{ $errors->has('product_type') ? ' is-invalid' : '' }}" @if($compositeProduct->is_service == 1) checked @endif>
                                            <label for="goods"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="services" value="services" name="product_type" class="{{ $errors->has('product_type') ? ' is-invalid' : '' }}" @if($compositeProduct->is_service == 0) checked @endif>
                                            <label for="services"> Service </label>
                                        </div>
                                        {{--  Product name  --}}
                                        <br>
                                        <br>
                                        <div class="has-warning">
                                            @if ($errors->has('product_name'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('product_name') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="product_name" name="product_name" required="required" class="form-control input-lg {{ $errors->has('product_name') ? ' is-invalid' : '' }}" value="{{$compositeProduct->name}}">
                                            <i>name</i>
                                        </div>
                                        {{--  Product Unit  --}}
                                        <br>
                                        <div class="has-warning">
                                            @if ($errors->has('unit'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                            @endif
                                            <select name="unit" class="select2_unit form-control input-lg {{ $errors->has('unit') ? ' is-invalid' : '' }}" required>
                                                <option disabled>Select Unit</option>
                                                @foreach($units as $unit)
                                                    <option @if($compositeProduct->unit_id == $unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                            <i>unit</i>
                                        </div>
                                        <br>
                                        <div class="row">
                                            @if ($errors->has('brand'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('brand') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-lg-11">
                                                <div class="has-warning">
                                                    <select name="brand" class="select2_brand form-control input-lg {{ $errors->has('brand') ? ' is-invalid' : '' }}">
                                                        <option></option>
                                                        @foreach($brands as $brand)
                                                            <option @if($compositeProduct->brand_id == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                                        @endforeach()
                                                    </select>
                                                    <i>brand</i>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <span><i data-toggle="tooltip" data-placement="right" title="This depends on whether the item belongs to a brand." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            @if ($errors->has('product_category'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('product_category') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-lg-11">
                                                <div class="has-warning">
                                                    <select name="product_sub_category" class="select2_product_sub_category form-control input-lg {{ $errors->has('product_sub_category') ? ' is-invalid' : '' }}">
                                                        <option></option>
                                                        @foreach($productSubCategories as $productSubCategory)
                                                            <option @if($compositeProduct->product_sub_category_id == $productSubCategory->id) selected @endif value="{{$productSubCategory->id}}">{{$productSubCategory->name}}</option>
                                                        @endforeach()
                                                    </select>
                                                    <i>product sub category</i>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <span><i data-toggle="tooltip" data-placement="right" title="This depends on whether the item belongs to a product category." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                        </div>
                                        <br>
                                        {{--  Product returnable  --}}
                                        @if ($errors->has('returnable'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('returnable') }}</strong>
                                            </span>
                                        @endif
                                        <div class="checkbox">
                                            <input id="returnable" name="returnable" type="checkbox" class="{{ $errors->has('returnable') ? ' is-invalid' : '' }}" @if($compositeProduct->is_returnable == 1) checked @endif>
                                            <label for="returnable">
                                                Returnable Product
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-question-circle fa-2x"></i></span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input id="file-1" type="file" name="file[]" multiple class="file {{ $errors->has('file') ? ' is-invalid' : '' }}" data-overwrite-initial="false" data-min-file-count="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                {{--  Sales and purchase information  --}}
                                <h3 class="text-center">SALES AND PURCHASE INFORMATION</h3>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Selling price  --}}
                                        <div class="has-warning">
                                            @if ($errors->has('selling_price'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('selling_price') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="selling_price" name="selling_price" required="required" value="{{$compositeProduct->selling_price}}" class="form-control input-lg {{ $errors->has('selling_price') ? ' is-invalid' : '' }}">
                                            <i>selling price</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Selling Account  --}}
                                        <div class="row">
                                            @if ($errors->has('selling_account'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('selling_account') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-md-1">
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you sell will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <select name="selling_account" class="select2_selling_account form-control input-lg {{ $errors->has('selling_account') ? ' is-invalid' : '' }}" required>
                                                        <option value="" selected disabled>Select Selling Account</option>
                                                        @foreach($salesAccounts as $account)
                                                            <option @if($compositeProduct->selling_account_id == $account->id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i>selling account</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product Tax  --}}
                                        @if ($errors->has('taxes'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('taxes') }}</strong>
                                            </span>
                                        @endif
                                        <select name="taxes[]" class="select2_taxes form-control input-lg {{ $errors->has('taxes') ? ' is-invalid' : '' }}" multiple required>
                                            <option disabled>Select tax</option>
                                            @foreach($taxes as $tax)
                                                @foreach($compositeProduct->productTaxes as $productTax)
                                                    <option @if($productTax->tax_id == $tax->id) selected @endif value="{{$tax->id}}">{{$tax->name}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <i>taxes</i>
                                    </div>

                                </div>

                                <br>
                                {{-- Composite product products --}}
                                <div class="row">
                                    <div class="ibox-title">
                                        <h5>Product Details </h5>
                                    </div>
                                    <div class="ibox-content">

                                        <table class="table table-bordered" id = "adjustment_table">
                                            <thead>
                                            <tr>
                                                <th>Product Details</th>
                                                <th width="210px">Quantity</th>
                                                <th width="210px">Unit Price</th>
                                                <th width="210px">Total Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $itemIndex = 0;
                                                @endphp
                                                @foreach($compositeProductProducts as $compositeProductProduct)
                                                    <tr>
                                                        <td>
                                                            <select onchange = "returnProductDetails(this)" name = "item_details[0][details]" class="select2 form-control input-lg select-product" style = "width: 100%">
                                                                <option>Select Product</option>
                                                                @foreach($products as $product)
                                                                    <option @if($compositeProductProduct->product_id ==$product->id) selected @endif value="{{$product->id}}" data-product-unit-price="{{$product->selling_price}}">{{$product->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" oninput = "changeQuantity(this)" class="form-control input-lg item-quantity" name = "item_details[0][quantity]" value = "{{$compositeProductProduct->quantity}}">
                                                        </td>
                                                        <td>
                                                            <input oninput = "changeUnitPrice(this)" type="number" class="form-control input-lg item-unit-price" name = "item_details[0][unit_price]" value = "{{$compositeProductProduct->unit_price}}">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control input-lg item-total-price" name = "item_details[0][total_price]" value = "{{$compositeProductProduct->total_price}}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $itemIndex ++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
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
    function returnProductDetails (e) {
        var unitPrice = e.options[e.selectedIndex].getAttribute("data-product-unit-price");
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var quantityInputField = selectedTr.getElementsByClassName("item-quantity");
        var quantityValue;
        if (quantityInputField[0].value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = quantityInputField[0].value;
        }
        var unitPriceInputField = selectedTr.getElementsByClassName("item-unit-price");
        unitPriceInputField[0].value = unitPrice;
        var totalPriceInputField = selectedTr.getElementsByClassName("item-total-price");
        totalPriceInputField[0].value = quantityValue * unitPrice;
    };
    function changeQuantity (e) {
        if (e.value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = e.value;
        }
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var unitPriceInputField = selectedTr.getElementsByClassName("item-unit-price");
        var unitPrice;
        if (unitPriceInputField[0].value.isEmpty) {
            unitPrice = 0;
        } else {
            unitPrice = unitPriceInputField[0].value;
        };
        var totalPriceInputField = selectedTr.getElementsByClassName("item-total-price");
        totalPriceInputField[0].value = quantityValue * unitPrice;
    };
    function changeUnitPrice (e) {
        if (e.value.isEmpty) {
            unitPrice = 0;
        } else {
            unitPrice = e.value;
        }
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var quantityInputField = selectedTr.getElementsByClassName("item-quantity");
        var quantityValue;
        if (quantityInputField[0].value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = quantityInputField[0].value;
        }
        var totalPriceInputField = selectedTr.getElementsByClassName("item-total-price");
        totalPriceInputField[0].value = quantityValue * unitPrice;
    };
    var tableValueArrayIndex = 1;
    function addTableRow () {
        var table = document.getElementById("adjustment_table");
        var row = table.insertRow();
        var firstCell = row.insertCell(0);
        var secondCell = row.insertCell(1);
        var thirdCell = row.insertCell(2);
        var fourthCell = row.insertCell(3);
        var fifthCell = row.insertCell(4);
        firstCell.innerHTML = "<select onchange = 'returnProductDetails(this)' name = 'item_details["+tableValueArrayIndex+"][details]' class='select2 form-control input-lg select-product' style = 'width: 100%'>"+
                                "<option>Select Product</option>"+
                                "@foreach($products as $product)"+
                                "<option value='{{$product->id}}' data-product-unit-price='{{$product->selling_price}}'>{{$product->name}}</option>"+
                                "@endforeach"+
                                "</select>";
        secondCell.innerHTML = "<input type='number' oninput = 'changeQuantity(this)' class='form-control input-lg item-quantity' name = 'item_details["+tableValueArrayIndex+"][quantity]' value = '0'>";
        thirdCell.innerHTML = "<input oninput = 'changeUnitPrice(this)' type='number' class='form-control input-lg item-unit-price' name = 'item_details["+tableValueArrayIndex+"][unit_price]' value = '0'>";
        fourthCell.innerHTML = "<input type='number' class='form-control input-lg item-total-price' name = 'item_details["+tableValueArrayIndex+"][total_price]' value = '0'>";
        fifthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
        fifthCell.setAttribute("style", "width: 1em;");
        tableValueArrayIndex++;

        $(".select2").select2();
    };
    function removeSelectedRow (e) {
        var selectedParentTd = e.parentElement.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var selectedTable = selectedTr.parentElement;
        var removed = selectedTr.getElementsByClassName("select-product")[0].getAttribute("name");
        adjustTableInputFieldsIndex(removed);
        selectedTable.removeChild(selectedTr);
        tableValueArrayIndex--;
    };
    function adjustTableInputFieldsIndex (removedFieldName) {
        // Fields whose values are submitted are:
        // 1. item_details[][details]
        // 2. item_details[][quantity]
        // 3. item_details[][unit_price]
        // 4. item_details[][total_price]
        var displacement = 0;
        var removedIndex;
        while (displacement < tableValueArrayIndex) {
            if (removedFieldName == "item_details["+displacement+"][details]"){
                removedIndex = displacement;
            } else {
                var detailsField = document.getElementsByName("item_details["+displacement+"][details]");
                var quantityField = document.getElementsByName("item_details["+displacement+"][quantity]");
                var unitPriceField = document.getElementsByName("item_details["+displacement+"][unit_price]");
                var totalPriceField = document.getElementsByName("item_details["+displacement+"][total_price]");
                if (removedIndex) {
                    if (displacement > removedIndex) {
                        var newIndex = displacement - 1;
                        detailsField[0].setAttribute("name", "item_details["+newIndex+"][details]");
                        quantityField[0].setAttribute("name", "item_details["+newIndex+"][quantity]");
                        unitPriceField[0].setAttribute("name", "item_details["+newIndex+"][unit_price]");
                        totalPriceField[0].setAttribute("name", "item_details["+newIndex+"][total_price]");
                    };
                };
            };
            displacement++;
        };
    };
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
        $(".select2_selling_account").select2({
            placeholder: "Select Selling Account",
            allowClear: true
        });
        $(".select2_taxes").select2({
            placeholder: "Select Taxes",
            allowClear: true
        });
        $(".select2_unit").select2({
            placeholder: "Select Unit",
            allowClear: true
        });
        $(".select2_brand").select2({
            placeholder: "Select Brand",
            allowClear: true
        });
        $(".select2_product_sub_category").select2({
            placeholder: "Select Product Category",
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

    /*$("#basic_slider").noUiSlider({
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
