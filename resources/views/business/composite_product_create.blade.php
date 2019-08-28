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
                                            <input type="radio" id="good" value="option1" name="good" checked="">
                                            <label for="inlineRadio1"> Goods </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="inlineRadio2" value="option2" name="service">
                                            <label for="inlineRadio2"> Service </label>
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
                                            <select class="select2_demo_3 form-control input-lg">
                                                <option>Select Unit</option>
                                                <option value="Bahamas">Bahamas</option>
                                            </select>
                                        </div>
                                        <label>  </label>
                                        {{--  Product returnable  --}}
                                        {{--todo description tooltip--}}
                                        <div class="checkbox">

                                            <label for="returnable">
                                                Returnable Product
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-question-circle"></i></span>
                                            <input id="returnable" name="returnable" type="checkbox">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{--  TODO Thumbnail  --}}
                                    </div>
                                </div>

                                {{--  Product information  --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product Dimensions  --}}
                                        <label></label>
                                        <input type="text" class="form-control input-lg" data-mask="999999.999999.999999" placeholder="Dimensions (cm)">
                                        <i>(Length X Width X Height)</i>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Product Weight  --}}
                                        <label></label>
                                        <input type="text" class="form-control input-lg" data-mask="$ 999999" placeholder="Weight (kg)">
                                        <i>(Length X Width X Height)</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product Manufacturer  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Select Manufacturer</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Product Brand  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Select Brand</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
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
                                        {{--  Purchase price  --}}
                                        <div class="has-warning">
                                            <label class="text-danger"></label>
                                            <input type="text" id="purchase_price" name="purchase_price" required="required" placeholder="Purchase Price" class="form-control input-lg">
                                            <i>Give your product a price</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product selling account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label class="text-danger"></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you sell will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="has-warning">
                                                    <label class="text-danger"></label>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Account</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Product purchase account  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="All transactions related to the items you purchase will be displayed in this account" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <select class="select2_demo_3 form-control input-lg">
                                                    <option>Select Account</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Product Tax  --}}
                                        <label></label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Select tax</option>
                                            <option value="Bahamas">Bahamas</option>
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
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Account</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Opening stock  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="text" id="opening_stock" name="opening_stock" required="required" class="form-control input-lg" placeholder="Opening Stock">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Opening stock value  --}}
                                        {{--  todo Make KES (currency) dynamic  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Opening stock value refers to the average purchase price of your opening stock. (Per unit in KES)" class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="text" id="opening_stock_value" name="opening_stock_value" required="required" class="form-control input-lg" placeholder="Opening Stock Value">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Reorder Level  --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label></label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Reorder level refers to the quantity of an item below which, an item is considered to be low on stock." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                            </div>
                                            <div class="col-md-11">
                                                <label></label>
                                                <input type="text" id="reorder_level" name="reorder_level" required="required" class="form-control input-lg" placeholder="Reorder Level">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--  Preferred vendor  --}}
                                        <label></label>
                                        <select id="preferred_vendor" name="preferred_vendor" class="select2_demo_3 form-control input-lg">
                                            <option>Select Preferred Vendor</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
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
