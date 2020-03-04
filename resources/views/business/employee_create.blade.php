@extends('business.layouts.app')

@section('title', ' Employee Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Employee Create</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.employees',$institution->portal)}}">Human Resource</a>
                </li>
                <li class="active">
                    <strong>Create Employee</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="">
                            <form method="post" action="{{ route('business.employee.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                    <div class="col-lg-12">
                                        <div class="tabs-container">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#personal"> Personal*</a></li>
                                                <li class=""><a data-toggle="tab" href="#job"> Job*</a></li>
                                                <li class=""><a data-toggle="tab" href="#salary"> Salary* </a></li>
                                                <li class=""><a data-toggle="tab" href="#family"> Family</a></li>
                                                <li class=""><a data-toggle="tab" href="#contact"> Contact</a></li>
                                                <li class=""><a data-toggle="tab" href="#remarks"> Remarks</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="personal" class="tab-pane active">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <h3 class="text-center">Personal Details</h3>
                                                            <hr>
                                                            <div class="col-md-8">
                                                                {{--  first name  --}}
                                                                <div class="has-warning">
                                                                    <input type="text" id="first_name" name="first_name" required="required" class="form-control input-lg" placeholder="First Name">
                                                                </div>
                                                                <br>
                                                                {{--  middle name  --}}
                                                                <div class="">
                                                                    <input type="text" id="middle_name" name="middle_name" required="required" class="form-control input-lg" placeholder="Middle name">
                                                                </div>
                                                                <br>
                                                                {{--  last name  --}}
                                                                <div class="has-warning">
                                                                    <input type="text" id="last_name" name="last_name" required="required" class="form-control input-lg" placeholder="Last name">
                                                                </div>
                                                                <br>
                                                                {{--  gender  --}}
                                                                <div>
                                                                    <p>Gender</p>
                                                                    <div class="radio radio-inline">
                                                                        <input type="radio" id="good" value="option1" name="good" checked="">
                                                                        <label for="inlineRadio1"> Male </label>
                                                                    </div>
                                                                    <div class="radio radio-inline">
                                                                        <input type="radio" id="inlineRadio2" value="option2" name="service">
                                                                        <label for="inlineRadio2"> Female </label>
                                                                    </div>
                                                                    <div class="radio radio-inline">
                                                                        <input type="radio" id="inlineRadio2" value="option2" name="service">
                                                                        <label for="inlineRadio2"> N/A </label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                {{--  date of birth  --}}
                                                                <div class="has-warning" id="data_1">
                                                                    <label class="font-noraml">Date of Birth</label>
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <h3 class="text-center">Nationality Details</h3>
                                                            <hr>
                                                            <div class="">
                                                                {{--  nationality  --}}
                                                                <div class="col-md-6">
                                                                    <div class="has-warning">
                                                                        <select class="select2_demo_3 form-control input-lg">
                                                                            <option>Select Nationality</option>
                                                                            <option value="Bahamas">Bahamas</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                {{--  nationality id  --}}
                                                                <div class="col-md-6">
                                                                    <div class="has-warning">
                                                                        <input type="text" id="nationality_id" name="nationality_id" required="required" class="form-control input-lg" placeholder="Nationality ID">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                {{--  passport  --}}
                                                                <div class="col-md-12">
                                                                    <label></label>
                                                                    <input type="text" id="passport" name="passport" required="required" class="form-control input-lg" placeholder="Passport">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="job" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <h3 class="text-center">Employment Information</h3>
                                                            <hr>
                                                            {{--  employment information  --}}
                                                            <div>
                                                                <div class="col-md-6">
                                                                    {{--  date joined  --}}
                                                                    <div class="has-warning" id="data_1">
                                                                        <label class="font-noraml">Date Joined</label>
                                                                        <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                        </div>
                                                                    </div>
                                                                    {{--  there in order to create a space and offset job status heading --}}
                                                                    <label> </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{--  end of probation  --}}
                                                                    <div class="" id="data_1">
                                                                        <label class="font-noraml">End of Probation</label>
                                                                        <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                        </div>
                                                                    </div>
                                                                    {{--  there in order to create a space and offset job status heading --}}
                                                                    <label> </label>
                                                                </div>
                                                            </div>

                                                            <h3 class="text-center">Job Status</h3>
                                                            <hr>
                                                            {{--  job status  --}}
                                                            <div>
                                                                <div class="col-md-6">
                                                                    {{--  Position  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Position</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Line manager  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Line Manager</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Branch  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Branch</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  there in order to create a space and offset job status heading --}}
                                                                    <label> </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{--  effective date  --}}
                                                                    <div class="has-warning" id="data_1">
                                                                        <label class="font-noraml">Effective Date</label>
                                                                        <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                        </div>
                                                                    </div>
                                                                    {{--  Department  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Department</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Level  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Level</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  there in order to create a space and offset job status heading --}}
                                                                    <label> </label>
                                                                </div>
                                                            </div>

                                                            {{--  there in order to create a space and offset job status heading --}}
                                                            <label> </label>

                                                            <h3 class="text-center">Employment Status</h3>
                                                            <hr>

                                                            <div>
                                                                <div class="col-md-6">
                                                                    {{--  Position  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Job Type</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Line manager  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Job Status</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Branch  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Workdays</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Term start  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Workdays</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    <div class="" id="data_1">
                                                                        <label class="font-noraml">Term Start</label>
                                                                        <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                        </div>
                                                                    </div>
                                                                    {{--  there in order to create a space and offset job status heading --}}
                                                                    <label> </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {{--  effective date  --}}
                                                                    <div class="has-warning" id="data_1">
                                                                        <label class="font-noraml">Effective Date</label>
                                                                        <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                        </div>
                                                                    </div>
                                                                    {{--  Department  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Leave Workflow</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  Level  --}}
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Holidays</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                    {{--  term end  --}}
                                                                    <div class="" id="data_1">
                                                                        <label class="font-noraml">Term End</label>
                                                                        <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                        </div>
                                                                    </div>
                                                                    {{--  there in order to create a space and offset job status heading --}}
                                                                    <label> </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="salary" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <h3 class="text-center">Salary Details</h3>
                                                            <hr>
                                                            <div class="col-md-6">
                                                                <div class="has-warning">
                                                                    <label>  </label>
                                                                    <input type="text" id="salary" name="salary" required="required" class="form-control input-lg" placeholder="Salary">
                                                                </div>
                                                                <div class="">
                                                                    <label class="text-danger"></label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Select Currency</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{--  effective date  --}}
                                                                <div class="has-warning" id="data_1">
                                                                    <label class="font-noraml">Effective Date</label>
                                                                    <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                    </div>
                                                                </div>
                                                                {{--  effective date  --}}
                                                                <div class="has-warning" id="data_1">
                                                                    <label class="font-noraml">Renewal Date</label>
                                                                    <div class="input-group date">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="">
                                                                <div class="tabs-container">
                                                                    <ul class="nav nav-tabs">
                                                                        <li class="active"><a data-toggle="tab" href="#variable_pay"> Variable Pay</a></li>
                                                                        <li class=""><a data-toggle="tab" href="#variable_deduction">Variable Deduction</a></li>
                                                                        <li class=""><a data-toggle="tab" href="#bonus">Bonus</a></li>
                                                                        <li class=""><a data-toggle="tab" href="#statutory_contribution">Statutory Contribution</a></li>
                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div id="variable_pay" class="tab-pane active">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">

                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <a href="{{route('business.composite.product.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
                                                                                    </div>

                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th></th>
                                                                                            <th>Code </th>
                                                                                            <th>Description</th>
                                                                                            <th>Amount</th>
{{--                                                                                            <th>Quantity</th>--}}
                                                                                            <th>Unit</th>
                                                                                            <th>Total</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                                                                                            <td>food</td>
                                                                                            <td>Food allowance</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>1</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>

                                                                                                <a href="{{route('business.project.edit',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                                                                <a href="{{route('business.project.delete',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div id="variable_deduction" class="tab-pane">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">

                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <a href="{{route('business.composite.product.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
                                                                                    </div>

                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th></th>
                                                                                            <th>Code </th>
                                                                                            <th>Description</th>
                                                                                            <th>Amount</th>
                                                                                            {{--                                                                                            <th>Quantity</th>--}}
                                                                                            <th>Unit</th>
                                                                                            <th>Total</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                                                                                            <td>food</td>
                                                                                            <td>Food allowance</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>1</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>

                                                                                                <a href="{{route('business.project.edit',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                                                                <a href="{{route('business.project.delete',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div id="bonus" class="tab-pane">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">

                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <a href="{{route('business.composite.product.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
                                                                                    </div>

                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th></th>
                                                                                            <th>Code </th>
                                                                                            <th>Description</th>
                                                                                            <th>Amount</th>
                                                                                            {{--                                                                                            <th>Quantity</th>--}}
                                                                                            <th>Unit</th>
                                                                                            <th>Total</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                                                                                            <td>food</td>
                                                                                            <td>Food allowance</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>1</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>

                                                                                                <a href="{{route('business.project.edit',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                                                                <a href="{{route('business.project.delete',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div id="statutory_contribution" class="tab-pane">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-11">

                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <a href="{{route('business.composite.product.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
                                                                                    </div>

                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th></th>
                                                                                            <th>Code </th>
                                                                                            <th>Description</th>
                                                                                            <th>Amount</th>
                                                                                            {{--                                                                                            <th>Quantity</th>--}}
                                                                                            <th>Unit</th>
                                                                                            <th>Total</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                                                                                            <td>food</td>
                                                                                            <td>Food allowance</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>1</td>
                                                                                            <td>5000.00</td>
                                                                                            <td>

                                                                                                <a href="{{route('business.project.edit',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                                                                <a href="{{route('business.project.delete',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="">
                                                                <br>
                                                                <h3 class="text-center">Payment Details</h3>
                                                                <hr>
                                                                <div class="col-md-6">
                                                                    <div class="has-warning">
                                                                        <label>  </label>
                                                                        <select class="select2_demo_3 form-control input-lg">
                                                                            <option>Select Bank</option>
                                                                            <option value="Bahamas">Bahamas</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="">
                                                                        <label class="text-danger"></label>
                                                                        <select class="select2_demo_3 form-control input-lg">
                                                                            <option>Select Payment Frequency</option>
                                                                            <option value="Bahamas">Bahamas</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="has-warning">
                                                                        <label>  </label>
                                                                        <input type="text" id="salary" name="salary" required="required" class="form-control input-lg" placeholder="Bank account number">
                                                                    </div>
                                                                    <div class="">
                                                                        <label class="text-danger"></label>
                                                                        <select class="select2_demo_3 form-control input-lg">
                                                                            <option>Select Payment Method</option>
                                                                            <option value="Bahamas">Bahamas</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="family" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <h3 class="text-center">Salary Details</h3>
                                                            <hr>
                                                            <div class="col-md-6">
                                                                <div class="has-warning">
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Marital Status</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                </div>
                                                                <div class="">
                                                                    <label class="text-danger"></label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Number Of Children</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="text-danger"></label>
                                                                <div class="radio radio-inline">
                                                                    <input type="radio" id="spouse_working" value="option1" name="spouse_working" checked="">
                                                                    <label for="inlineRadio1"> Spouse Working </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <br>
                                                            <h3 class="text-center">Spouse Details</h3>
                                                            <hr>
                                                            <div class="col-md-6">
                                                                {{--  first name  --}}
                                                                <div class="has-warning">
                                                                    <label>  </label>
                                                                    <input type="text" id="first_name" name="first_name" required="required" class="form-control input-lg" placeholder="First name">
                                                                </div>
                                                                {{--  middle name  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="middle_name" name="middle_name" required="required" class="form-control input-lg" placeholder="Middle name">
                                                                </div>
                                                                {{--  nationality  --}}
                                                                <div class="has-warning">
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Nationality</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                </div>
                                                                {{--  date of birth  --}}
                                                                <div class="" id="data_1">
                                                                    <label class="font-noraml"></label>
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control input-lg" value="03/04/2014">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">
                                                                {{--  last name  --}}
                                                                <div class="has-warning">
                                                                    <label>  </label>
                                                                    <input type="text" id="last_name" name="last_name" required="required" class="form-control input-lg" placeholder="Last name">
                                                                </div>
                                                                {{--  national id  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="national_id" name="national_id" required="required" class="form-control input-lg" placeholder="National ID">
                                                                </div>
                                                                {{--  passport  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="passport" name="passport" required="required" class="form-control input-lg" placeholder="Passport">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <br>
                                                            <h3 class="text-center">Children Details</h3>
                                                            <hr>

                                                            <div class="col-md-11">

                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="{{route('business.composite.product.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
                                                            </div>

                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>First Name </th>
                                                                    <th>Middle Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Birth Date</th>
                                                                    <th>Gender</th>
                                                                    <th>Married</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Michael</td>
                                                                    <td>Thungu</td>
                                                                    <td>Wanyoike</td>
                                                                    <td>1.1.1990</td>
                                                                    <td>Male</td>
                                                                    <td>Yes</td>
                                                                    <td>
                                                                        <a href="{{route('business.project.edit',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                                                        <a href="{{route('business.project.delete',['portal'=>$institution->portal,'id'=>'1'])}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete </a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="contact" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <h3 class="text-center">Phone Details</h3>
                                                            <hr>
                                                            <div class="col-md-6">
                                                                {{--  office  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="office" name="office" required="required" class="form-control input-lg" placeholder="Office">
                                                                </div>
                                                                {{--  mobile  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="mobile" name="mobile" required="required" class="form-control input-lg" placeholder="Mobile">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                {{--  office extension  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="office_extension" name="office_extension" required="required" class="form-control input-lg" placeholder="Office Extension">
                                                                </div>
                                                                {{--  home  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="home" name="home" required="required" class="form-control input-lg" placeholder="Home">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <br>
                                                            <h3 class="text-center">Address</h3>
                                                            <hr>
                                                            <div class="col-md-6">
                                                                {{--  address 1  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="address_1" name="address_1" required="required" class="form-control input-lg" placeholder="Address 1">
                                                                </div>
                                                                {{--  city  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="city" name="city" required="required" class="form-control input-lg" placeholder="City">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                {{--  address 2  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="address_2" name="address_2" required="required" class="form-control input-lg" placeholder="Address 2">
                                                                </div>
                                                                {{--  postcode  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <input type="text" id="postcode" name="postcode" required="required" class="form-control input-lg" placeholder="Postcode">
                                                                </div>
                                                                {{--  country  --}}
                                                                <div class="">
                                                                    <label>  </label>
                                                                    <select class="select2_demo_3 form-control input-lg">
                                                                        <option>Country</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="directory" class="tab-pane">
                                                    <div class="panel-body">
                                                        <strong>Donec quam felis</strong>

                                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                                    </div>
                                                </div>
                                                <div id="remarks" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <textarea rows="9" id="employee_remarks" name="employee_remarks" required="required" class="form-control input-lg" placeholder="Remarks"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <hr>
                                <br />

                                <div class="ln_solid"></div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg btn-outline mt-4">{{ __('Save') }}</button>
                                </div>

                            </form>

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


@endsection
