@extends('business.layouts.app')

@section('title', 'Payment Schedule Show')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Payment Schedules</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('business.calendar',$institution->portal)}}">Home</a></strong>
                </li>
                <li class="active">
                    <strong><a href="{{route('business.settings',$institution->portal)}}">Settings</a></strong>
                </li>
                <li class="active">
                    <strong>Payment Schedule {{$paymentSchedule->name}} [{{$paymentSchedule->period}}]</strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payment Schedule <small>edit</small></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Edit.</p>
                                <form method="post" action="{{ route('business.payment.schedule.update',['portal'=>$institution->portal, 'id'=>$paymentSchedule->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                    <div class="has-warning">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                        <input type="name" name="name" value="{{$paymentSchedule->name}}" class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                        <i>name</i>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('period'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('period') }}</strong>
                                        </span>
                                        @endif
                                        <input type="period" name="period" value="{{$paymentSchedule->period}}" class="form-control input-lg {{ $errors->has('period') ? ' is-invalid' : '' }}">
                                        <i>name</i>
                                    </div>
                                    @can('edit payment schedule')
                                        <hr>
                                        <div>
                                            <button class="btn btn-lg btn-primary btn-block btn-outline m-t-n-xs" type="submit"><strong>Update</strong></button>
                                        </div>
                                    @endcan
                                </form>
                            </div>
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
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$paymentSchedule->user->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 {{$paymentSchedule->status->label}}">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-ellipsis-v fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$paymentSchedule->status->name}}</h3>
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
                                                <h3 class="font-bold">{{$paymentSchedule->created_at}}</h3>
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
                                                <h3 class="font-bold">{{$paymentSchedule->updated_at}}</h3>
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
                                                    <li class="active"><a href="#expenses" data-toggle="tab">Expenses</a></li>
                                                    <li class=""><a href="#sales" data-toggle="tab">Sales</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="expenses">
                                                    @can('view expenses')
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover dataTables-expenses" >
                                                                <thead>
                                                                <tr>
                                                                    <th>Recurring</th>
                                                                    <th>Type</th>
                                                                    <th>Expense #</th>
                                                                    <th>Date</th>
                                                                    <th>Created</th>
                                                                    <th>Expense Account</th>
                                                                    <th>Total</th>
                                                                    <th>Paid</th>
                                                                    <th>Status</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($paymentSchedule->expenses as $expense)
                                                                    <tr class="gradeA">
                                                                        <td>
                                                                            @if($expense->is_recurring == 1)
                                                                                <p><span class="badge badge-success">True</span></p>
                                                                            @else
                                                                                <p><span class="badge badge-success">False</span></p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($expense->is_inventory_adjustment == 1)
                                                                                <p><a @can('view inventory adjustment') href="{{route('business.inventory.adjustment',['portal'=>$institution->portal, 'id'=>$expense->inventory_adjustment_id])}}" @endcan class="badge badge-success">Inventory Adjustment</a></p>
                                                                            @elseif($expense->is_transfer_order == 1)
                                                                                <p><a @can('view transfer order') href="{{route('business.transfer.order.show',['portal'=>$institution->portal, 'id'=>$expense->transfer_order_id])}}" @endcan class="badge badge-primary">Transfer Order</a></p>
                                                                            @elseif($expense->is_warehouse == 1)
                                                                                <p><a @can('view warehouse') href="{{route('business.warehouse.show',['portal'=>$institution->portal, 'id'=>$expense->warehouse_id])}}" @endcan class="badge badge-primary">Warehouse</a></p>
                                                                            @elseif($expense->is_campaign == 1)
                                                                                <p><a @can('view campaign') href="{{route('business.campaign.show',['portal'=>$institution->portal, 'id'=>$expense->campaign_id])}}" @endcan class="badge badge-primary">Campaign</a></p>
                                                                            @elseif($expense->is_sale == 1)
                                                                                <p><a @can('view sale') href="{{route('business.sale.show',['portal'=>$institution->portal, 'id'=>$expense->sale_id])}}" @endcan class="badge badge-primary">Sale</a></p>
                                                                            @elseif($expense->is_liability == 1)
                                                                                <p><a @can('view liability') href="{{route('business.liability.show',['portal'=>$institution->portal, 'id'=>$expense->liability_id])}}" @endcan class="badge badge-primary">Liability</a></p>
                                                                            @elseif($expense->is_transfer == 1)
                                                                                <p><a @can('view transfer') href="{{route('business.transfer.show',['portal'=>$institution->portal, 'id'=>$expense->transfer_id])}}" @endcan class="badge badge-primary">Transfer</a></p>
                                                                            @elseif($expense->is_transaction == 1)
                                                                                <p><a @can('view transaction') href="{{route('business.transaction.show',['portal'=>$institution->portal, 'id'=>$expense->transaction_id])}}" @endcan class="badge badge-primary">Transaction</a></p>
                                                                            @else
                                                                                <p><span class="badge badge-info">None</span></p>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$expense->reference}}</td>
                                                                        <td>{{$expense->date}}</td>
                                                                        <td>{{$expense->created_at}}</td>
                                                                        <td>@if ($expense->expenseAccount){{$expense->expenseAccount->name}} @endif</td>
                                                                        <td>{{$expense->total}}</td>
                                                                        <td>{{$expense->paid}}</td>
                                                                        <td>
                                                                            <p><span class="label {{$expense->status->label}}">{{$expense->status->name}}</span></p>
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <div class="btn-group">
                                                                                @can('view expense')
                                                                                    <a href="{{ route('business.expense.show', ['portal'=>$institution->portal, 'id'=>$expense->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                                @endcan
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Recurring</th>
                                                                    <th>Type</th>
                                                                    <th>Expense #</th>
                                                                    <th>Date</th>
                                                                    <th>Created</th>
                                                                    <th>Expense Account</th>
                                                                    <th>Total</th>
                                                                    <th>Paid</th>
                                                                    <th>Status</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
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
                                                                    <th>Sale #</th>
                                                                    <th>Date</th>
                                                                    <th>Due Date</th>
                                                                    <th>Customer</th>
                                                                    <th>Amount</th>
                                                                    <th>Paid</th>
                                                                    <th>Status</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($paymentSchedule->sales as $sale)
                                                                    <tr class="gradeA">
                                                                        <td>{{$sale->reference}}</td>
                                                                        <td>{{$sale->date}}</td>
                                                                        <td>{{$sale->due_date}}</td>

                                                                        <td>
                                                                            @if(isset($sale->contact))
                                                                                {{$sale->contact->first_name}} {{$sale->contact->last_name}}
                                                                            @else
                                                                                <span class="label label-info"> NaN </span>
                                                                            @endif
                                                                        </td>

                                                                        <td>{{$sale->total}}</td>
                                                                        <td>{{$sale->paid}}</td>
                                                                        <td>
                                                                            <p><span class="label {{$sale->status->label}}">{{$sale->status->name}}</span></p>
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <div class="btn-group">
                                                                                @can('view sale')
                                                                                    <a href="{{ route('business.sale.show', ['portal'=>$institution->portal, 'id'=>$sale->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                                @endcan
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Sale #</th>
                                                                    <th>Date</th>
                                                                    <th>Due Date</th>
                                                                    <th>Customer</th>
                                                                    <th>Amount</th>
                                                                    <th>Paid</th>
                                                                    <th>Status</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
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
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-expenses').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$paymentSchedule->name}} Expenses',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$paymentSchedule->name}} Expenses',
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

    </script>

    <script>
        $(document).ready(function(){
            $('.dataTables-sales').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$paymentSchedule->name}} Sales',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$paymentSchedule->name}} Sales',
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

    </script>

@endsection
