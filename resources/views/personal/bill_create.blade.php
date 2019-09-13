@extends('personal.layouts.app')

@section('title', ' Bill Create')

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
                <h2>Bills</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('personal.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('personal.expenses')}}">Expenses</a>
                    </li>
                    <li>
                        <a href="{{route('personal.bills')}}">Bills</a>
                    </li>
                    <li class="active">
                        <strong>Bill Create</strong>
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
                                <form method="post" action="{{ route('personal.bill.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                        <div class="col-md-7">
                                            {{--  recurring bill  --}}
                                            <div class="has-warning" id="data_1">
                                                <input name="recurring" type="checkbox" class="js-switch" checked />
                                                <label>Recurring</label>
                                            </div>

                                            {{--  Vendor  --}}
                                            <div class="has-warning">
                                                <select name="vendor" class="select2_demo_3 form-control input-lg">
                                                    <option>Select Vendor</option>
                                                    <option value="Bahamas">Ksh</option>
                                                </select>
                                            </div>
                                            <br>

                                            {{--  bill number  --}}
                                            <div class="has-warning">
                                                <input type="text" id="bill_number" name="bill_number" required="required" class="form-control input-lg" placeholder="Bill number">
                                            </div>
                                            <br>

                                            {{--  order number  --}}
                                            <div class="">
                                                <input type="text" id="order_number" name="order_number" required="required" class="form-control input-lg" placeholder="Reference">
                                            </div>
                                            <br>

                                            {{--  Date  --}}
                                            <div class="has-warning" id="data_1">
                                                <label class="font-noraml"></label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input name="date" type="text" class="form-control input-lg" value="03/04/2014">
                                                </div>
                                            </div>
                                            <br>

                                            {{--  Due Date  --}}
                                            <div class="" id="data_1">
                                                <label class="font-noraml"></label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input name="due_date" type="text" class="form-control input-lg" value="03/04/2014">
                                                </div>
                                            </div>
                                            <br>

                                            {{--  Payment terms  --}}
                                            <div class="has-warning">
                                                <select name="payment_terms" class="select2_demo_3 form-control input-lg">
                                                    <option>Select Payment Term</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                </select>
                                            </div>
                                            <br>
                                        </div>
                                    </div>

                                    {{--  table  --}}
                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Account</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Tax</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Item</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Item</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control input-lg">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control input-lg">
                                                </td>
                                                <td>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select Item</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="select2_demo_3 form-control input-lg">
                                                        <option>Select customer</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control input-lg">
                                                </td>
                                                <td width="10px">
                                                    <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-times-circle fa-2x text-danger"></i></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{--  sub totals  --}}
                                    <div class="row">
                                        <div class="col-md-7">

                                        </div>

                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="pull-left">Sub Total</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="pull-right">0.00</label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Discount</label>
                                                </div>
                                                <div class="col-md-3">
                                                    {{--  Expense currency  --}}
                                                    <div class="has-warning">
                                                        <select class="select2_demo_3 form-control input-lg">
                                                            <option value="Bahamas">Ksh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input value="0.00">
                                                </div>
                                                <div class="col-md-3">

                                                </div>
                                            </div>
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
