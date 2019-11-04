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
                            <form method="post" action="{{ route('business.composite.product.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                            <input type="radio" id="goods" value="goods" name="product_type" checked="">
                                            <label for="goods"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="services" value="services" name="product_type">
                                            <label for="services"> Service </label>
                                        </div>
                                        {{--  Product name  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <input type="text" id="product_name" name="product_name" required="required" class="form-control input-lg" placeholder="Product name">
                                            <i>Give your product a name</i>
                                        </div>
                                        {{--  Product Unit  --}}
                                        <div class="has-warning">
                                            <label>  </label>
                                            <select name="unit" class="select2_demo_3 form-control input-lg">
                                                <option disabled>Select Unit</option>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label>  </label>
                                        {{--  Product returnable  --}}
                                        {{--todo description tooltip--}}
                                        <div class="">
                                            <input id="returnable" name="returnable" type="checkbox">
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
                                            <input type="text" id="selling_price" name="selling_price" required="required" placeholder="Selling Price" class="form-control input-lg">
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
                                                            <option value="{{$account->id}}">{{$account->name}}</option>
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
                                                <option value="{{$tax->id}}">{{$tax->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <hr>

                                {{--  Inventory information  --}}
                                <h3 class="text-center">INVENTORY INFORMATION</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Inventory account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All inventory related transactions will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select name="inventory_account" class="select2_demo_3 form-control input-lg" multiple>
                                                        <option>Select Account</option>
                                                        @foreach($accounts as $account)
                                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
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
                                            <tr>
                                                <td>
                                                    <select onchange = "returnProductDetails(this)" name = "item_details[0][details]" class="select form-control input-lg">
                                                        <option>Select Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}" data-product-details="{{$product}}" data-product-quantity="{{$product->opening_stock_value}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control input-lg items-on-hand" name = "item_details[0][quantity]" value = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "modifyItemsOnHand(this)" type="number" class="form-control input-lg items-new-on-hand" name = "item_details[0][unit_price]">
                                                </td>
                                                <td>
                                                    <input oninput = "modifyItemsOnHand(this)" type="number" class="form-control input-lg items-new-on-hand" name = "item_details[0][total_price]">
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Product Details</th>
                                                <th width="210px">Quantity</th>
                                                <th width="210px">Unit Price</th>
                                                <th width="210px">Total Price</th>
                                            </tr>
                                            </tfoot>
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


@endsection
