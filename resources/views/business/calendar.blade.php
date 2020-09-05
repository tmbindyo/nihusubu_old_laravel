@extends('business.layouts.app')

@section('title', 'Calendar')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Calendar</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li class="active">
                <strong>Calendar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$institution->name}} Calendar  </h5>

                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Full Calendar -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/fullcalendar.min.js"></script>

<!-- Date picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

<!-- Clock picker -->
<script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>



{{--  Calendar  --}}
<script>
    $(document).ready(function() {

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

        /* initialize the external events
         -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
                @foreach ($toDos as $toDo)
                {
                    title: '{{$toDo->name}}',
                    start: new Date({{$toDo->start_year}}, {{$toDo->start_month-1}}, {{$toDo->start_day}}, {{$toDo->start_hour}}, {{$toDo->start_minute}}),
                    @if($toDo->is_end_date == 1)
                        end: new Date({{$toDo->end_year}}, {{$toDo->end_month-1}}, {{$toDo->end_day}} @if($toDo->is_end_time == 1), {{$toDo->end_hour}}, {{$toDo->end_minute}} @endif),
                    @endif
                    @if($toDo->is_product == 1)
                        color: '#fe9000',
                    @endif
                    @if($toDo->is_product_group == 1)
                        color: '#FFDD4A',
                    @endif
                    @if($toDo->is_warehouse == 1)
                        color: '#463F3A',
                    @endif
                    @if($toDo->is_sale == 1)
                        color: '#5adbff',
                    @endif
                    @if($toDo->is_contact == 1)
                        color: '#E0AFA0',
                    @endif
                    @if($toDo->is_organization == 1)
                        color: '#3777EE',
                    @endif
                    @if($toDo->is_campaign == 1)
                        color: '#070707',
                    @endif
                    @if($toDo->is_account == 1)
                        color: '#6f2dbd',
                    @endif
                    @if($toDo->is_account_adjustment == 1)
                        color: '#DBD053',
                    @endif
                    @if($toDo->is_deposit == 1)
                        color: '#30011E',
                    @endif
                    @if($toDo->is_liability == 1)
                        color: '#E71D36',
                    @endif
                    @if($toDo->is_loan == 1)
                        color: '#826aed',
                    @endif
                    @if($toDo->is_withdrawal == 1)
                        color: '#a1F1a1',
                    @endif
                    @if($toDo->is_expense == 1)
                        color: '#C7CB85',
                    @endif
                    @if($toDo->is_payment == 1)
                        color: '#8F3985',
                    @endif
                    @if($toDo->is_refund == 1)
                        color: '#7F96FF',
                    @endif
                    @if($toDo->is_transaction == 1)
                        color: '#E9D2C0',
                    @endif
                    @if($toDo->is_transfer == 1)
                        color: '#070707',
                    @endif
                },
                @endforeach
            ]
        });


    });

</script>

{{-- Date and Time picker  --}}
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

    $('.clockpicker').clockpicker();

});

</script>
@endsection
