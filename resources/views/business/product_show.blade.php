@extends('business.layouts.app')

@section('title', 'Product Show')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Product View</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.products',$institution->portal)}}">Products</a>
            </li>
            <li class="active">
                <strong>Product View</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            @can('edit product')
                <a href="{{route('business.product.edit',['portal'=>$institution->portal, 'id'=>$product->id])}}" class="btn btn-outline btn-primary"><i class="fa fa-pencil"></i> Edit </a>
            @endcan
        </div>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

    {{-- infographics --}}
    <div class="wrapper wrapper-content project-manager">

        <div class="row">

            <div class="col-md-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-dollar fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Sales </span>
                            <h2 class="font-bold">{{$product->sale_products_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Orders </span>
                            <h2 class="font-bold">{{$product->order_products_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-database fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Stock On Hand </span>
                            @if($product->is_service == "1")
                                <h2 class="font-bold">N/A</h2>
                            @else
                                        <h2 class="font-bold">{{$product->stock_on_hand->first()->stock_on_hand}}</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($product->is_service == "0")
                <div class="col-md-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-level-down fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Reorder Level </span>
                                <h2 class="font-bold">{{$product->reorder_level}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($product->is_service == "0")
                <div class="col-md-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-archive fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Restocks </span>
                                <h2 class="font-bold">{{$product->restock_count}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- product description --}}
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox product-detail">
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-5">


                            <div class="product-images">

                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 1]
                                    </div>
                                </div>
                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 2]
                                    </div>
                                </div>
                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 3]
                                    </div>
                                </div>
                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 4]
                                    </div>
                                </div>
                                <div>
                                    <div class="image-imitation">
                                        [IMAGE 5]
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="col-md-7">

                            <h2 class="font-bold m-b-xs">
                                {{$product->name}}
                            </h2>
                            <small>{{$product->unit->name}}</small>
                            <div class="m-t-md">
                                <h2 class="product-main-price">{{$institution->currency->name}} {{$product->selling_price}} <small class="text-muted">Exclude Tax</small> </h2>
                            </div>
                            <hr>

                            <h4>Product description</h4>

                            <div class="small text-muted">
                                {!!$product->description!!}
                            </div>
                            <hr>

                            {{--  todo time to complete a service  --}}

                            <div>
                                <div class="btn-group">
                                    {{-- <button class="btn btn-primary btn-sm"><i class="fa fa-cart-plus"></i> Schedule Delivery</button> --}}
                                    {{-- <a href="{{route('business.expense.create',$institution->portal)}}" class="btn btn-warning btn-sm"><i class="fa fa-cart-plus"></i> Update stock</a> --}}
                                    @can('delete product')
                                        @if ($product->status_id == 'bc6170bf-299a-44f5-8362-8cdeed1f47b0')
                                            <a href="{{ route('business.product.restore', ['portal'=>$institution->portal, 'id'=>$product->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Restore </a>
                                        @else
                                            <a href="{{ route('business.product.delete', ['portal'=>$institution->portal, 'id'=>$product->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Deactivate </a>
                                        @endif
                                    @endcan
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <div class="ibox-footer">
                    <span class="pull-right">
                        Full stock - <i class="fa fa-clock-o"></i> 14.04.2016 10:04 pm
                    </span>
                    The generated Lorem Ipsum is therefore always free
                </div>
            </div>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                {{--  <h2>Contract with Zender Company</h2>  --}}
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Status:</dt> <dd><span class="label {{$product->status->label}}">{{$product->status->name}}</span></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">

                                <dt>Created by:</dt> <dd>{{$product->user->name}}</dd>
                                <dt>Stock Keeping Unit:</dt> <dd>  {{$product->unit->name}}</dd>
                            </dl>
                        </div>
                        <div class="col-lg-7" id="cluster_info">
                            <dl class="dl-horizontal" >

                                <dt>Last Updated:</dt> <dd>{{$product->updated_at}}</dd>
                                <dt>Created:</dt> <dd> 	{{$product->created_at}} </dd>

                            </dl>
                        </div>
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#stock" data-toggle="tab">Stock</a></li>
                                            <li class=""><a href="#sales" data-toggle="tab">Sales</a></li>
                                            <li class=""><a href="#restock" data-toggle="tab">Restock</a></li>
                                            <li class=""><a href="#inventory-adjustments" data-toggle="tab">Inventory Adjustments</a></li>
                                            <li class=""><a href="#transfer-orders" data-toggle="tab">Transfer Orders</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
                                        {{--  to do show stock from different warehouses  --}}
                                        <div class="tab-pane active" id="stock">
                                            @can('view stock')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-stock" >
                                                        <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Quantity</th>
                                                            <th>Warehouse</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($product->inventory as $inventory)
                                                            <tr class="gradeX">
                                                                <td>{{$inventory->date}}</td>
                                                                <td>{{$inventory->quantity}}</td>
                                                                <td class="center">{{$inventory->warehouse->name}}</td>
                                                                <td class="center"><span class="label {{$inventory->status->label}}">{{$inventory->status->name}}</span></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Quantity</th>
                                                            <th>Rate</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            @endcan
                                        </div>
                                        <div class="tab-pane" id="sales">
                                            @can('view sales')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-sales" >
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
                                                        @foreach($product->saleProducts as $sale)
                                                            <tr class="gradeX">
                                                                <td>{{$sale->created_at}}</td>
                                                                <td>{{$sale->quantity}}</td>
                                                                <td class="center">{{$sale->rate}}</td>
                                                                <td class="center"> <span class="label {{$sale->status->label}}">{{$sale->status->name}}</span></td>
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
                                            @endcan
                                        </div>
                                        <div class="tab-pane" id="restock">
                                            @can('view restock')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-restock" >
                                                        <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Initial Quantity</th>
                                                            <th>Restock Quantity</th>
                                                            <th>Total Value</th>
                                                            <th>Subsequent Quantity</th>
                                                            <th>Restock</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($product->restock as $restock)
                                                            <tr class="gradeX">
                                                                <td>{{$restock->created_at}}</td>
                                                                <td>{{$restock->initial_warehouse_amount}}</td>
                                                                <td>{{$restock->quantity}}</td>
                                                                <td>{{$restock->total_value}}</td>
                                                                <td class="center">{{$restock->subsequent_warehouse_amount}}</td>
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        @if($restock->is_opening_stock == 0)
                                                                            <a href="{{ route('business.expense.show', ['portal'=>$institution->portal, 'id'=>$restock->expenseItem->expense_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                        @else
                                                                            <p><span class="label label-info">Opening Stock</span></p>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Initial Quantity</th>
                                                            <th>Restock Quantity</th>
                                                            <th>Total Value</th>
                                                            <th>Subsequent Quantity</th>
                                                            <th>Restock</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            @endcan
                                        </div>
                                        <div class="tab-pane" id="inventory-adjustments">
                                            @can('view inventory adjustments')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-inventory-adjustments" >
                                                        <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Initial</th>
                                                            <th>Adjustment</th>
                                                            <th>Subsequent</th>
                                                            <th>Adjustment Type</th>
                                                            <th>Adjustment</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($product->inventoryAdjustmentProducts as $inventory_adjustment_product)
                                                            <tr class="gradeX">
                                                                <td>{{$inventory_adjustment_product->created_at}}</td>
                                                                {{--  Quantity based  --}}
                                                                @if($inventory_adjustment_product->inventoryAdjustment->is_value_adjustment == 0)
                                                                    <td>{{$inventory_adjustment_product->initial_quantity}}</td>
                                                                    <td>{{$inventory_adjustment_product->subsequent_quantity}}</td>
                                                                    <td>{{$inventory_adjustment_product->quantity}}</td>
                                                                    <td><p><span class="label label-info">Quantity Based</span></p></td>
                                                                {{--  Value based  --}}
                                                                @else
                                                                    <td>{{$inventory_adjustment_product->initial_warehouse_value}}</td>
                                                                    <td>{{$inventory_adjustment_product->subsequent_warehouse_value}}</td>
                                                                    <td>{{$inventory_adjustment_product->value}}</td>
                                                                    <td><p><span class="label label-info">Value Based</span></p></td>
                                                                @endif
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('business.inventory.adjustment.show', ['portal'=>$institution->portal, 'id'=>$inventory_adjustment_product->inventory_adjustment_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Initial</th>
                                                            <th>Adjustment</th>
                                                            <th>Subsequent</th>
                                                            <th>Adjustment Type</th>
                                                            <th>Adjustment</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            @endcan
                                        </div>
                                        <div class="tab-pane" id="transfer-orders">
                                            @can('view transfer orders')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-transfer-orders" >
                                                        <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Source Warehouse</th>
                                                            <th>Source Initial</th>
                                                            <th>Source Subsequent</th>
                                                            <th>Destination Warehouse</th>
                                                            <th>Destination Initial</th>
                                                            <th>Destination Subsequent</th>
                                                            <th>Quantity</th>
                                                            <th>Transfer Order</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($product->transferOrderProducts as $transfer_order_product)
                                                            <tr class="gradeX">
                                                                <td>{{$transfer_order_product->created_at}}</td>
                                                                {{--  Quantity based  --}}
                                                                <td>{{$transfer_order_product->transferOrder->sourceWarehouse->name}}</td>
                                                                <td>{{$transfer_order_product->source_warehouse_initial_amount}}</td>
                                                                <td>{{$transfer_order_product->source_warehouse_subsequent_amount}}</td>
                                                                <td>{{$transfer_order_product->transferOrder->destinationWarehouse->name}}</td>
                                                                <td>{{$transfer_order_product->destination_warehouse_initial_amount}}</td>
                                                                <td>{{$transfer_order_product->destination_warehouse_subsequent_amount}}</td>
                                                                <td>{{$transfer_order_product->quantity}}</td>
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('business.transfer.order.show', ['portal'=>$institution->portal, 'id'=>$transfer_order_product->transfer_order_id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Source Warehouse</th>
                                                            <th>Source Initial</th>
                                                            <th>Source Subsequent</th>
                                                            <th>Destination Warehouse</th>
                                                            <th>Destination Initial</th>
                                                            <th>Destination Subsequent</th>
                                                            <th>Quantity</th>
                                                            <th>Transfer Order</th>
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
        $('.dataTables-stock').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$product->name}}',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$product->name}}',
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
        $('.dataTables-sales').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: '{{$product->name}} Sales',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf', title: '{{$product->name}} Sales',
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
        $('.dataTables-restock').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$product->name}} Restocks',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$product->name}} Restocks',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
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
        $('.dataTables-inventory-adjustments').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$product->name}} Inventory Adjustments',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$product->name}} Inventory Adjustments',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
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
        $('.dataTables-transfer-orders').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$product->name}} Transfer Orders',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$product->name}} Transfer Orders',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
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
