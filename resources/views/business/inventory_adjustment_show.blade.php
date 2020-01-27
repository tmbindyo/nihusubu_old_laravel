@extends('business.layouts.app')

@section('title', 'Inventory Adjustment')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('inspinia') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">


@endsection
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Inventory Adjustment</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Inventory
                </li>
                <li class="active">
                    <a href="{{route('business.inventory.adjustments',$institution->portal)}}">Inventory Adjustments</a>
                </li>
                <li class="active">
                    <strong>Inventory Adjustment</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="row">
            <div class="col-md-6">
                <div class="payment-card">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="fa fa-database payment-icon-big text-success"></i>
                            <h2>
                                {{$inventoryAdjustment->reason->name}}
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                {{$inventoryAdjustment->description}}
                            </div>
                            <div class="row">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Adjustment date:</strong> {{$inventoryAdjustment->created_at}}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>By:</strong> {{$inventoryAdjustment->user->name}}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-md-9">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>{{$inventoryAdjustment->inventory_adjustment_products_count}}</strong>) items</span>
                        <h5>Adjusted Products</h5>
                    </div>
                    @foreach($inventoryAdjustment->inventory_adjustment_products as $product)
                        <div class="ibox-content">


                            <div class="table-responsive">
                                <table class="table shoping-cart-table">

                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy">
                                                    {{$product->product->name}}
                                                </a>
                                            </h3>
                                            <p class="small">
                                                {{$inventoryAdjustment->reason->name}}
                                            </p>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                {{$inventoryAdjustment->description}}
                                            </dl>
                                        </td>

                                        <td>
                                            {{$product->subsequent_quantity}}
                                            <s class="small text-muted">{{$product->initial_quantity}}</s>
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" value="{{$product->quantity}}" readonly>
                                        </td>
                                        <td>
                                            <h4>
                                                {{$product->subsequent_quantity}}
                                            </h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endforeach
                    <div class="ibox-content">

                        <button class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                        <button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button>

                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                            <span>
                                Total
                            </span>
                        <h2 class="font-bold">
                            $390,00
                        </h2>

                        <hr/>
                        <span class="text-muted small">
                                *For United States, France and Germany applicable sales tax will be applied
                            </span>
                        <div class="m-t-sm">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
                            </div>
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
