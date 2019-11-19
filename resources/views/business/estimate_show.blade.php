@extends('business.layouts.app')

@section('title', ' Estimate')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Estimate</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales')}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.estimates')}}">Estimates</a>
                    </li>
                    <li class="active">
                        <strong>Estimate</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="{{route('business.estimate.edit',$estimate->id)}}" class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit </a>
                    <a href="{{route('business.estimate.edit',$estimate->id)}}" class="btn btn-warning btn-outline"><i class="fa fa-shopping-cart"></i> Convert to Invoice </a>
                    <a href="{{route('business.invoice.print',$estimate->id)}}" target="_blank" class="btn btn-success btn-outline"><i class="fa fa-print"></i> Print </a>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">



            <div class="row">
                <div class="col-md-9">

                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="pull-right">(<strong>{{$estimate->estimate_products_count}}</strong>) items</span>
                            <h5>Items</h5>
                        </div>
                        @foreach($estimate->estimate_products as $product)
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
                                                <a href="{{route('business.product.show',$product->product->id)}}" class="text-navy">
                                                    {{$product->product->name}}
                                                </a>
                                            </h3>

                                            {!! $product->product->description !!}

                                            <div class="m-t-sm">
                                                <a href="#" class="text-warning"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            <h4>
                                                {{$product->rate}}
                                            </h4>
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" value="{{$product->quantity}}" readonly>
                                        </td>
                                        <td>
                                            <h4>
                                                {{$product->amount}}
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

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Support</h5>
                        </div>
                        <div class="ibox-content text-center">



                            <h3><i class="fa fa-phone"></i> +43 100 783 001</h3>
                            <span class="small">
                                Please contact with us if you have any questions. We are avalible 24h.
                            </span>


                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">

                            <p class="font-bold">
                                Other products you may be interested
                            </p>

                            <hr/>
                            <div>
                                <a href="#" class="product-name"> Product 1</a>
                                <div class="small m-t-xs">
                                    Many desktop publishing packages and web page editors now.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <hr/>
                            <div>
                                <a href="#" class="product-name"> Product 2</a>
                                <div class="small m-t-xs">
                                    Many desktop publishing packages and web page editors now.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
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
