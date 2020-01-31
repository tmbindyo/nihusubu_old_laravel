@extends('business.layouts.app')

@section('title', 'Leave')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Leave</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="#">Human Resource</a>
            </li>
            <li class="active">
                <strong>Leave</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="{{route('business.product.group.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    {{--  transaction summary  --}}
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Transaction Summary</h5>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Applied At</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>For</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Remark</th>
                    <th>Department</th>
                    <th>Branch</th>
                </tr>
            </thead>
            <tbody>
                <tr class="gradeA">
                    <td>akigen</td>
                    <td>Andrew Kigen Cheruiyot</td>
                    <td>2019-10-03</td>
                    <td>ANNUAL</td>
                    <td>2019-10-03</td>
                    <td>2018-10-07</td>
                    <td>3.00 Days</td>
                    <td>
                        <span class="label label-primary">Approved</span>
                    </td>
                    <td>Personal</td>
                    <td></td>
                    <td>Development</td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Applied At</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>For</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Remark</th>
                    <th>Department</th>
                    <th>Branch</th>
                </tr>
            </tfoot>
            </table>
                </div>

            </div>
        </div>
    </div>
    </div>

    {{--  entitlment summary  --}}
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Entitlement Summary</h5>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Balance</th>
                    <th>Earned</th>
                    <th>Carried Over</th>
                    <th>Entitled</th>
                    <th>Taken</th>
                </tr>
            </thead>
            <tbody>
                <tr class="gradeA">
                    <td>akigen</td>
                    <td>Andrew Kigen Cheruiyot</td>
                    <td>2019-09-17</td>
                    <td>ANNUAL</td>
                    <td>2019-10-07</td>
                    <td>3.00 Days</td>
                    <td>Ap</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Stock on Hand</th>
                    <th>Reorder Level</th>
                    <th>Carried Over</th>
                    <th>Entitled</th>
                    <th>Taken</th>
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

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('gentelella') }}/build/js/custom.min.js"></script>

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
