@extends('business.layouts.app')

@section('title', ' Transactions')

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
            <h2>Transaction</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.transactions',$institution->portal)}}">Transactions</a>
                </li>
                <li class="active">
                    <strong>Transaction</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a href="{{route('business.expenses',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Expenses </a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Transactions</h5>
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
                                    <th>Type</th>
                                    <th>Transaction #</th>
                                    <th>Date</th>
                                    <th>Created</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="gradeA">
                                        <td>
                                            @if($transaction->is_transfer == 1)
                                                <p><span class="badge badge-success">Transfer</span> {{$transaction->source_account->name}} -> {{$transaction->destination_account->name}}</p>
                                            @else
                                                <p><span class="badge badge-success">Payment</span></p>
                                            @endif
                                        </td>

                                        <td>{{$transaction->reference}}</td>
                                        <td>{{$transaction->date}}</td>
                                        <td>{{$transaction->created_at}}</td>
                                        <td>{{$transaction->amount}}</td>
                                        <td>
                                            <p><span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span></p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Type</th>
                                    <th>Transaction #</th>
                                    <th>Date</th>
                                    <th>Created</th>
                                    <th>Amount</th>
                                    <th>Status</th>
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
