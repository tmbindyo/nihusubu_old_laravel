@extends('personal.layouts.app')

@section('title', 'Sacco Reconciliations')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('inspinia') }}/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Saccos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('personal.calendar')}}">Home</a>
            </li>
            <li>
                <a href="{{route('personal.saccos')}}">Sacco's</a>
            </li>
            <li>
                <a href="{{route('personal.sacco.show',1)}}">Sacco</a>
            </li>
            <li class="active">
                <strong>Reconciliations</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="{{route('personal.sacco.reconciliation.create',1)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
        </div>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight ecommerce">


    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="order_id">Order ID</label>
                    <input type="text" id="order_id" name="order_id" value="" placeholder="Order ID" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">Order status</label>
                    <input type="text" id="status" name="status" value="" placeholder="Status" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="customer">Customer</label>
                    <input type="text" id="customer" name="customer" value="" placeholder="Customer" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="date_added">Date added</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_added" type="text" class="form-control" value="03/04/2014">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="date_modified">Date modified</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_modified" type="text" class="form-control" value="03/06/2014">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="amount">Amount</label>
                    <input type="text" id="amount" name="amount" value="" placeholder="Amount" class="form-control">
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                        <tr>

                            <th>Order ID</th>
                            <th data-hide="phone">Customer</th>
                            <th data-hide="phone">Amount</th>
                            <th data-hide="phone">Date added</th>
                            <th data-hide="phone,tablet" >Date modified</th>
                            <th data-hide="phone">Status</th>
                            <th class="text-right">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                3214
                            </td>
                            <td>
                                Customer example
                            </td>
                            <td>
                                $500.00
                            </td>
                            <td>
                                03/04/2015
                            </td>
                            <td>
                                03/05/2015
                            </td>
                            <td>
                                <span class="label label-primary">Pending</span>
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="{{route('personal.sacco.reconciliation.delete',1)}}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                </div>
                            </td>
                        </tr>


                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

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
