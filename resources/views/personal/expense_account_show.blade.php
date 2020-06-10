@extends('personal.layouts.app')

@section('title', 'Expense Account')

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

    <link href="{{ asset('inspinia') }}/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection



@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Expense Account</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li class="active">
                    <strong>Settings's</strong>
                </li>
                <li class="active">
                   <a href="{{route('personal.expense.accounts')}}"><strong>Expesne Account's</strong></a>
                </li>
                <li class="active">
                    <strong>Expense Account</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Expense Account <small>edit</small></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <form method="post" action="{{ route('personal.expense.account.update',$expenseAccount->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                        {{--  expense account  --}}
                                        <div class="has-warning">
                                            <select name="account_type" class="select-2 form-control input-lg">
                                                <option selected disabled>Select Account Types</option>
                                                @foreach($accountTypes as $accountType)
                                                    <option @if($accountType->id == $expenseAccount->account_type_id) selected @endif value="{{$accountType->id}}">{{$accountType->name}} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="has-warning">
                                            <input type="text" id="name" name="name" required="required" value="{{$expenseAccount->name}}" class="form-control input-lg">
                                            <i>name</i>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="has-warning">
                                            <input type="text" id="code" name="code" required="required" value="{{$expenseAccount->code}}" class="form-control input-lg">
                                            <i>code</i>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="has-warning">
                                            <textarea name="description" class="form-control input-lg" rows="4">{{$expenseAccount->description}}</textarea>
                                            <i>code</i>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>

                                    <div>
                                        <button class="btn btn-primary btn-block btn-lg m-t-n-xs" type="submit"><strong>Update</strong></button>
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
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label {{$expenseAccount->status->label}}">{{$expenseAccount->status->name}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>{{$expenseAccount->user->name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{$expenseAccount->updated_at}}</dd>
                                        <dt>Created:</dt> <dd> {{$expenseAccount->created_at}} </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#budgets" data-toggle="tab">Budget</a></li>
                                                    <li class=""><a href="#expenses" data-toggle="tab">Expenses</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="budgets">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                            <tr>
                                                                <th>Expense Account</th>
                                                                <th>Budget</th>
                                                                <th>Spent</th>
                                                                <th>User</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($expenseAccountBudget as $budget)
                                                                <tr class="gradeX">
                                                                    <td>{{$budget->expenseAccount->name}}</td>
                                                                    <td>{{$budget->amount}}</td>
                                                                    <td>{{$budget->amount}}</td>
                                                                    <td>{{$budget->user->name}}</td>
                                                                    <td>
                                                                        <span class="label {{$budget->status->label}}">{{$budget->status->name}}</span>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('personal.budget.show',$budget->id) }}" class="btn-white btn btn-xs">View</a>
                                                                            @if($budget->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                                                <a href="{{ route('personal.budget.restore',$budget->id) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                            @else
                                                                                <a href="{{ route('personal.budget.delete',$budget->id) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Expense Account</th>
                                                                <th>Budget</th>
                                                                <th>Spent</th>
                                                                <th>User</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="tab-pane" id="expenses">
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
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($expenseAccountExpenses as $expense)
                                                                    <tr class="gradeA">
                                                                        <td>
                                                                            @if($expense->is_recurring == 1)
                                                                                <p><span class="badge badge-success">True</span></p>
                                                                            @else
                                                                                <p><span class="badge badge-success">False</span></p>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($expense->is_inventory_adjustment == 1)
                                                                                <p><a href="{{route('personal.inventory.adjustment',$expense->inventory_adjustment_id)}}" class="badge badge-success">Inventory Adjustment</a></p>
                                                                            @elseif($expense->is_transfer_order == 1)
                                                                                <p><a href="{{route('personal.transfer.order.show',$expense->transfer_order_id)}}" class="badge badge-primary">Transfer Order</a></p>
                                                                            @elseif($expense->is_warehouse == 1)
                                                                                <p><a href="{{route('personal.warehouse.show',$expense->warehouse_id)}}" class="badge badge-primary">Warehouse</a></p>
                                                                            @elseif($expense->is_campaign == 1)
                                                                                <p><a href="{{route('personal.campaign.show',$expense->campaign_id)}}" class="badge badge-primary">Campaign</a></p>
                                                                            @elseif($expense->is_sale == 1)
                                                                                <p><a href="{{route('personal.sale.show',$expense->sale_id)}}" class="badge badge-primary">Sale</a></p>
                                                                            @elseif($expense->is_liability == 1)
                                                                                <p><a href="{{route('personal.liability.show',$expense->liability_id)}}" class="badge badge-primary">Liability</a></p>
                                                                            @elseif($expense->is_transfer == 1)
                                                                                <p><a href="{{route('personal.transfer.show',$expense->transfer_id)}}" class="badge badge-primary">Transfer</a></p>
                                                                            @elseif($expense->is_transaction == 1)
                                                                                <p><a href="{{route('personal.transaction.show',$expense->transaction_id)}}" class="badge badge-primary">Transaction</a></p>
                                                                            @else
                                                                                <p><span class="badge badge-info">None</span></p>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$expense->reference}}</td>
                                                                        <td>{{$expense->date}}</td>
                                                                        <td>{{$expense->created_at}}</td>
                                                                        <td>@if ($expense->expenseAccount){{$expense->expenseAccount->name}} @endif</td>
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
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
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

<!-- JSKnob -->
<script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

<!-- Input Mask-->
<script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- NouSlider -->
<script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

<!-- Switchery -->
<script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

<!-- IonRangeSlider -->
<script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

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

<!-- TouchSpin -->
<script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>


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

            var elem_18 = document.querySelector('.js-switch_18');
            var switchery_18 = new Switchery(elem_18, { color: '#1AB394' });

            var elem_19 = document.querySelector('.js-switch_19');
            var switchery_19 = new Switchery(elem_19, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });

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
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_tag").select2({
                placeholder: "Select Tags",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

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
