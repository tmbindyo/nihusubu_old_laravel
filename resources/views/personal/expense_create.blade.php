@extends('personal.layouts.app')

@section('title', ' Estimate Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('inspinia') }}/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

@endsection

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Estimates</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('personal.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('personal.expenses')}}">Expenses</a>
                    </li>
                    <li class="active">
                        <strong>Estimate Create</strong>
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
                                <form method="post" action="{{ route('personal.expense.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                    {{--  Product  --}}
                                    <div class="row">

                                        <div class="col-md-8">

                                            {{--  recurring bill  --}}
                                            <div class="has-warning" id="data_1">
                                                <input type="checkbox" class="js-switch" checked />
                                                <label>Recurring</label>
                                            </div>

                                            {{--  Date  --}}
                                            <div class="has-warning" id="data_1">
                                                <label class="font-noraml"></label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                                </div>
                                            </div>
                                            <br>

                                            {{--  Expense Account  --}}
                                            <div class="has-warning">
                                                <select class="select2_demo_3 form-control input-lg">
                                                    <option>Select Expense Account</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                </select>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    {{--  Expense currency  --}}
                                                    <div class="has-warning">
                                                        <select class="select2_demo_3 form-control input-lg">
                                                            <option value="Bahamas">Ksh</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  Expense amount  --}}
                                                    <div class="has-warning">
                                                        <input type="number" id="amount" name="amount" required="required" class="form-control input-lg" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  Tax  --}}
                                                    <div class="has-warning">
                                                        <select class="select2_demo_3 form-control input-lg">
                                                            <option>Select Tax</option>
                                                            <option value="Bahamas">Ksh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--  Expense Account  --}}
                                            <div class="has-warning">
                                                <select class="select2_demo_3 form-control input-lg">
                                                    <option>Paid Through Account</option>
                                                    <option value="Bahamas">Ksh</option>
                                                </select>
                                            </div>
                                            <br>

                                            {{--  Vendor  --}}
                                            <div class="">
                                                <select class="select2_demo_3 form-control input-lg">
                                                    <option>Select Vendor</option>
                                                    <option value="Bahamas">Ksh</option>
                                                </select>
                                            </div>
                                            <br>

                                            {{--  Reference  --}}
                                            <div class="">
                                                <input type="text" id="reference" name="reference" required="required" class="form-control input-lg" placeholder="Reference">
                                            </div>
                                            <br>

                                            <div class="">
                                                <textarea class="form-control input-lg" rows="3" placeholder="Notes"></textarea>
                                            </div>
                                            <br>

                                            {{--  Customer  --}}
                                            <div class="">
                                                <select class="select2_demo_3 form-control input-lg">
                                                    <option>Select Customer</option>
                                                    <option value="Bahamas">Ksh</option>
                                                </select>
                                            </div>
                                            <br>

                                        </div>

                                        <div class="col-md-4">

                                        </div>

                                    </div>

                                    <div class="ln_solid"></div>

                                    <br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Save') }}</button>
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

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="{{ asset('inspinia') }}/js/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();

        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });

</script>
@endsection
