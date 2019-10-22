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
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                Inventory
            </li>
            <li>
                <a href="{{route('business.warehouses')}}">Warehouses</a>
            </li>
            <li class="active">
                <strong>Warehouse</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="{{route('business.product.edit',1)}}" class="btn btn-outline btn-primary"><i class="fa fa-pencil"></i> Edit </a>
        </div>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

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
                                    <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>
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
                                                <li class="active"><a href="#updates" data-toggle="tab">Updates</a></li>
                                                <li class=""><a href="#inventory" data-toggle="tab">Inventory</a></li>
                                                <li class=""><a href="#adjustments" data-toggle="tab">Adjustments</a></li>
                                                <li class=""><a href="#source-transfer-orders" data-toggle="tab">Source Transfer orders</a></li>
                                                <li class=""><a href="#destination-transfer-orders" data-toggle="tab">Destination Transfer orders</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="updates">
                                                <div class="feed-activity-list">
                                                    <div class="feed-element">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg">
                                                        </a>
                                                        <div class="media-body ">
                                                            <small class="pull-right">2h ago</small>
                                                            <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                            <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                                            <div class="well">
                                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="feed-element">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg">
                                                        </a>
                                                        <div class="media-body ">
                                                            <small class="pull-right">2h ago</small>
                                                            <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                                            <small class="text-muted">2 days ago at 8:30am</small>
                                                        </div>
                                                    </div>
                                                    <div class="feed-element">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg">
                                                        </a>
                                                        <div class="media-body ">
                                                            <small class="pull-right text-navy">5h ago</small>
                                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                                            <div class="actions">
                                                                <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                                <a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="feed-element">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg">
                                                        </a>
                                                        <div class="media-body ">
                                                            <small class="pull-right">2h ago</small>
                                                            <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                            <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                                            <div class="well">
                                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="feed-element">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile.jpg">
                                                        </a>
                                                        <div class="media-body ">
                                                            <small class="pull-right">23h ago</small>
                                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                                        </div>
                                                    </div>
                                                    <div class="feed-element">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a7.jpg">
                                                        </a>
                                                        <div class="media-body ">
                                                            <small class="pull-right">46h ago</small>
                                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="inventory">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Last Updated</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($inventories as $inventory)
                                                            <tr class="gradeX">
                                                                <td>{{$inventory->product->name}}</td>
                                                                <td>{{$inventory->quantity}}
                                                                </td>
                                                                <td>{{$inventory->updated_at}}</td>
                                                                <td class="center">4</td>
                                                                <td class="center">X</td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Last Updated</th>
                                                            <th>Action</th>
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
                                                                    <a href="{{ route('business.inventory.adjustment.show', $inventoryAdjustment->id) }}" class="btn-success btn-outline btn btn-xs">View</a>
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
                                                                    <a href="{{ route('business.transfer.order.show', $sourceTransferOrder->id) }}" class="btn-success btn-outline btn btn-xs">View</a>
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
                                                                    <a href="{{ route('business.transfer.order.show', $destinationTransferOrder->id) }}" class="btn-success btn-outline btn btn-xs">View</a>
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
