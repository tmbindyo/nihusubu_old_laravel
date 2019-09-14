@extends('business.layouts.app')

@section('title', "To Do's")

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>To Do's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard')}}">Home</a>
                </li>
                <li class="active">
                    <strong>To Do's</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="#" data-toggle="modal" data-target="#toDoRegistration" aria-expanded="false" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <ul class="notes">
                    <li>
                        <div>
                            <small>12:03:28 12-04-2014</small>
                            <h4>Long established fact</h4>
                            <p>The years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <small>11:08:33 16-04-2014</small>
                            <h4>Latin professor at Hampden-Sydney </h4>
                            <p>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <small>9:12:28 10-04-2014</small>
                            <h4>The standard chunk of Lorem</h4>
                            <p>Ipsum used since the 1500s is reproduced below for those interested.</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <small>3:33:12 6-03-2014</small>
                            <h4>The generated Lorem Ipsum </h4>
                            <p>The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <small>5:20:11 4-04-2014</small>
                            <h4>Contrary to popular belief</h4>
                            <p>Hampden-Sydney College in Virginia, looked up one.</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <small>2:10:12 4-05-2014</small>
                            <h4>There are many variations</h4>
                            <p>All the Lorem Ipsum generators on the Internet .</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <small>10:15:26 6-04-2014</small>
                            <h4>Ipsum used standard chunk of Lorem</h4>
                            <p>Standard chunk  is reproduced below for those.</p>
                            <a href="#"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
@include('business.layouts.modals.to_do_create')
@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Date picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

{{--  Get due date to populate   --}}
<script>
    $(document).ready(function() {
        // Set date
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        if (dd < 10){
            dd = '0'+dd;
        }
        if (mm < 10){
            mm = '0'+mm;
        }
        var date_today = mm + '/' + dd + '/' + yyyy;
        document.getElementById("date_due").value = date_today;

    });

</script>

{{-- Date picker  --}}
<script>
    $(document).ready(function(){

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


    });

</script>
@endsection
