@extends('business.layouts.app')

@section('title', 'Human Resource Settings')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Human Resource Settings</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li class="active">
                <strong>Human Resource Settings</strong>
            </li>
        </ol>
    </div>
</div>


        <div class="wrapper wrapper-content animated fadeInRight">

            {{--  holidays  --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Holidays</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                                <a class="close-link">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-plus"></i> New
                                    </button>

                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Holiday</th>
                                <th>Remark</th>
                                <th class="text-right" width="105px" data-sort-ignore="true">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="gradeA">
                                <td>12.12.2019</td>
                                <td>Monday</td>
                                <td>Test</td>
                                <td>Test Holiday</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                        <a href="{{ route('business.holiday.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock on Hand</th>
                                <th>Reorder Level</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        </table>
                            </div>

                        </div>
                    </div>
            </div>
            </div>

            {{--  workdays  --}}
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Workdays</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="">
                            <form method="post" action="{{ route('business.workdays.update',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                <h3 class="text-center">Workdays</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Monday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Tuesday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Wednesday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Thursday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Friday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Saturday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{--  day  --}}
                                        <label>Sunday</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="select2_demo_3 form-control">
                                            <option value="Bahamas">Full Day</option>
                                            <option value="Bahamas">Half Day</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="09:30" >
                                            <span class="input-group-addon">
                                                <span>Start</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" class="form-control" value="05:00" >
                                            <span class="input-group-addon">
                                                <span>End</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>

                                <h3 class="text-center">Overtime & Undertime</h3>
                                <hr>
                                <div class="row">
                                    <h4 class="text-left">Full Day</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When work duration is more than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="480">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes, mark additional time as Overtime
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When work duration is less than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="480">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes, mark shortage as Undertime
                                        </p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <h4 class="text-left">Half Day</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When work duration is more than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="240">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes, mark additional time as Overtime
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When work duration is less than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="240">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes, mark shortage as Undertime
                                        </p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <h4 class="text-left">Off</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When work duration is more than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="0">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes, mark additional time as Overtime
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <br>

                                <div class="row">
                                    <h4 class="text-left">Holiday</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When work duration is more than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="0">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes, mark additional time as Overtime
                                        </p>
                                    </div>
                                </div>
                                <hr>

                                <h3 class="text-center">Tardiness</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input id="returnable" name="returnable" type="checkbox">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>
                                            When First Check In is more than
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" id="product_name" name="product_name" required="required" class="form-control" placeholder="0">
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            minutes from Start time, mark as Tardy
                                        </p>
                                    </div>
                                </div>
                                <hr>

                                <div class="ln_solid"></div>

                                <br>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Update') }}</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            </div>

            {{--  approval workflow & leave type  --}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Approval Workflow</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="">
                                    <div>
                                        {{--  first approver  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>First Approver</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                    <div>
                                        {{--  second approver  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Second Approver</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                    <div>
                                        {{--  third approver  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Third Approver</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                    <div>
                                        {{--  forth approver  --}}
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Forth Approver</option>
                                            <option value="Bahamas">Bahamas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{--  leave type  --}}
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Leave Type</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                                <a class="close-link">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-plus"></i> New
                                    </button>

                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th data-hide="all">Description</th>
                                        <th>Unit</th>
                                        <th>Color</th>
                                        <th>Paid</th>
                                        <th>Status</th>
                                        <th class="text-right" width="105px" data-sort-ignore="true">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="gradeA">
                                        <td>Annual</td>
                                        <td>Annual Leave</td>
                                        <td>Day</td>
                                        <td>Green</td>
                                        <td>
                                            <input id="returnable" name="returnable" type="checkbox">
                                        </td>
                                        <td>
                                            <span class="label label-primary">Enabled</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                                <a href="{{ route('business.leave.type.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Type</th>
                                        <th data-hide="all">Description</th>
                                        <th>Unit</th>
                                        <th>Color</th>
                                        <th>Paid</th>
                                        <th>Status</th>
                                        <th class="text-right" width="105px" data-sort-ignore="true">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{--  earning policy  --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Earning Policy</h5>
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
                                        <th>Status</th>
                                        <th>Modified</th>
                                        <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="gradeA">
                                        <td>Earned Immediately</td>
                                        <td>Earned immediately at earning start date</td>
                                        <td>
                                            <span class="label label-primary">Enable</span>
                                        </td>
                                        <td>2018-01-01</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="#" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                                <a href="{{ route('business.earning.policy.delete', ['portal'=>$institution->portal,'id'=>'1']) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Modified</th>
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

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- JSKnob -->
    <script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- NouSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

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

    <!-- TouchSpin -->
    <script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Page-Level Scripts -->
    {{--  Select 2 scripts  --}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $(".select2_demo_3").select2({--}}
{{--                placeholder: "Select Unit type",--}}
{{--                allowClear: true--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

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

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });

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
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"100%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
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
