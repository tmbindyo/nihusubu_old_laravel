@extends('personal.layouts.app')

@section('title', 'Frequency')

@section('css')

<link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/cropper/cropper.min.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

<link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
<link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection



@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Frequencies</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li class="active">
                    <a href="{{route('personal.frequencies')}}">Frequencies</a>
                </li>
                <li class="active">
                    <strong>Frequency Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-3">
            <div class="title-action">
                <a href="{{route('personal.expense.create')}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Expense </a>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Frequency <small>edit</small></h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <p>Edit.</p>
                                <form method="post" action="{{ route('personal.frequency.update',$frequency->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                    <div class="has-warning">
                                        <input type="name" name="name" value="{{$frequency->name}}" class="form-control input-lg">
                                        <i>name</i>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        <select name="type" class="select2_demo_type form-control input-lg">
                                            <option></option>
                                            <option @if($frequency->type == "day")selected @endif value="day">day</option>
                                            <option @if($frequency->type == "week")selected @endif value="week">week</option>
                                            <option @if($frequency->type == "month")selected @endif value="month">month</option>
                                            <option @if($frequency->type == "year")selected @endif value="year">year</option>
                                        </select>
                                        <i>type</i>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        <input type="number" id="frequency" name="frequency" required="required" value="{{$frequency->frequency}}" class="form-control input-lg">
                                        <i>frequency</i>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-lg btn-primary btn-block btn-outline m-t-n-xs" type="submit"><strong>Update</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Frequency Expenses ({{$frequency->expenses_count}})</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Recurring</th>
                                <th>Type</th>
                                <th>Expense #</th>
                                <th>Date</th>
                                <th>Created</th>
                                <th>Expense Account</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Status</th>
                                <th class="text-right" width="35px" data-sort-ignore="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($frequency->expenses as $expense)
                                <tr class="gradeA">
                                    <td>
                                        @if($expense->is_recurring == 1)
                                            <p><span class="badge badge-success">True</span></p>
                                        @else
                                            <p><span class="badge badge-success">False</span></p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($expense->is_order == 1)
                                            <p><a href="{{route('personal.order.show',$expense->order_id)}}" class="badge badge-success">Order</a></p>
                                        @elseif($expense->is_album == 1)
                                            <p>
                                                <a
                                                @if ($expense->album->album_type_id == '6fdf4858-01ce-43ff-bbe6-827f09fa1cef')
                                                    href="{{route('personal.personal.album.show',$expense->album->id)}}"
                                                @elseif ($expense->album->album_type_id == 'ca64a5e0-d39b-4f2c-a136-9c523d935ea4')
                                                    href="{{route('personal.client.proof.show',$expense->album->id)}}"
                                                 @endif  class="badge badge-primary">Album {{$expense->album->name}}
                                                </a>
                                            </p>
                                        @elseif($expense->is_project == 1)
                                            <p><a href="{{route('personal.project.show',$expense->project->id)}}" class="badge badge-primary">Project {{$expense->project->name}}</a></p>
                                        @elseif($expense->is_project == 1)
                                            <p><a href="{{route('personal.project.show',$expense->project_id)}}" class="badge badge-primary">Design {{$expense->design->name}}</a></p>
                                        @elseif($expense->is_liability == 1)
                                            <p><a href="{{route('personal.liability.show',$expense->liability_id)}}" class="badge badge-primary">Liability</a></p>
                                        @elseif($expense->is_transfer == 1)
                                            <p><a href="{{route('personal.transfer.show',$expense->transfer_id)}}" class="badge badge-primary">Transfer</a></p>
                                        @elseif($expense->is_campaign == 1)
                                            <p><a href="{{route('personal.campaign.show',$expense->campaign_id)}}" class="badge badge-primary">Campaign</a></p>
                                        @elseif($expense->is_asset == 1)
                                            <p><a href="{{route('personal.asset.show',$expense->asset_id)}}" class="badge badge-primary">Asset</a></p>
                                        @else
                                            <p><span class="badge badge-info">None</span></p>
                                        @endif
                                    </td>
                                    <td>{{$expense->reference}}</td>
                                    <td>{{$expense->date}}</td>
                                    <td>{{$expense->created_at}}</td>
                                    <td>{{$expense->expense_account->name}}</td>
                                    <td>{{$expense->total}}</td>
                                    <td>{{$expense->paid}}</td>
                                    <td>
                                        <p><span class="label {{$expense->status->label}}">{{$expense->status->name}}</span></p>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="{{ route('personal.expense.show', $expense->id) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Recurring</th>
                                <th>Type</th>
                                <th>Expense #</th>
                                <th>Date</th>
                                <th>Created</th>
                                <th>Expense Account</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Status</th>
                                <th class="text-right" width="35px" data-sort-ignore="true">Action</th>
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

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

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

    <!-- Page-Level Scripts -->
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
            $(".select2_demo_type").select2({
                placeholder: "Select Type",
                allowClear: true
            });
            $(".select2_demo_category").select2({
                placeholder: "Select Categories",
                allowClear: true
            });


        });
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

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
@endsection
