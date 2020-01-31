@extends('personal.layouts.app')

@section('title', ' Expenses')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Expense</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('personal.expenses')}}">Expenses</a>
                </li>
                <li class="active">
                    <strong>Expense</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="{{route('personal.expense.create')}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Expenses</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
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
                                    <th class="text-right" width="35px" data-sort-ignore="true">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $expense)
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
                                                <p><a href="{{route('personal.inventory.adjustment',$expense->inventory_adjustment_id)}}" class="badge badge-success">Inventory Adjustment</a></p>
                                            @elseif($expense->is_transfer_order == 1)
                                                <p><a href="{{route('personal.transfer.order.show',$expense->transfer_order_id)}}" class="badge badge-primary">Transfer Order</a></p>
                                            @elseif($expense->is_warehouse == 1)
                                                <p><a href="{{route('personal.warehouse.show',$expense->warehouse_id)}}" class="badge badge-primary">Warehouse</a></p>
                                            @elseif($expense->is_campaign == 1)
                                                <p><a href="{{route('personal.campaign.show',$expense->campaign_id)}}" class="badge badge-primary">Campaign</a></p>
                                            @elseif($expense->is_sale == 1)
                                                <p><a href="{{route('personal.sale.show',$expense->sale_id)}}" class="badge badge-primary">Sale</a></p>
                                            @elseif($expense->is_liability == 1)
                                                <p><a href="{{route('personal.liability.show',$expense->liability_id)}}" class="badge badge-primary">Liability</a></p>
                                            @elseif($expense->is_transfer == 1)
                                                <p><a href="{{route('personal.transfer.show',$expense->transfer_id)}}" class="badge badge-primary">Transfer</a></p>
                                            @elseif($expense->is_transaction == 1)
                                                <p><a href="{{route('personal.transaction.show',$expense->transaction_id)}}" class="badge badge-primary">Transaction</a></p>
                                            @else
                                                <p><span class="badge badge-info">None</span></p>
                                            @endif
                                        </td>
                                        <td>{{$expense->reference}}</td>
                                        <td>{{$expense->date}}</td>
                                        <td>{{$expense->created_at}}</td>
                                        <td>@if ($expense->expense_account){{$expense->expense_account->name}} @endif</td>
                                        <td>{{$expense->total}}</td>
                                        <td>{{$expense->paid}}</td>
                                        <td>
                                            <p><span class="label {{$expense->status->label}}">{{$expense->status->name}}</span></p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('personal.expense.show', $expense->id) }}" class="btn-success btn-outline btn btn-xs">View</a>
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
                                    <th class="text-right" width="35px" data-sort-ignore="true">Action</th>
                                </tr>
                                </tfoot>
                            </table>
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

    <!-- Datatables -->
    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>


    {{--  Data tables  --}}
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

    </script>
@endsection
