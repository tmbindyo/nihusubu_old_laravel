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
                    <a href="{{route('business.dashboard')}}">Home</a>
                </li>
                <li>
                    Inventory
                </li>
                <li class="active">
                    <a href="{{route('business.inventory.adjustments')}}">Inventory Adjustments</a>
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
            <div class="col-md-4">
                <div class="payment-card">
                    <i class="fa fa-cc-visa payment-icon-big text-success"></i>
                    <h2>
                        **** **** **** 1060
                    </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Expiry date:</strong> 10/16
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>Name:</strong> David Williams
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="payment-card">
                    <i class="fa fa-cc-mastercard payment-icon-big text-warning"></i>
                    <h2>
                        **** **** **** 7002
                    </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Expiry date:</strong> 10/16
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>Name:</strong> Anna Smith
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="payment-card">
                    <i class="fa fa-cc-discover payment-icon-big text-danger"></i>
                    <h2>
                        **** **** **** 3466
                    </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <small>
                                <strong>Expiry date:</strong> 10/16
                            </small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small>
                                <strong>Name:</strong> Morgan Stanch
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-12">

                <div class="ibox">
                    <div class="ibox-title">
                        Payment method
                    </div>
                    <div class="ibox-content">

                        <div class="panel-group payments-method" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <i class="fa fa-cc-paypal text-success"></i>
                                    </div>
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">PayPal</a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-10">
                                                <h2>Summary</h2>
                                                <strong>Product:</strong>: Name of product <br/>
                                                <strong>Price:</strong>: <span class="text-navy">$452.90</span>

                                                <p class="m-t">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                    enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                    nisi ut aliquip ex ea commodo consequat.

                                                </p>

                                                <a class="btn btn-success">
                                                    <i class="fa fa-cc-paypal">
                                                        Purchase via PayPal
                                                    </i>
                                                </a>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <i class="fa fa-cc-amex text-success"></i>
                                        <i class="fa fa-cc-mastercard text-warning"></i>
                                        <i class="fa fa-cc-discover text-danger"></i>
                                    </div>
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Credit Card</a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <h2>Summary</h2>
                                                <strong>Product:</strong>: Name of product <br/>
                                                <strong>Price:</strong>: <span class="text-navy">$452.90</span>

                                                <p class="m-t">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                    enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                    nisi ut aliquip ex ea commodo consequat.

                                                </p>
                                                <p>
                                                    Duis aute irure dolor
                                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                    nulla pariatur. Excepteur sint occaecat cupidatat.
                                                </p>
                                            </div>
                                            <div class="col-md-8">

                                                <form role="form" id="payment-form">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label>CARD NUMBER</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="Number" placeholder="Valid Card Number" required />
                                                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-7 col-md-7">
                                                            <div class="form-group">
                                                                <label>EXPIRATION DATE</label>
                                                                <input type="text" class="form-control" name="Expiry" placeholder="MM / YY"  required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5 col-md-5 pull-right">
                                                            <div class="form-group">
                                                                <label>CV CODE</label>
                                                                <input type="text" class="form-control" name="CVC" placeholder="CVC"  required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label>NAME OF CARD</label>
                                                                <input type="text" class="form-control" name="nameCard" placeholder="NAME AND SURNAME"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <button class="btn btn-primary" type="submit">Make a payment!</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>






                                    </div>
                                </div>
                            </div>
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
                        <span class="pull-right">(<strong>5</strong>) items</span>
                        <h5>Items in your cart</h5>
                    </div>
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
                                                Desktop publishing software
                                            </a>
                                        </h3>
                                        <p class="small">
                                            It is a long established fact that a reader will be distracted by the readable
                                            content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $180,00
                                        <s class="small text-muted">$230,00</s>
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $180,00
                                        </h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
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
                                                Text editor
                                            </a>
                                        </h3>
                                        <p class="small">
                                            There are many variations of passages of Lorem Ipsum available
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>List is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $50,00
                                        <s class="small text-muted">$63,00</s>
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="2">
                                    </td>
                                    <td>
                                        <h4>
                                            $100,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
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
                                                CRM software
                                            </a>
                                        </h3>
                                        <p class="small">
                                            Distracted by the readable
                                            content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $110,00
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $110,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
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
                                                PM software
                                            </a>
                                        </h3>
                                        <p class="small">
                                            Readable content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $130,00
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $130,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
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
                                                Photo editor
                                            </a>
                                        </h3>
                                        <p class="small">
                                            Page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $700,00
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $70,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
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
