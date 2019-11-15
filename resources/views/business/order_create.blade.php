@extends('business.layouts.app')

@section('title', ' Order Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('inspinia') }}/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

@endsection

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Orders</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales')}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.orders')}}">Orders</a>
                    </li>
                    <li class="active">
                        <strong>Order Create</strong>
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
                                <form method="post" action="{{ route('business.product.group.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <span><i data-toggle="tooltip" data-placement="left" title="Enable this option if all the items in the group are eligible for sales return." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                                </div>
                                                {{--  Salutation  --}}
                                                <div class="col-md-3">
                                                    <div class="has-warning">
                                                        <select class="select2_demo_3 form-control input-lg">
                                                            <option>Select Salutation</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  First name  --}}
                                                    <div class="has-warning">
                                                        <input type="text" id="first_name" name="first_name" required="required" class="form-control input-lg" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  Last name  --}}
                                                    <div class="has-warning">
                                                        <input type="text" id="last_name" name="last_name" required="required" class="form-control input-lg" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            {{--  Comapny name  --}}
                                            <div class="has-warning">
                                                <input type="text" id="company_name" name="company_name" required="required" class="form-control input-lg" placeholder="Company Name">
                                            </div>
                                            <br>
                                            {{--  Customer email  --}}
                                            <div class="">
                                                <input type="email" id="customer_email" name="customer_email" required="required" class="form-control input-lg" placeholder="Customer Email">
                                            </div>
                                            <br>
                                            {{--  Customer phone number  --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" id="customer_phone_number" name="customer_phone_number" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Work Phone">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="customer_phone_number" name="customer_phone_number" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Mobile">
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
                                            <tr>
                                                <td>
                                                    <select onchange = "itemSelected(this)" data-placement="Select" name="item_details[0][item]" class="select2_demo_3 form-control input-lg item-select">
                                                        <option selected disabled>Select Item</option>
                                                        @foreach($products as $product)
                                                            @if($product->is_service == 0)
                                                                @foreach($product->inventory as $inventory)
                                                                    <option value="{{$product->id}}[{{$inventory->id}}]" data-product-quantity = "{{$inventory->quantity}}" data-product-selling-price = "{{$product->selling_price}}">{{$product->name}} [{{$inventory->warehouse->name}}]</option>
                                                                @endforeach
                                                            @else
                                                                <option value="{{$product->id}}" data-product-quantity = "-20" data-product-selling-price = "{{$product->selling_price}}">{{$product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemQuantity(this)" name="item_details[0][quantity]" type="number" class="form-control input-lg item-quantity" value = "0" min = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemRate(this)" name="item_details[0][rate]" type="number" class="form-control input-lg item-rate" placeholder="E.g +10, -10" value = "0" min = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "itemTotalChange()" onchange = "this.oninput()" name="item_details[0][amount]" type="number" class="form-control input-lg item-total" placeholder="E.g +10, -10" value = "0" min = "0">
                                                </td>
                                            </tr>
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
                                                <input name="subtotal" type = "number" class="pull-right form-control" id = "items-subtotal" readonly value="0">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-1 col-md-offset-5">
                                                <label>Adjustment</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input oninput = "makeAdjustmentToTotal(this)" type="number" class="form-control">
                                            </div>
                                            <div class="col-md-1">
                                                <span><i data-toggle="tooltip" data-placement="right" title="Add any other +ve or -ve charges that need to be applied to adjust the total amount of the transaction." class="fa fa-2x fa-question-circle"></i></span>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="pull-right">0.00</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-5">
                                                <p>Total ()</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="pull-right" id = "grand-total"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>

                                    <div class="ln_solid"></div>

                                    <br>
                                    {{--attachments--}}
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-1">
                                            <div class="checkbox checkbox-info">
                                                <input id="is_draft" name="is_draft" type="checkbox">
                                                <label for="is_draft">
                                                    Save As Draft
                                                </label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Check this option if you want to save this as a draft for further editing." class="fa fa-2x fa-question-circle"></i></span>
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

<!-- FooTable -->
<script src="{{ asset('inspinia') }}/js/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();

        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });

</script>
@endsection
