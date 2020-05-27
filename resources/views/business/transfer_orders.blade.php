@extends('business.layouts.app')

@section('title', ' Transfer Orders')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Transfer Orders</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Inventory
                </li>
                <li class="active">
                    <strong>Transfer Orders</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="{{route('business.transfer.order.create',$institution->portal)}}" class="btn btn-outline btn-primary"><i class="fa fa-pencil"></i> New </a>
            </div>
        </div>
    </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Transfer Orders</h5>
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
                                        <th>#</th>
                                        <th width="50em">Date</th>
                                        <th>Reason</th>
                                        <th>Source</th>
                                        <th>Destination</th>
                                        <th>By</th>
                                        <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transferOrders as $transferOrder)
                                        <tr class="gradeA">
                                            <td>{{$transferOrder->transfer_order_number}}</td>
                                            <td>{{$transferOrder->created_at}}</td>
                                            <td>{{$transferOrder->reason}}</td>
                                            <td>
                                                {{$transferOrder->source_warehouse->name}}
                                            </td>
                                            <td>
                                                {{$transferOrder->destination_warehouse->name}}
                                            </td>
                                            <td>{{$transferOrder->user->name}}</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="{{route('business.transfer.order.show',['portal'=>$institution->portal,'id'=>$transferOrder->id])}}" class="btn-primary btn-outline btn btn-xs">View</a>
{{--                                                    <a href="{{route('business.transfer.order.edit',['portal'=>$institution->portal,'id'=>$transferOrder->id])}}" class="btn-warning btn-outline btn btn-xs">Edit</a>--}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th width="50em">Date</th>
                                        <th>Reason</th>
                                        <th>Source</th>
                                        <th>Destination</th>
                                        <th>By</th>
                                        <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
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
