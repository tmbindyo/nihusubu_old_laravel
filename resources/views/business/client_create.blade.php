@extends('business.layouts.app')

@section('title', 'Create Client')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
    {{--  Tags  --}}
    <style>
        .tags-input-wrapper {
            background: #ffffff;
            padding: 10px;
            border-radius: 4px;
            max-width: 650px;
            border: 1px solid #ccc
        }

        .tags-input-wrapper input {
            border: none;
            background: transparent;
            outline: none;
            width: 150px;
        }

        .tags-input-wrapper .tag {
            display: inline-block;
            background-color: #009432;
            color: white;
            border-radius: 20px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
@endsection



@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.sales')}}">Sales</a>
            </li>
            <li>
                <a href="{{route('business.clients')}}">Clients</a>
            </li>
            <li class="active">
                <strong>Client Create</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Clients</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
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
                                {{--  Customer type  --}}
                                {{--  todo only one should be selectable  --}}
                                <p>Customer Type</p>
                                <div class="radio radio-inline">
                                    <input type="radio" id="good" value="option1" name="business">
                                    <label for="inlineRadio1"> Business </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="option2" name="individual">
                                    <label for="inlineRadio2"> Individual </label>
                                </div>
                                <br>
                                <br>
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
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#other_details"> Other Details</a></li>
                                    <li class=""><a data-toggle="tab" href="#address">Address</a></li>
                                    <li class=""><a data-toggle="tab" href="#contact_persons"> Contact Persons </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="other_details" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="">
                                                <div class="">
                                                    {{--  Currency  --}}
                                                    <label class="text-danger"></label>
                                                    <select name="currency" class="select2_demo_3 form-control input-lg">
                                                        <option>Select Currency</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                    <br>
                                                    {{--  Opening balance  --}}
                                                    <div class="">
                                                        <input type="text" id="opening_balance" name="opening_balance" class="form-control input-lg" placeholder="Opening balance">
                                                    </div>
                                                    <br>
                                                    {{--  Payment terms  --}}
                                                    <select name="payment_terms" class="select2_demo_3 form-control input-lg">
                                                        <option>Select Payment Term</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="address" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="has-warning">
                                                        <input type="text" name="location" id="location" class="form-control input-lg" placeholder="Warehouse Location">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <input type="text" id="street" name="street" required="required" placeholder="Warehouse Street" class="form-control input-lg">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="">
                                                        <input type="text" id="email" name="email" required="required" placeholder="Warehouse Email" class="form-control input-lg">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="">
                                                        <input type="text" name="phone_number" id="phone_number" class="form-control input-lg" placeholder="Warehouse Phone number">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="has-warning">
                                                        <input type="text" name="city" id="city" class="form-control input-lg" placeholder="Warehouse City">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="contact_persons" class="tab-pane">
                                        <div class="panel-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Salutation</th>
                                                    <th>First Name</th>
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
                                    </div>
                                </div>


                            </div>
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
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- jQuery Tags Input -->
    <script src="{{ asset('js') }}/tagplug-master/index.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('js') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    {{--  Tag script  --}}
    <script>
        $(document).ready(function() {
            var tagInput = new TagsInput({
                selector: 'tag-input',
                duplicate: false
            });
        });
    </script>

    {{--  Script to prevent form submit on enter key press  --}}
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
        });
    </script>
@endsection
