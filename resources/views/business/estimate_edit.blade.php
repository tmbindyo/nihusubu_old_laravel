@extends('business.layouts.app')

@section('title', ' Estimate Edit')

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Estimate Edit</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales',$institution->portal)}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.estimates',$institution->portal)}}">Estimates</a>
                    </li>
                    <li>
                        <a href="{{route('business.estimate.show',['portal'=>$institution->portal, 'id'=>$estimate->id])}}">Estimate</a>
                    </li>
                    <li class="active">
                        <strong>Estimate Edit</strong>
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
                                <form method="post" action="{{ route('business.estimate.update',['portal'=>$institution->portal, 'id'=>$estimate->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                    <br>
                                    {{--  Product  --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{--  Customer  --}}
                                            <div class="has-warning">
                                                @if ($errors->has('contact'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('contact') }}</strong>
                                                    </span>
                                                @endif
                                                <select name="contact" class="select2_contact form-control input-lg" required>
                                                    <option selected disabled>Select Customer</option>
                                                    @foreach($contacts as $contact)
                                                        <option @if($contact->id == $estimate->contact_id)selected @endif value="{{$contact->id}}"> @if($contact->organization){{$contact->organization->name}}: @endif{{$contact->last_name}}, {{$contact->first_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="has-warning" id="data_1">
                                                        @if ($errors->has('date'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('date') }}</strong>
                                                            </span>
                                                        @endif
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" value="{{$estimate->date}}" name="date" id="date" class="form-control input-lg" required>
                                                        </div>
                                                        <i> estimate date.</i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="has-warning" id="data_1">
                                                        @if ($errors->has('due_date'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('due_date') }}</strong>
                                                            </span>
                                                        @endif
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" value="{{$estimate->due_date}}" name="due_date" id="due_date" class="form-control input-lg" required>
                                                        </div>
                                                        <i> due date.</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    {{--table--}}
                                    <div class="row">
                                        <table class="table table-bordered" id = "estimate_table">
                                            <thead>
                                            <tr>
                                                <th>Item Details</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $product_index = 0
                                            @endphp
                                            @foreach($estimate->saleProducts as $saleProduct)
                                                <tr>
                                                    <td>
                                                        <select onchange = "itemSelected(this)" data-placement="Select" name="item_details[{{$product_index}}][item]" class="select2 form-control input-lg item-select" style = "width: 100%">
                                                            @foreach($products as $product)
                                                                @if($product->is_service == 0)
                                                                    @foreach($product->inventory as $inventory)
                                                                        <option @if($saleProduct->product->id == $product->id) selected @endif value="{{$product->id}}:{{$inventory->id}}" data-product-quantity = "{{$inventory->quantity}}" data-product-selling-price = "{{$product->selling_price}}">{{$product->name}} [{{$inventory->warehouse->name}}]</option>
                                                                    @endforeach
                                                                @else
                                                                    <option @if($saleProduct->product->id == $product->id) selected @endif value="{{$product->id}}" data-product-quantity = "-20" data-product-selling-price = "{{$product->selling_price}}">{{$product->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input oninput = "changeItemQuantity(this)" name="item_details[{{$product_index}}][quantity]" type="number" class="form-control input-lg item-quantity" value = "{{$saleProduct->quantity}}" min = "0">
                                                    </td>
                                                    <td>
                                                        <input oninput = "changeItemRate(this)" name="item_details[{{$product_index}}][rate]" type="number" class="form-control input-lg item-rate" placeholder="E.g +10, -10" value = "{{$saleProduct->rate}}" min = "0">
                                                    </td>
                                                    <td>
                                                        <input oninput = "itemTotalChange()" onchange = "this.oninput()" name="item_details[{{$product_index}}][amount]" type="number" class="form-control input-lg item-total" placeholder="E.g +10, -10" value = "{{$saleProduct->amount}}" min = "0">
                                                    </td>
                                                    <td style = "width: 1em;">
                                                        <span><i onclick = "removeSelectedRow(this)" class = "fa fa-minus-circle btn btn-danger"></i></span>
                                                    </td>
                                                </tr>
                                                @php
                                                    $product_index++
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
                                    </div>

                                    {{--sub totals--}}
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-5">
                                                <label>Sub Total</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input name="subtotal" type = "number" class="pull-right form-control" id = "items-subtotal" readonly value="{{$estimate->subtotal}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-1 col-md-offset-5">
                                                <label>Adjustment</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input name="discount" oninput = "itemTotalChange()" type="number" class="form-control" id = "adjustment-value" value = "{{$estimate->discount}}">
                                            </div>
                                            <div class="col-md-1">
                                                <span><i data-toggle="tooltip" data-placement="right" title="Add any other +ve or -ve charges that need to be applied to adjust the total amount of the transaction." class="fa fa-2x fa-question-circle"></i></span>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="pull-right" id = "adjustment-text">0</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-5">
                                                <p>Total ()</p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type = "number" name = "grand_total" id = "grand-total" class="pull-right form-control" value = "{{$estimate->total}}" readonly>
                                            </div>
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

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<!-- Image cropper -->
<script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

<!-- Select2 -->
<script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

<script>
    $(document).ready(function(){

        $(".select2_contact").select2({
            placeholder: "Select Contact",
            allowClear: true
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

        $(".select2").select2();

    });

</script>

{{--  Get due date to populate   --}}
<script>
    $(document).ready(function() {
        // Set date
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        if (dd < 10){
            dd = '0'+dd;
        }
        if (mm < 10){
            mm = '0'+mm;
        }
        var date_today = mm + '/' + dd + '/' + yyyy;
        document.getElementById("due_date").value = date_today;
        document.getElementById("date").value = date_today;
    });

</script>

<script>
    var subTotal = [];
    var adjustedValue;
    function itemSelected (e) {
        var selectedItemQuantity = e.options[e.selectedIndex].getAttribute("data-product-quantity");
        var selectItemPrice = e.options[e.selectedIndex].getAttribute("data-product-selling-price");
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemQuantity = selectedTr.getElementsByClassName("item-quantity");
        var itemRate = selectedTr.getElementsByClassName("item-rate");
        // -20 is an arbitrary value set to indicate that an item is a service and so has no limit
        if (selectedItemQuantity === "-20") {
            itemQuantity[0].setAttribute("max", 100000000);
        } else {
            itemQuantity[0].setAttribute("max", selectedItemQuantity);
        };
        itemRate[0].value = selectItemPrice;
    };
    function changeItemQuantity (e) {
        var quantityValue;
        if (e.value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = e.value;
        };
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemRateInputField = selectedTr.getElementsByClassName("item-rate");
        var itemTotalInputField = selectedTr.getElementsByClassName("item-total");
        var itemRate;
        if (itemRateInputField[0].value.isEmpty) {
            itemRate = 0;
        } else {
            itemRate = itemRateInputField[0].value;
        };
        itemTotalInputField[0].value = quantityValue * itemRate;
        itemTotalChange();
    };
    function changeItemRate (e) {
        var itemRate;
        if (e.value.isEmpty) {
            itemRate = 0;
        } else {
            itemRate = e.value;
        };
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemQuantityInputField = selectedTr.getElementsByClassName("item-quantity");
        var itemTotalInputField = selectedTr.getElementsByClassName("item-total");
        var quantityValue;
        if (itemQuantityInputField[0].value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = itemQuantityInputField[0].value;
        };
        itemTotalInputField[0].value = quantityValue * itemRate;
        itemTotalChange();
    };
    var tableValueArrayIndex = 1;
    function addTableRow () {
        var table = document.getElementById("estimate_table");
        var row = table.insertRow();
        var firstCell = row.insertCell(0);
        var secondCell = row.insertCell(1);
        var thirdCell = row.insertCell(2);
        var fourthCell = row.insertCell(3);
        var fifthCell = row.insertCell(4);
        firstCell.innerHTML = "<select onchange = 'itemSelected(this)' data-placement='Select' name='item_details["+tableValueArrayIndex+"][item]' class='select2 form-control input-lg item-select' style = 'width: 100%'>"+
                                "<option selected disabled>Select Item</option>"+
                                "@foreach($products as $product)"+
                                "@if($product->is_service == 0)"+
                                "@foreach($product->inventory as $inventory)"+
                                "<option value='{{$product->id}}:{{$inventory->id}}' data-product-quantity = '{{$inventory->quantity}}' data-product-selling-price = '{{$product->selling_price}}'>{{$product->name}} [{{$inventory->warehouse->name}}]</option>"+
                                "@endforeach"+
                                "@else"+
                                "<option value='{{$product->id}}' data-product-quantity = '-20' data-product-selling-price = '{{$product->selling_price}}'>{{$product->name}}</option>"+
                                "@endif"+
                                "@endforeach"+
                                "</select>";
        secondCell.innerHTML = "<input oninput = 'changeItemQuantity(this)' name='item_details["+tableValueArrayIndex+"][quantity]' type='number' class='form-control input-lg item-quantity' value = '0' min = '0'>";
        thirdCell.innerHTML = "<input oninput = 'changeItemRate(this)' name='item_details["+tableValueArrayIndex+"][rate]' type='number' class='form-control input-lg item-rate' placeholder='E.g +10, -10' value = '0' min = '0'>";
        fourthCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][amount]' type='number' class='form-control input-lg item-total' placeholder='E.g +10, -10' value = '0' min = '0'>";
        fifthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
        fifthCell.setAttribute("style", "width: 1em;")
        tableValueArrayIndex++;

        $(".select2").select2();
    };
    function removeSelectedRow (e) {
        var selectedParentTd = e.parentElement.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var selectedTable = selectedTr.parentElement;
        var removed = selectedTr.getElementsByClassName("item-select")[0].getAttribute("name");
        adjustTableInputFieldsIndex(removed);
        selectedTable.removeChild(selectedTr);
        tableValueArrayIndex--;
        itemTotalChange();
    };
    function adjustTableInputFieldsIndex (removedFieldName) {
        // Fields whose values are submitted are:
        // 1. item_details[][item]
        // 2. item_details[][quantity]
        // 3. item_details[][rate]
        // 4. item_details[][amount]
        var displacement = 0;
        var removedIndex;
        while (displacement < tableValueArrayIndex) {
            if (removedFieldName == "item_details["+displacement+"][item]"){
                removedIndex = displacement;
            } else {
                var itemField = document.getElementsByName("item_details["+displacement+"][item]");
                var quantityField = document.getElementsByName("item_details["+displacement+"][quantity]");
                var rateField = document.getElementsByName("item_details["+displacement+"][rate]");
                var amountField = document.getElementsByName("item_details["+displacement+"][amount]");
                if (removedIndex) {
                    if (displacement > removedIndex) {
                        var newIndex = displacement - 1;
                        itemField[0].setAttribute("name", "item_details["+newIndex+"][item]");
                        quantityField[0].setAttribute("name", "item_details["+newIndex+"][quantity]");
                        rateField[0].setAttribute("name", "item_details["+newIndex+"][rate]");
                        amountField[0].setAttribute("name", "item_details["+newIndex+"][amount]");
                    };
                };
            };
            displacement++;
        };
    };
    function itemTotalChange () {
        subTotal = [];
        var itemTotals = document.getElementsByClassName("item-total");
        for (singleTotal of itemTotals) {
            subTotal.push(Number(singleTotal.value));
        };
        var itemSubTotal = subTotal.reduce((a, b) => a + b, 0);
        document.getElementById("items-subtotal").value = itemSubTotal;
        document.getElementById("grand-total").innerHTML = itemSubTotal;
        var adjustedValueInputValue = document.getElementById("adjustment-value").value;
        if (adjustedValueInputValue.isEmpty) {
            adjustedValue = 0
        } else {
            adjustedValue = adjustedValueInputValue;
        };
        document.getElementById("adjustment-text").innerHTML = adjustedValue;
        var adjustedTotal = Number(adjustedValue) + Number(itemSubTotal);
        document.getElementById("grand-total").value = adjustedTotal;
    };
</script>
@endsection
