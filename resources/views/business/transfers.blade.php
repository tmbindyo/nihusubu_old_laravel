@extends('business.layouts.app')

@section('title', 'Transfers')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Transfers</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Settings
                </li>
                <li class="active">
                    <strong>Transfers</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-3">
            <div class="title-action">
                @can('add transfer')
                    <a href="{{route('business.transfer.create',['portal'=>$institution->portal, 'id'=>$institution->portal])}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Transfer </a>
                @endcan
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Transfers</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Source Account</th>
                                    <th>Destination Account</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transfers as $transfer)
                                    <tr class="gradeX">
                                        <td>
                                            {{$transfer->reference}}
                                            <span><i data-toggle="tooltip" data-placement="right" title="{{$transfer->notes}}." class="fa fa-facebook-messenger"></i></span>
                                        </td>
                                        <td>{{$transfer->amount}}</td>
                                        <td>{{$transfer->date}}</td>
                                        <td>

                                            <span class="label label-success"> {{$transfer->sourceAccount->name}}</span>
                                            <span class="badge badge-success"> {{$transfer->source_initial_amount}} -> {{$transfer->source_subsequent_amount}}</span>
                                        </td>
                                        <td>

                                            <span class="label label-success"> {{$transfer->destinationAccount->name}}</span>
                                            <span class="badge badge-success"> {{$transfer->destination_initial_amount}} -> {{$transfer->destination_subsequent_amount}}</span>
                                        </td>
                                        <td>{{$transfer->user->name}}</td>
                                        <td>
                                            <span class="label {{$transfer->status->label}}">{{$transfer->status->name}}</span>
                                        </td>

                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('view transfer')
                                                    <a href="{{ route('business.transfer.show', ['portal'=>$institution->portal, 'id'=>$transfer->id]) }}" class="btn-white btn btn-xs">View</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Source Account</th>
                                    <th>Destination Account</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
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
                    {extend: 'excel',
                        title: 'Transfers',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {extend: 'pdf',
                        title: 'Transfers',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
