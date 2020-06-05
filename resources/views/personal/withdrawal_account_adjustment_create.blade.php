@extends('personal.layouts.app')

@section('title', ' Withdrawal Account Adjustment Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

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

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Account Adjustments</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('personal.calendar')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('personal.expenses')}}">Account Adjustments</a>
                    </li>
                    <li class="active">
                        <strong>Account Adjustment Create</strong>
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
                                <form method="post" action="{{ route('personal.account.adjustment.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                    <br>
                                    {{--  accounts  --}}
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="has-warning">
                                                <select name="account" class="select-2 form-control input-lg">
                                                    <option selected disabled>Select Account</option>
                                                    @foreach($accounts as $accountSelected)
                                                        <option @if($accountSelected->id == $account->id) selected @endif value="{{$accountSelected->id}}" >{{$accountSelected->name}}[{{$accountSelected->balance}}]</option>
                                                    @endforeach
                                                </select>
                                                <i> account.</i>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    {{--  withdrawal  --}}
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="has-warning">
                                                <select name="withdrawal" class="select-2 form-control input-lg">
                                                    <option value="{{$withdrawal->id}}" >{{$withdrawal->reference}}[{{$withdrawal->amount}}]</option>
                                                </select>
                                                <i> withdrawal.</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="has-warning">
                                                <input type="checkbox" name="is_withdrawal" class="js-switch_3" checked/>
                                                <br>
                                                <i>is withdrawal</i>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  amount  --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="has-warning">
                                                        <input type="number" name="amount" id="amount" class="form-control input-lg" required>
                                                        <i> amount ({{$withdrawal->amount}}).</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="has-warning" id="data_1">
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" name="date" id="date" class="form-control input-lg" required>
                                                        </div>
                                                        <i> adjustment date.</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="has-warning">
                                                <textarea name="notes" placeholder="Notes" class="form-control" rows="7"></textarea>
                                                <i> notes.</i>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <hr>
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

{{--  Get due date to populate   --}}
    <script>
        $(document).ready(function() {
            // Set date
            console.log('var');
            var today = new Date();
            console.log(today);
            var dd = today.getDate();
            var mm = today.getMonth();
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            mm ++;
            if (dd < 10){
                dd = '0'+dd;
            }
            if (mm < 10){
                mm = '0'+mm;
            }
            var date_today = mm + '/' + dd + '/' + yyyy;
            var time_curr = h + ':' + m;
            console.log(time_curr);
            document.getElementById("date").value = date_today;

            // Set time
        });

    </script>

<script>
    $(document).ready(function() {
        $('.select-2').select2();
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
        $(".select2_demo_tag").select2({
            placeholder: "Select Tags",
            allowClear: true
        });
        $(".select2_demo_design").select2({
            placeholder: "Select Project",
            allowClear: true
        });
        $(".select2_demo_category").select2({
            placeholder: "Select Categories",
            allowClear: true
        });


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
        document.getElementById("due_date").value = date_today;
        document.getElementById("date").value = date_today;
    });

</script>

