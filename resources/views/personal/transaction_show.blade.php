@extends('personal.layouts.app')

@section('title', 'Transaction')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection



@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Transaction</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li class="active">
                    <strong>Settings's</strong>
                </li>
                <li class="active">
                   <a href="{{route('personal.accounts')}}"><strong>Transaction's</strong></a>
                </li>
                <li class="active">
                    <strong>Transaction</strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Transaction <small>edit</small></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <form method="post" action="{{ route('personal.account.update',$account->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                    <div class="row">
                                        <div class="has-warning">
                                            <input type="name" name="name" value="{{$account->name}}" class="form-control input-lg">
                                        </div>
                                        <i>Transaction name</i>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="has-warning">
                                            <input type="number" name="balance" value="{{$account->balance}}" class="form-control input-lg" readonly>
                                        </div>
                                        <i>Transaction balance</i>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-primary btn-block btn-lg m-t-n-xs" type="submit"><strong>Update</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  account adjustments  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Adjustments</h5>
                    <div class="ibox-tools">
                        <a href="{{route('personal.account.adjustment.create',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> New </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Initial</th>
                    <th>Subsequent</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Status</th>
                    <th width="13em">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($account->accountAdjustments as $adjustments)
                    <tr class="gradeX">
                        <td>
                            {{$adjustments->reference}}
                            <span><i data-toggle="tooltip" data-placement="right" title="{{$adjustments->notes}}." class="fa fa-facebook-messenger"></i></span>
                        </td>
                        <td>{{$adjustments->amount}}</td>
                        <td>{{$adjustments->initial_account_amount}}</td>
                        <td>{{$adjustments->subsequent_account_amount}}</td>
                        <td>{{$adjustments->date}}</td>
                        <td>{{$adjustments->user->name}}</td>
                        <td>
                            <span class="label {{$adjustments->status->label}}">{{$adjustments->status->name}}</span>
                        </td>
                        <td class="text-right">
{{--                                todo check why route is album but id is album type--}}
                            <div class="btn-group">
                                @if($adjustments->status_id == "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")
                                    <a href="{{ route('personal.account.adjustment.delete', $adjustments->id) }}" class="btn-danger btn btn-xs">Delete</a>
                                @elseif($adjustments->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                    <a href="{{ route('personal.account.adjustment.restore', $adjustments->id) }}" class="btn-warning btn btn-xs">Restore</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Initial</th>
                    <th>Subsequent</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Status</th>
                    <th width="13em">Action</th>
                </tr>
                </tfoot>
                </table>
                    </div>

                </div>
            </div>
        </div>
        </div>

        {{--  withdrawals  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Withdrawals</h5>
                    <div class="ibox-tools">
                        <a href="{{route('personal.account.withdrawal',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> New </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th width="13em">Action</th>
                                </tr>
                            </thead>
                        <tbody>
                        @foreach($account->sourceAccount as $transaction)
                            <tr class="gradeX">
                                <td>
                                    {{$transaction->reference}}
                                    <span><i data-toggle="tooltip" data-placement="right" title="{{$transaction->notes}}." class="fa fa-facebook-messenger"></i></span>
                                </td>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$transaction->destinationAccount->name}}</td>
                                <td>{{$transaction->date}}</td>
                                <td>{{$transaction->user->name}}</td>
                                <td>
                                    <span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span>
                                </td>
                                <td class="text-right">
        {{--                                todo check why route is album but id is album type--}}
                                    <div class="btn-group">
                                        @if($transaction->id == "ca64a5e0-d39b-4f2c-a136-9c523d935ea4")
                                            <a href="{{ route('personal.client.proof.show', $transaction->id) }}" class="btn-white btn btn-xs">View</a>
                                        @elseif($transaction->id == "6fdf4858-01ce-43ff-bbe6-827f09fa1cef")
                                            <a href="{{ route('personal.personal.album.show', $transaction->id) }}" class="btn-white btn btn-xs">View</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Destination</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Status</th>
                            <th width="13em">Action</th>
                        </tr>
                        </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>

        {{--  deposits  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Deposits</h5>
                        <div class="ibox-tools">
                            <a href="{{route('personal.account.deposit',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> New </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th width="13em">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($account->destinationAccount as $transaction)
                                    <tr class="gradeX">
                                        <td>
                                            {{$transaction->reference}}
                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$transaction->notes}}." class="fa fa-facebook-messenger"></i></span>
                                        </td>
                                        <td>{{$transaction->amount}}</td>
                                        <td>{{$transaction->sourceAccount->name}}</td>
                                        <td>{{$transaction->date}}</td>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>
                                            <span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span>
                                        </td>
                                        <td class="text-right">
                                            {{--                                todo check why route is album but id is album type--}}
                                            <div class="btn-group">
                                                @if($transaction->id == "ca64a5e0-d39b-4f2c-a136-9c523d935ea4")
                                                    <a href="{{ route('personal.client.proof.show', $transaction->id) }}" class="btn-white btn btn-xs">View</a>
                                                @elseif($transaction->id == "6fdf4858-01ce-43ff-bbe6-827f09fa1cef")
                                                    <a href="{{ route('personal.personal.album.show', $transaction->id) }}" class="btn-white btn btn-xs">View</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th width="13em">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{--  payments  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payments</h5>
                        <div class="ibox-tools">
                            <a href="{{route('personal.account.deposit',$account->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> New </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th width="13em">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($account->transactions as $transaction)
                                    <tr class="gradeX">
                                        <td>
                                            {{$transaction->reference}}
                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$transaction->notes}}." class="fa fa-facebook-messenger"></i></span>
                                        </td>
                                        <td>{{$transaction->amount}}</td>
                                        <td>{{$transaction->account->name}}</td>
                                        <td>{{$transaction->date}}</td>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>
                                            <span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span>
                                        </td>
                                        <td class="text-right">
                                            {{--                                todo check why route is album but id is album type--}}
                                            <div class="btn-group">
                                                <a href="{{ route('personal.expense.show', $transaction->expense_id) }}" class="btn-white btn btn-xs">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th width="13em">Action</th>
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

@include('personal.layouts.modals.transaction_to_do')

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
