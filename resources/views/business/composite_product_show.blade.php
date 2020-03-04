@extends('business.layouts.app')

@section('title', ' Composite Product')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick-theme.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('inspinia') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">


@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Composite Product</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.products',$institution->portal)}}">Products</a>
                </li>
                <li>
                    <a href="{{route('business.composite.products',$institution->portal)}}">Composite Products</a>
                </li>
                <li class="active">
                    <strong>Composite Product Products</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                {{--  todo add item to composite products modal  --}}
                {{--  <a href="#" data-toggle="modal" data-target="#compositeProductRegistration" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>  --}}
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @foreach($compositeProductProducts as $product)
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <div class="product-imitation">
                                [ INFO ]
                            </div>
                            <div class="product-desc">
                                <span class="product-price">
                                    Ksh {{$product->unit_price}}
                                </span>
                                <small class="text-muted">Category</small>
                                <a href="#" class="product-name"> {{$product->product->name}}</a>

                                <div class="small m-t-xs">
{{--                                    Many desktop publishing packages and web page editors now.--}}
                                </div>
                                <div class="m-t text-righ">

                                    <a href="{{route('business.product.show',['portal'=>$institution->portal,'id'=>$product->product->id])}}" class="btn btn-xs btn-outline btn-primary">View <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

{{--        // Product details--}}
        <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        {{--  <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>  --}}
                                        {{--  <h2>Contract with Zender Company</h2>  --}}
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label {{$compositeProduct->status->label}}">{{$compositeProduct->status->name}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>{{$compositeProduct->user->name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{$compositeProduct->updated_at}}</dd>
                                        <dt>Created:</dt> <dd> 	{{$compositeProduct->created_at}} </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#orders" data-toggle="tab">Orders</a></li>
                                                    <li class=""><a href="#sales" data-toggle="tab">Sales</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="orders">

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Quantity</th>
                                                                <th>Rate</th>
                                                                <th>Status</th>
                                                                <th>Order</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($compositeProduct->order_products as $order)
                                                                <tr class="gradeX">
                                                                    <td>{{$order->created_at}}</td>
                                                                    <td>{{$order->quantity}}</td>
                                                                    <td class="center">{{$order->rate}}</td>
                                                                    <td class="center">{{$order->status}}</td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('business.order.show', ['portal'=>$institution->portal,'id'=>$order->order_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Quantity</th>
                                                                <th>Rate</th>
                                                                <th>Status</th>
                                                                <th>Order</th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="tab-pane" id="sales">

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Quantity</th>
                                                                <th>Rate</th>
                                                                <th>Status</th>
                                                                <th>Sale</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($compositeProduct->sale_products as $sale)
                                                                <tr class="gradeX">
                                                                    <td>{{$sale->created_at}}</td>
                                                                    <td>{{$sale->quantity}}</td>
                                                                    <td class="center">{{$sale->rate}}</td>
                                                                    <td class="center">{{$sale->status}}</td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('business.sale.show', ['portal'=>$institution->portal,'id'=>$sale->sale_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Quantity</th>
                                                                <th>Rate</th>
                                                                <th>Status</th>
                                                                <th>Sale</th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
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
            <div class="col-lg-3">

                <div class="wrapper wrapper-content project-manager">


                    <div class="row">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> Sales </span>
                                    <h2 class="font-bold">{{$compositeProduct->sale_products_count}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> Orders </span>
                                    <h2 class="font-bold">{{$compositeProduct->order_products_count}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> Orders </span>
                                    <h2 class="font-bold">{{$compositeProduct->composite_product_products_count}}</h2>
                                </div>
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
<script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- slick carousel-->
<script src="{{ asset('inspinia') }}/js/plugins/slick/slick.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

        /* Init DataTables */
        var oTable = $('#editable').DataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable( '../example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }
</script>

<script>
    $(document).ready(function(){


        $('.product-images').slick({
            dots: true
        });

    });

</script>

@endsection
