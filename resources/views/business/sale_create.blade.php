@extends('business.layouts.app')

@section('title', ' Sale Create')

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
                <h2>Sales</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales')}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales')}}">Sales</a>
                    </li>
                    <li class="active">
                        <strong>Sale Create</strong>
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
                                <form method="post" action="{{ route('business.product.group.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <span><i data-toggle="tooltip" data-placement="left" title="Enable this option if all the items in the group are eligible for sales return." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                                </div>
                                                {{--  Salutation  --}}
                                                <div class="col-md-3">
                                                    <div class="has-warning">
                                                        <select class="select2_demo_3 form-control input-lg">
                                                            <option>Select Salutation</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  First name  --}}
                                                    <div class="has-warning">
                                                        <input type="text" id="first_name" name="first_name" required="required" class="form-control input-lg" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  Last name  --}}
                                                    <div class="has-warning">
                                                        <input type="text" id="last_name" name="last_name" required="required" class="form-control input-lg" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            {{--  Comapny name  --}}
                                            <div class="has-warning">
                                                <input type="text" id="company_name" name="company_name" required="required" class="form-control input-lg" placeholder="Company Name">
                                            </div>
                                            <br>
                                            {{--  Customer email  --}}
                                            <div class="">
                                                <input type="email" id="customer_email" name="customer_email" required="required" class="form-control input-lg" placeholder="Customer Email">
                                            </div>
                                            <br>
                                            {{--  Customer phone number  --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" id="customer_phone_number" name="customer_phone_number" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Work Phone">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="customer_phone_number" name="customer_phone_number" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Mobile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Item Details</th>
                                                <th>Quantity</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone number</th>
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
                                                    <input type="number" class="form-control input-lg">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control input-lg">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control input-lg" placeholder="E.g +10, -10">
                                                </td>
                                                <td width="10px">
                                                    <span><i data-toggle="tooltip" data-placement="right" title="Opening stock refers to the quantity of the item on hand before you start tracking inventory for the item." class="fa fa-times-circle fa-2x text-danger"></i></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <br>

                                    <div class="ln_solid"></div>

                                    <br>
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
