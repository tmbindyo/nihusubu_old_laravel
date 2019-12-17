@extends('business.layouts.app')

@section('title', ' Composite products')

@section('css')
    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Composite Products</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.products')}}">Products</a>
                </li>
                <li class="active">
                    <a href="{{route('business.composite.products')}}">Composite Products</a>
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
                            <form method="post" action="{{ route('business.composite.product.update',$compositeProduct->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                            <input type="radio" id="goods" value="goods" name="product_type" checked="" @if($compositeProduct->is_service == 1) checked @endif>
                                            <label for="goods"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="services" value="services" name="product_type" @if($compositeProduct->is_service == 0) checked @endif>
                                            <label for="services"> Service </label>
                                        </div>
                                        {{--  Product name  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <input type="text" id="product_name" name="product_name" required="required" class="form-control input-lg" value="{{$compositeProduct->name}}">
                                            <i>Give your product a name</i>
                                        </div>
                                        {{--  Product Unit  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <select name="unit" class="select2_demo_3 form-control input-lg">
                                                <option disabled>Select Unit</option>
                                                @foreach($units as $unit)
                                                    <option @if($compositeProduct->unit_id == $unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label>  </label>
                                        {{--  Product returnable  --}}
                                        {{--todo description tooltip--}}
                                        <div class="">
                                            <input id="returnable" name="returnable" type="checkbox" @if($compositeProduct->is_returnable == 1) checked @endif>
                                            <label for="returnable">
                                                Returnable Product
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-question-circle fa-2x"></i></span>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        {{--  TODO Thumbnail  --}}
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
                                            <input type="text" id="selling_price" name="selling_price" required="required" value="{{$compositeProduct->selling_price}}" class="form-control input-lg">
                                            <i>Give your product a price</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Selling Account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you sell will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select name="selling_account" class="select2_demo_3 form-control input-lg">
                                                        <option>Select Account</option>
                                                        @foreach($accounts as $account)
                                                            <option @if($compositeProduct->selling_account_id == $account->id) selected @endif value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product Tax  --}}
                                        <label></label>
                                        <select name="taxes[]" class="select2_demo_3 form-control input-lg">
                                            <option disabled>Select tax</option>
                                            @foreach($taxes as $tax)
                                                @foreach($compositeProduct->product_taxes as $productTax)
                                                    <option @if($productTax->tax_id == $tax->id) selected @endif value="{{$tax->id}}">{{$tax->name}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
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
                                                            <select onchange = "returnProductDetails(this)" name = "item_details[0][details]" class="select form-control input-lg select-product">
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
                                            {{-- <tfoot>
                                            <tr>
                                                <th>Product Details</th>
                                                <th width="210px">Quantity</th>
                                                <th width="210px">Unit Price</th>
                                                <th width="210px">Total Price</th>
                                            </tr>
                                            </tfoot> --}}
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
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

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
        firstCell.innerHTML = "<select onchange = 'returnProductDetails(this)' name = 'item_details["+tableValueArrayIndex+"][details]' class='select form-control input-lg select-product'>"+
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

@endsection
