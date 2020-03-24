@extends('business.layouts.app')

@section('title', 'Payroll')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-4">
            <h2>Payroll</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="#">Human Resource</a>
                </li>
                <li class="active">
                    <strong>Payroll</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-8">
            <div class="title-action">
                <a href="{{route('business.payroll.annual.salary.statement',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-book"></i> Annual Salary Statement </a>
                <a href="{{route('business.payroll.history',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-archive"></i> Payroll History </a>
                <a href="{{route('business.payroll.process',$institution->portal)}}" class="btn btn-danger btn-outline"><i class="fa fa-send"></i> Process Payroll </a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        {{--  employee list  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Employee List</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
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
                        <th>Position</th>
                        <th>Basic Salary</th>
                        <th>Effective Date</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>akigen</td>
                        <td>Andrew Kigen Cheruiyot</td>
                        <td>Head of Creatives</td>
                        <td>16100.00</td>
                        <td>2018-07-01</td>
                        <td>
                            <span class="label label-primary">Confirmed</span>
                        </td>
                        <td>2018-07-01</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="{{ route('business.payroll.salary.adjustment', 1) }}" class="btn-info btn-outline btn btn-xs">Salary Adjustment</a>
                                <a href="{{ route('business.employee.payroll.history', 1) }}" class="btn-info btn-outline btn btn-xs">History</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Basic Salary</th>
                        <th>Effective Date</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                </table>
                    </div>

                </div>
            </div>
        </div>
        </div>

        {{--  variable pay  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Variable Pay Settings</h5>
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
                        <th>Code</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Amount Mode</th>
                        <th>Qty Mode</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>Food</td>
                        <td>Food allowance</td>
                        <td>5000.00</td>
                        <td>1</td>
                        <td></td>
                        <td>Fixed Amount</td>
                        <td>Fixed Quantity</td>
                        <td>
                            <span class="label label-primary">Active</span>
                        </td>
                        <td>2018-07-01</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                <a href="{{ route('business.variable.pay.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Amount Mode</th>
                        <th>Qty Mode</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                </table>
                    </div>

                </div>
            </div>
        </div>
        </div>

        {{--  variable deduction  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Variable Deduction Settings</h5>
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
                        <th>Code</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Amount Mode</th>
                        <th>Qty Mode</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>PAYE</td>
                        <td>Pay As You Earn</td>
                        <td>400.00</td>
                        <td>1</td>
                        <td></td>
                        <td>Fixed Amount</td>
                        <td>Fixed Quantity</td>
                        <td>
                            <span class="label label-primary">Active</span>
                        </td>
                        <td>2018-07-01</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                <a href="{{ route('business.variable.deduction.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Amount Mode</th>
                        <th>Qty Mode</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                </table>
                    </div>

                </div>
            </div>
        </div>
        </div>

        {{--  bonus  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bonus Settings</h5>
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
                        <th>Code</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Amount Mode</th>
                        <th>Qty Mode</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>Customer Acquisition</td>
                        <td>Percentage of contract brought</td>
                        <td>400.00</td>
                        <td>1</td>
                        <td></td>
                        <td>Fixed Amount</td>
                        <td>Fixed Quantity</td>
                        <td>
                            <span class="label label-primary">Active</span>
                        </td>
                        <td>2018-07-01</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                <a href="{{ route('business.variable.deduction.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Amount Mode</th>
                        <th>Qty Mode</th>
                        <th>Status</th>
                        <th>Modified</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                </table>
                    </div>

                </div>
            </div>
        </div>
        </div>

        {{--  statutory contribution  --}}
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Statutory Contribution Settings</h5>
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
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Employer</th>
                                    <th>Amount Type</th>
                                    <th>Employee</th>
                                    <th>Amount Type</th>
                                    <th>Status</th>
                                    <th>Modified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeA">
                                    <td>Income Tax</td>
                                    <td>Employee income tax</td>
                                    <td>0</td>
                                    <td>Not Applicable</td>
                                    <td>16</td>
                                    <td>% Gross Income</td>
                                    <td>
                                        <span class="label label-primary">Active</span>
                                    </td>
                                    <td>2018-07-01</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                            <a href="{{ route('business.variable.deduction.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Employer</th>
                                    <th>Amount Type</th>
                                    <th>Employee</th>
                                    <th>Amount Type</th>
                                    <th>Status</th>
                                    <th>Modified</th>
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
