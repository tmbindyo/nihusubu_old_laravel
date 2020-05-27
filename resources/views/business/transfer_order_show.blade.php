@extends('business.layouts.app')

@section('title', 'Transer Order')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Transer Order</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Inventory
                </li>
                <li class="active">
                    <a href="{{route('business.transfer.orders',$institution->portal)}}">Transer Orders</a>
                </li>
                <li class="active">
                    <strong>Transer Order</strong>
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
                    <i class="fa fa-database payment-icon-big text-success"></i>
                    <h2>
                        Source : {{$transferOrder->source_warehouse->name}} @if($transferOrder->source_warehouse->is_primary == 1) <span class="label label-primary">Primary Warehouse</span> @endif
                    </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Created date:</strong> {{$transferOrder->source_warehouse->created_at}}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>By:</strong> {{$transferOrder->source_warehouse->user->name}}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-card">
                    <i class="fa fa-database payment-icon-big text-warning"></i>
                    <h2>
                        {{$transferOrder->destination_warehouse->name}} @if($transferOrder->destination_warehouse->is_primary == 1) <span class="label label-primary">Primary Warehouse</span> @endif
                    </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Expiry date:</strong> {{$transferOrder->destination_warehouse->created_at}}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>By:</strong> {{$transferOrder->destination_warehouse->user->name}}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-md-12">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>{{$transferOrder->transfer_order_products_count}}</strong>) items</span>
                        <h5>Items in your cart</h5>
                    </div>
                    @foreach($transferOrder->transfer_order_products as $product)
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
                                                <a href="{{route('business.product.show',['portal'=>$institution->portal,'id'=>$product->product->id])}}" class="text-navy">
                                                    {{$product->product->name}}
                                                </a>
                                            </h3>
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="{{$product->quantity}}">
                                        </td>
                                        <td>
                                            <h3>Destination warehouse:</h3>
                                            {{$product->source_warehouse_subsequent_amount}}
                                            <s class="small text-muted">{{$product->source_warehouse_initial_amount}}</s>
                                        </td>

                                        <td>
                                            <h4>
                                                {{$product->source_warehouse_subsequent_amount}}
                                            </h4>
                                        </td>

                                        <td>
                                            <h3>Source warehouse:</h3>
                                            {{$product->destination_warehouse_subsequent_amount}}
                                            <s class="small text-muted">{{$product->destination_warehouse_initial_amount}}</s>
                                        </td>
                                        <td>
                                            <h4>
                                                {{$product->destination_warehouse_subsequent_amount}}
                                            </h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endforeach
                    <div class="ibox-content">



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
