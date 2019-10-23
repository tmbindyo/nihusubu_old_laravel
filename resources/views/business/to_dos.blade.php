@extends('business.layouts.app')

@section('title', "To Do's")

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

{{--    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">--}}

{{--    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">--}}

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

                {{-- Each to do has a complimentart color found at: public->inspinia->css->style.css --}}
                <ul class="pending-to-do">
                    @foreach($pendingToDos as $pendingToDo)
                        <li>
                            <div>
                                <small>{{$pendingToDo->due_date}}</small>
                                <h4>{{$pendingToDo->name}}</h4>
                                <p>{{$pendingToDo->notes}}.</p>
                                @if($pendingToDo->is_album === 1)
                                    <p><span class="badge badge-primary">{{$pendingToDo->album->name}}</span></p>
                                @endif
                                <a href="{{route('business.to.do.set.in.progress',$pendingToDo->id)}}"><i class="fa fa-arrow-circle-o-right "></i></a>
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
                                @if($inProgressToDo->is_album === 1)
                                    <p><span class="badge badge-primary">{{$inProgressToDo->album->name}}</span></p>
                                @endif
                                <a href="{{route('business.to.do.set.completed',$inProgressToDo->id)}}"><i class="fa fa-check "></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="overdue-to-do">
                    @foreach($overdueToDos as $overdueToDo)
                        <li>
                            <div>
                                <small>{{$overdueToDo->due_date}}</small>
                                <h4>{{$overdueToDo->task}}</h4>
                                <p>{{$overdueToDo->notes}}.</p>
                                @if($overdueToDo->is_album === 1)
                                    <p><span class="badge badge-primary">{{$overdueToDo->album->name}}</span></p>
                                @endif
                                @if($overdueToDo->status->name === "Pending")
                                    <a href="{{route('business.to.do.set.completed',$overdueToDo->id)}}"><i class="fa fa-check-double "></i></a>
                                @elseif($overdueToDo->status->name === "In progress")
                                    <a href="{{route('business.to.do.set.completed',$overdueToDo->id)}}"><i class="fa fa-check-double "></i></a>
                                @endif
                                <a href="{{route('business.to.do.delete',$overdueToDo->id)}}"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="completed-to-do">
                    @foreach($completedToDos as $completedToDo)
                        <li>
                            <div>
                                <small>{{$completedToDo->due_date}}</small>
                                <h4>{{$completedToDo->task}}</h4>
                                <p>{{$completedToDo->notes}}.</p>
                                @if($completedToDo->is_album === 1)
                                    <p><span class="badge badge-primary">{{$completedToDo->album->name}}</span></p>
                                @endif
                                <a href="{{route('business.to.do.delete',$completedToDo->id)}}"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                    @endforeach
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

<!-- Image cropper -->
<script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

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
@endsection
