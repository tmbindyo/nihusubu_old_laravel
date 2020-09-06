@extends('admin.layouts.app')

@section('title', 'Module')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-3">
            <h2>Module's</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('admin.dashboard')}}">Home</a></strong>
                </li>
                <li>
                    <strong><a href="{{route('admin.modules')}}">Modules</a></strong>
                </li>
                <li class="active">
                    <strong>Module</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-9">

        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="row">
            <div class="col-lg-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Module <small>edit</small></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('admin.module.update',$module->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="has-warning">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                                @endif
                                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12 input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" required="required" value="{{$module->name}}">
                                                <i>name</i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="has-warning">
                                                @if ($errors->has('price'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                                @endif
                                                <input type="number" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12 input-lg {{ $errors->has('price') ? ' is-invalid' : '' }}" required="required" value="{{$module->price}}">
                                                <i>price</i>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            @if ($errors->has('is_business'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('is_business') }}</strong>
                                                </span>
                                            @endif
                                            <div class="checkbox">
                                                <input id="is_business" name="is_business" type="checkbox" class="{{ $errors->has('is_business') ? ' is-invalid' : '' }}" @if($module->is_business) checked @endif>
                                                <label for="is_business">Business</label> <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-x text-warning fa-question-circle"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            @if ($errors->has('is_user'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('is_user') }}</strong>
                                                </span>
                                            @endif
                                            <div class="checkbox">
                                                <input id="is_user" name="is_user" type="checkbox" class="{{ $errors->has('is_user') ? ' is-invalid' : '' }}" @if($module->is_user) checked @endif>
                                                <label for="is_user">user</label> <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-x text-warning fa-question-circle"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            @if ($errors->has('is_paid'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('is_paid') }}</strong>
                                                </span>
                                            @endif
                                            <div class="checkbox">
                                                <input id="is_paid" name="is_paid" type="checkbox" class="{{ $errors->has('is_paid') ? ' is-invalid' : '' }}" @if($module->is_paid) checked @endif>
                                                <label for="is_paid">Paid</label> <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the item is eligible for sales return." class="fa fa-x text-warning fa-question-circle"></i></span>
                                            </div>
                                        </div>


                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <br>
                                        <hr>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--  details  --}}
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
                                                <h3 class="font-bold">{{$module->user->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 {{$module->status->label}}">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-ellipsis-v fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$module->status->name}}</h3>
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
                                                <h3 class="font-bold">{{$module->created_at}}</h3>
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
                                                <h3 class="font-bold">{{$module->updated_at}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{-- <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#loans" data-toggle="tab">Loan</a></li>
                                            <li class=""><a href="#sales" data-toggle="tab">Sales</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
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
                                                        @foreach($sales as $sale)
                                                            <tr class="gradeX">
                                                                <td>{{$sale->reference}}</td>
                                                                <td>{{$sale->date}}</td>
                                                                <td>{{$sale->due_date}}</td>

                                                                <td>
                                                                    @if($sale->module)
                                                                        {{$sale->module->first_name}} {{$sale->module->last_name}}
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

                                        <div class="tab-pane active" id="loans">
                                            @can('view loans')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-loans" >
                                                        <thead>
                                                            <tr>
                                                                <th>Reference</th>
                                                                <th>Principal</th>
                                                                <th>Interest</th>
                                                                <th>Total</th>
                                                                <th>Paid</th>
                                                                <th>Date</th>
                                                                <th>Due Date</th>
                                                                <th>Account</th>
                                                                <th>Module</th>
                                                                <th>Type</th>
                                                                <th>User</th>
                                                                <th>Status</th>
                                                                <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($loans as $loan)
                                                                <tr class="gradeX">
                                                                    <td>
                                                                        {{$loan->reference}}
                                                                        <span><i data-toggle="tooltip" data-placement="right" title="{{$loan->notes}}." class="fa fa-facebook-messenger"></i></span>
                                                                    </td>
                                                                    <td>{{$loan->principal}}</td>
                                                                    <td>{{$loan->interest}}</td>
                                                                    <td>{{$loan->total}}</td>
                                                                    <td>{{$loan->paid}}</td>
                                                                    <td>{{$loan->date}}</td>
                                                                    <td>{{$loan->due_date}}</td>
                                                                    <td>{{$loan->account->name}}</td>
                                                                    <td>{{$loan->module->first_name}} {{$loan->module->last_name}}</td>
                                                                    <td>
                                                                        <span class="label {{$loan->loanType->label}}">{{$loan->loanType->name}}</span>
                                                                    </td>
                                                                    <td>{{$loan->user->name}}</td>
                                                                    <td>
                                                                        <span class="label {{$loan->status->label}}">{{$loan->status->name}}</span>
                                                                    </td>

                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            @can('view loan')
                                                                                <a href="{{ route('business.loan.show', ['portal'=>$institution->portal, 'id'=>$loan->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Reference</th>
                                                                <th>Principal</th>
                                                                <th>Interest</th>
                                                                <th>Total</th>
                                                                <th>Paid</th>
                                                                <th>Date</th>
                                                                <th>Due Date</th>
                                                                <th>Account</th>
                                                                <th>Module</th>
                                                                <th>Type</th>
                                                                <th>User</th>
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
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    To Do's    --}}
        {{-- @can('view to dos')
            <div class="row m-t-lg">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>To Do's</h5>
                        </div>
                        <div class="">
                            <ul class="pending-to-do">
                                @foreach($pendingToDos as $pendingToDo)
                                    <li>
                                        <div>
                                            <small>{{$pendingToDo->due_date}}</small>
                                            <h4>{{$pendingToDo->name}}</h4>
                                            <p>{{$pendingToDo->notes}}.</p>
                                            @if($pendingToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$pendingToDo->design->name}}</span></p>
                                            @endif
                                            <a href="{{route('business.to.do.set.in.progress',['portal'=>$institution->portal, 'id'=>$pendingToDo->id])}}"><i class="fa fa-arrow-circle-o-right "></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="in-progress-to-do">
                                @foreach($inProgressToDos as $inProgressToDo)
                                    <li>
                                        <div>
                                            <small>{{$inProgressToDo->due_date}}</small>
                                            <h4>{{$inProgressToDo->name}}</h4>
                                            <p>{{$inProgressToDo->notes}}.</p>
                                            @if($inProgressToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$inProgressToDo->design->name}}</span></p>
                                            @endif
                                            <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$inProgressToDo->id])}}"><i class="fa fa-check "></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="overdue-to-do">
                                @foreach($overdueToDos as $overdueToDo)
                                    <li>
                                        <div>
                                            <small>{{$overdueToDo->due_date}}</small>
                                            <h4>{{$overdueToDo->name}}</h4>
                                            <p>{{$overdueToDo->notes}}.</p>
                                            @if($overdueToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$overdueToDo->design->name}}</span></p>
                                            @endif
                                            @if($overdueToDo->status->name === "Pending")
                                                <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                            @elseif($overdueToDo->status->name === "In progress")
                                                <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="completed-to-do">
                                @foreach($completedToDos as $completedToDo)
                                    <li>
                                        <div>
                                            <small>{{$completedToDo->due_date}}</small>
                                            <h4>{{$completedToDo->name}}</h4>
                                            <p>{{$completedToDo->notes}}.</p>
                                            @if($completedToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$completedToDo->design->name}}</span></p>
                                            @endif
                                            <a href="{{route('business.to.do.delete',['portal'=>$institution->portal, 'id'=>$completedToDo->id])}}"><i class="fa fa-trash-o "></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        @endcan --}}
    </div>


