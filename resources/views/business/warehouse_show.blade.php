@extends('business.layouts.app')

@section('title', 'Warehouse')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/slick/slick-theme.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Warehouse</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                Inventory
            </li>
            <li>
                <a href="{{route('business.warehouses',$institution->portal)}}">Warehouses</a>
            </li>
            <li class="active">
                <strong>Warehouse</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="{{route('business.product.edit',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-outline btn-primary"><i class="fa fa-pencil"></i> Edit </a>
        </div>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Warehouse Update <small>Form</small></h5>
                    
                </div>

                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('business.warehouse.update',['portal'=>$institution->portal,'id'=>$warehouse->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                            <div class="col-md-12">

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="has-warning">
                                            <input type="text" id="name" name="name" required="required" value="{{$warehouse->name}}" class="form-control input-lg">
                                            <i>name</i>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" id="street" name="street" required="required" value="{{$warehouse->address->street}}" class="form-control input-lg">
                                            <i>street</i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="town" id="town" class="form-control input-lg" value="{{$warehouse->address->town}}">
                                            <i>town</i>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" id="po_box" name="po_box" required="required" value="{{$warehouse->address->po_box}}" class="form-control input-lg">
                                            <i>po box</i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="postal_code" id="postal_code" class="form-control input-lg" value="{{$warehouse->address->postal_code}}">
                                            <i>postal code</i>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" id="address_line_1" name="address_line_1" required="required" value="{{$warehouse->address->address_line_1}}" class="form-control input-lg">
                                            <i>address line 1</i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="address_line_2" id="address_line_2" class="form-control input-lg" value="{{$warehouse->address->address_line_2}}">
                                            <i>address line 2</i>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" id="email" name="email" required="required" value="{{$warehouse->address->email}}" class="form-control input-lg">
                                            <i>email</i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="phone_number" id="phone_number" class="form-control input-lg" value="{{$warehouse->address->phone_number}}">
                                            <i>phone number</i>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <hr>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('UPDATE') }}</button>
                                </div>
                            </div>


                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  Warehouse details  --}}
    <div class="row">
        <div class="col-lg-3">
            <div class="widget style1 navy-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-cloud fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> Products </span>
                        <h2 class="font-bold">{{$warehouse->inventories_count}}</h2>
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
                                    {{--  <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>  --}}
                                    <h2>{{$warehouse->name}}</h2>
                                </div>
                                <dl class="dl-horizontal">
                                    <dt>Status:</dt> <dd><span class="label label-primary">{{$warehouse->status->name}}</span></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <dl class="dl-horizontal">

                                    <dt>Created by:</dt> <dd>{{$user->name}}</dd>

                                </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                                <dl class="dl-horizontal" >

                                    <dt>Last Updated:</dt> <dd>{{$warehouse->updated_at}}</dd>
                                    <dt>Created:</dt> <dd>{{$warehouse->created_at}}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <dl class="dl-horizontal">
                                <dt>Address:</dt>
                                <dd>
                                    <address class="m-t-md">
                                        {{$warehouse->address->town}}, {{$warehouse->address->street}}<br>
                                        P. O. Box {{$warehouse->address->po_box}}, {{$warehouse->address->postal_code}}.<br>
                                        <abbr title="Phone">P:</abbr> {{$warehouse->address->phone_number}}<br>
                                        <abbr title="Email">E:</abbr> {{$warehouse->address->email}}
                                    </address>
                                </dd>
                            </dl>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <dl class="dl-horizontal">
                                    <dt>Volume:</dt>
                                    <dd>
                                        <div class="progress progress-striped active m-b-sm">
                                            <div style="width: 60%;" class="progress-bar"></div>
                                        </div>
                                        <small>Project completed in <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#inventory" data-toggle="tab">Inventory</a></li>
                                                <li class=""><a href="#adjustments" data-toggle="tab">Adjustments</a></li>
                                                <li class=""><a href="#source-transfer-orders" data-toggle="tab">Source Transfer orders</a></li>
                                                <li class=""><a href="#destination-transfer-orders" data-toggle="tab">Destination Transfer orders</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="inventory">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Last Updated</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($inventories as $inventory)
                                                            <tr class="gradeX">
                                                                <td>{{$inventory->product->name}}</td>
                                                                <td>{{$inventory->quantity}}
                                                                </td>
                                                                <td>{{$inventory->updated_at}}</td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Last Updated</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="adjustments">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Description</th>
                                                            <th>Account</th>
                                                            <th>Type</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($inventoryAdjustments as $inventoryAdjustment)
                                                            <tr class="gradeX">
                                                                <td>
                                                                    {{$inventoryAdjustment->inventory_adjustment_number}}
                                                                </td>
                                                                <td>
                                                                    {{$inventoryAdjustment->date}}
                                                                </td>
                                                                <td>
                                                                    {{$inventoryAdjustment->reason}}
                                                                </td>
                                                                <td>
                                                                    {{$inventoryAdjustment->description}}
                                                                </td>
                                                                <td>
                                                                    {{$inventoryAdjustment->account->name}}
                                                                </td>
                                                                <td>
                                                                   @if($inventoryAdjustment->is_value_adjustment == 1)
                                                                        <p><span class="label label-info">Value</span></p>
                                                                   @else
                                                                        <p><span class="label label-info">Quantity</span></p>
                                                                   @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('business.inventory.adjustment.show', ['portal'=>$institution->portal,'id'=>$inventoryAdjustment->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Description</th>
                                                            <th>Account</th>
                                                            <th>Type</th>
                                                            <th>Action</th>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="source-transfer-orders">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Destination</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($sourceTransferOrders as $sourceTransferOrder)
                                                            <tr class="gradeX">
                                                                <td>{{$sourceTransferOrder->transfer_order_number}}</td>
                                                                <td>
                                                                    {{$sourceTransferOrder->date}}
                                                                </td>
                                                                <td>
                                                                    {{$sourceTransferOrder->reason}}
                                                                </td>
                                                                <td>
                                                                    {{$sourceTransferOrder->destination_warehouse->name}}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('business.transfer.order.show', ['portal'=>$institution->portal,'id'=>$sourceTransferOrder->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Destination</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="destination-transfer-orders">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Destination</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($destinationTransferOrders as $destinationTransferOrder)
                                                            <tr class="gradeX">
                                                                <td>{{$destinationTransferOrder->transfer_order_number}}</td>
                                                                <td>
                                                                    {{$destinationTransferOrder->date}}
                                                                </td>
                                                                <td>
                                                                    {{$destinationTransferOrder->reason}}
                                                                </td>
                                                                <td>
                                                                    {{$destinationTransferOrder->source_warehouse->name}}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('business.transfer.order.show', ['portal'=>$institution->portal,'id'=>$destinationTransferOrder->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Destination</th>
                                                            <th>Action</th>
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
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- slick carousel-->
<script src="{{ asset('inspinia') }}/js/plugins/slick/slick.min.js"></script>

<script>
    $(document).ready(function(){


        $('.product-images').slick({
            dots: true
        });

    });

</script>

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

@endsection
