@extends('business.layouts.app')

@section('title', ' Composite Product '.$compositeProduct->name)

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Composite Product {{$compositeProduct->name}}</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('business.calendar',$institution->portal)}}">Home</a></strong>
                </li>
                <li>
                    <a href="#">Products</a>
                </li>
                <li>
                    <strong><a href="{{route('business.composite.products',$institution->portal)}}">Composite Products</a></strong>
                </li>
                <li class="active">
                    <strong>Composite Product {{$compositeProduct->name}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                @can('edit composite product')
                    <a href="{{route('business.composite.product.edit',['portal'=>$institution->portal, 'id'=>$compositeProduct->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-pencil"></i> Edit </a>
                @endcan
                {{--  todo add item to composite products modal  --}}
                {{--  <a href="#" data-toggle="modal" data-target="#compositeProductRegistration" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>  --}}
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

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
        <br>
        {{-- product description --}}
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox product-detail">
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-4">

                                <div class="carousel slide" id="carousel1">
                                    <div class="carousel-inner">
                                        @foreach($compositeProduct->productImages as $image)
                                            <div class="item @if ($loop->first) active @endif">
                                                <img alt="image" class="img-responsive" src="{{asset('storage')}}/{{$image->upload->small_thumbnail}}">
                                                <div class="carousel-caption">
                                                    <a class="" href=""><i class="fa fa-trash fa-3x"></i> </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a data-slide="prev" href="#carousel1" class="left carousel-control">
                                        <span class="icon-prev"></span>
                                    </a>
                                    <a data-slide="next" href="#carousel1" class="right carousel-control">
                                        <span class="icon-next"></span>
                                    </a>
                                </div>

                            </div>
                            <div class="col-md-8">

                                <h2 class="font-bold m-b-xs">
                                    {{$compositeProduct->name}}
                                </h2>
                                <small>{{$compositeProduct->unit->name}}</small>
                                <div class="m-t-md">
                                    <h2 class="product-main-price">{{$institution->currency->name}} {{$compositeProduct->taxed_selling_price}} <small class="text-muted">{{$compositeProduct->taxMethod->name}} [{{$compositeProduct->selling_price}}]</small> </h2>
                                </div>
                                <hr>

                                <h4>Product description</h4>

                                <div class="small text-muted">
                                    {!!$compositeProduct->description!!}
                                </div>
                                <hr>

                                {{--  todo time to complete a service  --}}

                                <div>
                                    <div class="btn-group">
                                        {{-- <button class="btn btn-primary btn-sm"><i class="fa fa-cart-plus"></i> Schedule Delivery</button> --}}
                                        {{-- <a href="{{route('business.expense.create',$institution->portal)}}" class="btn btn-warning btn-sm"><i class="fa fa-cart-plus"></i> Update stock</a> --}}
                                        @can('delete product')
                                            @if ($compositeProduct->status_id == 'bc6170bf-299a-44f5-8362-8cdeed1f47b0')
                                                <a href="{{ route('business.product.restore', ['portal'=>$institution->portal, 'id'=>$compositeProduct->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Restore </a>
                                            @else
                                                <a href="{{ route('business.product.delete', ['portal'=>$institution->portal, 'id'=>$compositeProduct->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Deactivate </a>
                                            @endif
                                        @endcan
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

{{--    composite products    --}}
        <div class="row">
            @foreach($compositeProduct->compositeProductProducts as $compositeProductProduct)
                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-center">{{$compositeProductProduct->product->name}}</h5>
                            <div class="ibox-tools">
                                @can('view product')
                                    <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$compositeProductProduct->product->id])}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                                @endcan
                            </div>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
    {{--                            <img alt="image" class="img-fluid" src="img/profile_big.jpg">--}}
                            </div>
                            <div class="ibox-content profile-content">
                                <h1 class="no-margins">{{$institution->currency->name}} {{$compositeProductProduct->product->selling_price}}</h1>
                                <small>{{$compositeProductProduct->product->name}}</small>
                                <p>
                                    {!! \Illuminate\Support\Str::limit($compositeProductProduct->product->description, 205, $end='...') !!}
                                </p>
{{--                                todo graph of product details--}}
{{--                                <div class="row m-t-lg">--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <span class="bar">5,3,9,6,5,9,7,3,5,2</span>--}}
{{--                                        <h5><strong>{{$compositeProductProduct->saleProducts_count}}</strong> Sales</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <span class="line">5,3,9,6,5,9,7,3,5,2</span>--}}
{{--                                        <h5><strong>{{$compositeProductProduct->views}}</strong> Views</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>--}}
{{--                                        <h5><strong>240</strong> Followers</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


        {{-- Product details  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$compositeProduct->user->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 {{$compositeProduct->status->label}}">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-ellipsis-v fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$compositeProduct->status->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-plus-square fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$compositeProduct->created_at}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-scissors fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$compositeProduct->updated_at}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
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
                                                    @can('view sales')
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
                                                                            @can('view sale')
                                                                                <a href="{{ route('business.sale.show', ['portal'=>$institution->portal, 'id'=>$sale->sale_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                            @endcan
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
                                                    @endcan
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