@endsection

{{-- @include('business.layouts.modals.to_do_create') --}}

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

    <!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<!-- Input Mask-->
<script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Switchery -->
<script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

<!-- MENU -->
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Color picker -->
<script src="{{ asset('inspinia') }}/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- Clock picker -->
<script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

<!-- Image cropper -->
<script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Select2 -->
<script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

{{--  Get due date to populate   --}}
    <script>
        $(document).ready(function() {
            // Set date
            console.log('var');
            var today = new Date();
            console.log(today);
            var dd = today.getDate();
            var mm = today.getMonth();
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            mm ++;
            if (dd < 10){
                dd = '0'+dd;
            }
            if (mm < 10){
                mm = '0'+mm;
            }
            if (m < 10){
                m = '0'+m;
            }
            var date_today = mm + '/' + dd + '/' + yyyy;
            var time_curr = h + ':' + m;
            console.log(time_curr);
            document.getElementById("start_date").value = date_today;
            document.getElementById("end_date").value = date_today;
            document.getElementById("start_time").value = time_curr;
            document.getElementById("end_time").value = time_curr;

            // Set time
        });

    </script>

{{-- to do start time and end time --}}
<script>
    $(document).ready(function() {
        $('.enableEndDate').on('click',function(){

            if (document.getElementById('is_end_date').checked) {
                // enable end_time input
                document.getElementById("end_date").disabled = false;
            } else {
                // disable input
                document.getElementById("end_date").disabled = true;
            }

        });

        $('.enableEndTime').on('click',function(){
            if (document.getElementById('is_end_time').checked) {
                // enable end_time input
                document.getElementById("end_time").disabled = false;
            } else {
                // disable input
                document.getElementById("end_time").disabled = true;
            }
        });
    });

