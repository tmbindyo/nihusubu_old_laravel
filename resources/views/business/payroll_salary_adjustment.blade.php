@extends('business.layouts.app')

@section('title', 'Salary Adjustment')

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
        <h2>Salary Adjustment</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.products',$institution->portal)}}">Products</a>
            </li>
            <li>
                <a href="{{route('business.payroll',$institution->portal)}}">Payroll</a>
            </li>
            <li class="active">
                <strong>Salary Adjustment</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">
            <div class="profile-image">
                <img src="{{ asset('inspinia') }}/img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            Alex Smith
                        </h2>
                        <h4>Founder of Groupeq</h4>
                        <small>
                            There are many variations of passages of Lorem Ipsum available, but the majority
                            have suffered alteration in some form Ipsum available.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <table class="table small m-b-xs">
                <tbody>
                <tr>
                    <td>
                        <strong>142</strong> Projects
                    </td>
                    <td>
                        <strong>22</strong> Followers
                    </td>

                </tr>
                <tr>
                    <td>
                        <strong>61</strong> Comments
                    </td>
                    <td>
                        <strong>54</strong> Articles
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>154</strong> Tags
                    </td>
                    <td>
                        <strong>32</strong> Friends
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <small>Sales in last 24h</small>
            <h2 class="no-margins">206 480</h2>
            <div id="sparkline1"></div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>History</h5>
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
                    <th>Effective Date</th>
                    <th>Basic Salary</th>
                    <th>Currency</th>
                    <th>Remark</th>
                    <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="gradeA">
                    <td>2019-09-17</td>
                    <td>35000.00</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a href="#" class="btn-success btn-outline btn btn-xs">View</a>
                            <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Effective Date</th>
                    <th>Basic Salary</th>
                    <th>Currency</th>
                    <th>Remark</th>
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
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Sparkline -->
    <script src="{{ asset('inspinia') }}/js/plugins/sparkline/jquery.sparkline.min.js"></script>

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

    <script>
        $(document).ready(function() {


            $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 48], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#1ab394',
                fillColor: "transparent"
            });


        });
    </script>

@endsection