<script>
    var subTotal = [];
    var adjustedValue;
    function itemSelected (e) {
        var selectedItemQuantity = e.options[e.selectedIndex].getAttribute("data-product-quantity");
        var selectItemPrice = e.options[e.selectedIndex].getAttribute("data-product-selling-price");
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemQuantity = selectedTr.getElementsByClassName("item-quantity");
        var itemRate = selectedTr.getElementsByClassName("item-rate");
        // -20 is an arbitrary value set to indicate that an item is a service and so has no limit
        if (selectedItemQuantity === "-20") {
            itemQuantity[0].setAttribute("max", 100000000);
        } else {
            itemQuantity[0].setAttribute("max", selectedItemQuantity);
        };
        itemRate[0].value = selectItemPrice;
    };
    function changeItemQuantity (e) {
        var quantityValue;
        if (e.value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = e.value;
        };
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemRateInputField = selectedTr.getElementsByClassName("item-rate");
        var itemTotalInputField = selectedTr.getElementsByClassName("item-total");
        var itemRate;
        if (itemRateInputField[0].value.isEmpty) {
            itemRate = 0;
        } else {
            itemRate = itemRateInputField[0].value;
        };
        itemTotalInputField[0].value = quantityValue * itemRate;
        itemTotalChange();
    };
    function changeItemRate (e) {
        var itemRate;
        if (e.value.isEmpty) {
            itemRate = 0;
        } else {
            itemRate = e.value;
        };
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemQuantityInputField = selectedTr.getElementsByClassName("item-quantity");
        var itemTotalInputField = selectedTr.getElementsByClassName("item-total");
        var quantityValue;
        if (itemQuantityInputField[0].value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = itemQuantityInputField[0].value;
        };
        itemTotalInputField[0].value = quantityValue * itemRate;
        itemTotalChange();
    };
    var tableValueArrayIndex = 1;
    function addTableRow () {
        var table = document.getElementById("expense_table");
        var row = table.insertRow();
        var firstCell = row.insertCell(0);
        var secondCell = row.insertCell(1);
        var thirdCell = row.insertCell(2);
        var fourthCell = row.insertCell(3);
        var fifthCell = row.insertCell(4);
        firstCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][item]' type='text' class='form-control input-lg item-detail'>";
        secondCell.innerHTML = "<input oninput = 'changeItemQuantity(this)' name='item_details["+tableValueArrayIndex+"][quantity]' type='number' class='form-control input-lg item-quantity' value = '0' min = '0'>";
        thirdCell.innerHTML = "<input oninput = 'changeItemRate(this)' name='item_details["+tableValueArrayIndex+"][rate]' type='number' class='form-control input-lg item-rate' placeholder='E.g +10, -10' value = '0' min = '0'>";
        fourthCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][amount]' type='number' class='form-control input-lg item-total' placeholder='E.g +10, -10' value = '0' min = '0'>";
        fifthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
        fifthCell.setAttribute("style", "width: 1em;")
        tableValueArrayIndex++;
    };
    function removeSelectedRow (e) {
        var selectedParentTd = e.parentElement.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var selectedTable = selectedTr.parentElement;
        var removed = selectedTr.getElementsByClassName("item-select")[0].getAttribute("name");
        adjustTableInputFieldsIndex(removed);
        selectedTable.removeChild(selectedTr);
        tableValueArrayIndex--;
        itemTotalChange();
    };
    function adjustTableInputFieldsIndex (removedFieldName) {
        // Fields whose values are submitted are:
        // 1. item_details[][item]
        // 2. item_details[][quantity]
        // 3. item_details[][rate]
        // 4. item_details[][amount]
        var displacement = 0;
        var removedIndex;
        while (displacement < tableValueArrayIndex) {
            if (removedFieldName == "item_details["+displacement+"][item]"){
                removedIndex = displacement;
            } else {
                var itemField = document.getElementsByName("item_details["+displacement+"][item]");
                var quantityField = document.getElementsByName("item_details["+displacement+"][quantity]");
                var rateField = document.getElementsByName("item_details["+displacement+"][rate]");
                var amountField = document.getElementsByName("item_details["+displacement+"][amount]");
                if (removedIndex) {
                    if (displacement > removedIndex) {
                        var newIndex = displacement - 1;
                        itemField[0].setAttribute("name", "item_details["+newIndex+"][item]");
                        quantityField[0].setAttribute("name", "item_details["+newIndex+"][quantity]");
                        rateField[0].setAttribute("name", "item_details["+newIndex+"][rate]");
                        amountField[0].setAttribute("name", "item_details["+newIndex+"][amount]");
                    };
                };
            };
            displacement++;
        };
    };
    function itemTotalChange () {
        subTotal = [];
        var itemTotals = document.getElementsByClassName("item-total");
        for (singleTotal of itemTotals) {
            subTotal.push(Number(singleTotal.value));
        };
        var itemSubTotal = subTotal.reduce((a, b) => a + b, 0);
        document.getElementById("items-subtotal").value = itemSubTotal;
        document.getElementById("grand-total").innerHTML = itemSubTotal;
        var adjustedValueInputValue = document.getElementById("adjustment-value").value;
        if (adjustedValueInputValue.isEmpty) {
            adjustedValue = 0
        } else {
            adjustedValue = adjustedValueInputValue;
        };
        document.getElementById("adjustment-text").innerHTML = adjustedValue;
        var adjustedTotal = Number(adjustedValue) + Number(itemSubTotal);
        document.getElementById("grand-total").value = adjustedTotal;
    };
</script>
@endsection