</script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-sales').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$module->name}} Sales',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$module->name}} Sales',
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
    <script>
        $(document).ready(function(){
            $('.dataTables-liabilities').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$module->name}} Liabilities',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$module->name}} Liabilities',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
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
            $('.dataTables-loans').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$module->name}} Loans',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        }},
                    {extend: 'pdf',
                        title: '{{$module->name}} Loans',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        }},

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

        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1.618,
            preview: ".img-preview",
            done: function(data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function() {
            window.open($image.cropper("getDataURL"));
        });

        $("#zoomIn").click(function() {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function() {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function() {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function() {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function() {
            $image.cropper("setDragMode", "crop");
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#data_2 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        $('#data_3 .input-group.date').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('#data_4 .input-group.date').datepicker({
            minViewMode: 1,
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true
        });

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });

        var elem_2 = document.querySelector('.js-switch_2');
        var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

        var elem_3 = document.querySelector('.js-switch_3');
        var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

        var elem_18 = document.querySelector('.js-switch_18');
        var switchery_18 = new Switchery(elem_18, { color: '#1AB394' });

        var elem_19 = document.querySelector('.js-switch_19');
        var switchery_19 = new Switchery(elem_19, { color: '#1AB394' });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $('.demo1').colorpicker();


        $('.clockpicker').clockpicker();

        $('input[name="daterange"]').daterangepicker();

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: { days: 60 },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_title").select2({
            placeholder: "Select Title",
            allowClear: true
        });
        $(".select2_demo_organization").select2({
            placeholder: "Select Organization",
            allowClear: true
        });
        $(".select2_demo_module_type").select2({
            placeholder: "Select Module Type",
            allowClear: true
        });
        $(".select2_demo_lead_source").select2({
            placeholder: "Select Lead Source",
            allowClear: true
        });
        $(".select2_demo_campaign").select2({
            placeholder: "Select Campaign",
            allowClear: true
        });

        $('.chosen-select').chosen({width: "100%"});


    });

    $(".dial").knob();

    $("#basic_slider").noUiSlider({
        start: 40,
        behaviour: 'tap',
        connect: 'upper',
        range: {
            'min':  20,
            'max':  80
        }
    });

    $("#range_slider").noUiSlider({
        start: [ 40, 60 ],
        behaviour: 'drag',
        connect: true,
        range: {
            'min':  20,
            'max':  80
        }
    });

    $("#drag-fixed").noUiSlider({
        start: [ 40, 60 ],
        behaviour: 'drag-fixed',
        connect: true,
        range: {
            'min':  20,
            'max':  80
        }
    });


</script>


@endsection
