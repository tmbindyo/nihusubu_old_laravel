@extends('business.layouts.app')

@section('title', ' Composite Product')

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
                <a href="{{route('business.composite.product.edit',['portal'=>$institution->portal, 'id'=>$compositeProduct->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-pencil"></i> Edit </a>
                {{--  todo add item to composite products modal  --}}
                {{--  <a href="#" data-toggle="modal" data-target="#compositeProductRegistration" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>  --}}
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @foreach($compositeProduct->compositeProductProducts as $product)
                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-center">{{$product->product->name}}</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
    {{--                            <img alt="image" class="img-fluid" src="img/profile_big.jpg">--}}
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong>{{$institution->currency->name}} {{$product->product->selling_price}}</strong></h4>
                                @isset($product->product->unit_id)
                                    <p><i class="fa fa-map-marker"></i> {{$product->product->unit->name}}</p>
                                @endisset
                                <h5>
                                    About
                                </h5>
                                <p>
                                    {!! \Illuminate\Support\Str::limit($product->product->name, 205, $end='...') !!}
                                </p>
{{--                                todo graph of product details--}}
{{--                                <div class="row m-t-lg">--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <span class="bar">5,3,9,6,5,9,7,3,5,2</span>--}}
{{--                                        <h5><strong>169</strong> Sales</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <span class="line">5,3,9,6,5,9,7,3,5,2</span>--}}
{{--                                        <h5><strong>28</strong> Views</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>--}}
{{--                                        <h5><strong>240</strong> Followers</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <br>
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-6">
{{--                                            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>--}}
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->product->id])}}" type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-arrow-right"></i> View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="row">
            <div class="col-lg-3">
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
            <div class="col-lg-3">
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
            <div class="col-lg-3">
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
        {{-- Product details  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
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
{{--                                                    <li class="active"><a href="#orders" data-toggle="tab">Orders</a></li>--}}
                                                    <li class="active"><a href="#sales" data-toggle="tab">Sales</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="sales">

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
                                                            @foreach($compositeProduct->saleProducts as $sale)
                                                                <tr class="gradeX">
                                                                    <td>{{$sale->created_at}}</td>
                                                                    <td>{{$sale->quantity}}</td>
                                                                    <td class="center">{{$sale->rate}}</td>
                                                                    <td class="center">{{$sale->status->name}}</td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('business.sale.show', ['portal'=>$institution->portal, 'id'=>$sale->sale_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
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
        </div>
    </div>
@endsection

@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- slick carousel-->
<script src="{{ asset('inspinia') }}/js/plugins/slick/slick.min.js"></script>

<!-- Peity -->
<script src="{{ asset('inspinia') }}/js/plugins/peity/jquery.peity.min.js"></script>

<!-- Peity -->
<script src="{{ asset('inspinia') }}/js/demo/peity-demo.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$compositeProduct->name}} Sales',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$compositeProduct->name}} Sales',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },

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
