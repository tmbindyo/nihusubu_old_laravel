@extends('business.layouts.app')

@section('title', "To Do's")

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>To Do's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
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
                        {{-- <li ondblclick = "editNoteOnDoubleClick(this, {{$pendingToDo}})"> --}}
                        <li>
                            <div>
                                @if($pendingToDo->is_end_date === 1)
                                    <small>end date: {{$pendingToDo->end_date}}</small>
                                @endif
                                @if($pendingToDo->is_account === 1)
                                    <p><span class="badge badge-primary">Account:{{$pendingToDo->account->name}}</span></p>
                                @endif
                                @if($pendingToDo->is_account_adjustment === 1)
                                    <p><span class="badge badge-primary">Account Adjustment:{{$pendingToDo->accountAdjustment->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_campaign === 1)
                                    <p><span class="badge badge-primary">Campaign:{{$pendingToDo->campaign->name}}</span></p>
                                @endif
                                @if($pendingToDo->is_contact === 1)
                                    <p><span class="badge badge-primary">Contact:{{$pendingToDo->contact->first_name}} {{$pendingToDo->contact->last_name}}</span></p>
                                @endif
                                @if($pendingToDo->is_deposit === 1)
                                    <p><span class="badge badge-primary">Deposit:{{$pendingToDo->deposit->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_expense === 1)
                                    <p><span class="badge badge-primary">Expense:{{$pendingToDo->expense->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_liability === 1)
                                    <p><span class="badge badge-primary">Liability:{{$pendingToDo->liability->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_loan === 1)
                                    <p><span class="badge badge-primary">Loan:{{$pendingToDo->loan->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_organization === 1)
                                    <p><span class="badge badge-primary">Organization:{{$pendingToDo->organization->name}}</span></p>
                                @endif
                                @if($pendingToDo->is_payment === 1)
                                    <p><span class="badge badge-primary">Payment:{{$pendingToDo->payment->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_product === 1)
                                    <p><span class="badge badge-primary">Product:{{$pendingToDo->product->name}}</span></p>
                                @endif
                                @if($pendingToDo->is_product_group === 1)
                                    <p><span class="badge badge-primary">Product group:{{$pendingToDo->productGroup->name}}</span></p>
                                @endif
                                @if($pendingToDo->is_sale === 1)
                                    <p><span class="badge badge-primary">Sale:{{$pendingToDo->sale->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_transaction === 1)
                                    <p><span class="badge badge-primary">Transaction:{{$pendingToDo->transaction->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_transfer === 1)
                                    <p><span class="badge badge-primary">Transfer:{{$pendingToDo->transfer->reference}}</span></p>
                                @endif
                                @if($pendingToDo->is_warehouse === 1)
                                    <p><span class="badge badge-primary">Warehouse:{{$pendingToDo->warehouse->name}}</span></p>
                                @endif
                                @if($pendingToDo->is_withdrawal === 1)
                                    <p><span class="badge badge-primary">Withdrawal:{{$pendingToDo->withdrawal->reference}}</span></p>
                                @endif
                                <h4>{{$pendingToDo->name}}</h4>
                                <p> {{ \Illuminate\Support\Str::limit($pendingToDo->notes, 205, $end='...') }} </p>
{{--                                <p class = "sticky-note-content" style = "height: 100%">{{$pendingToDo->notes}}.</p>--}}
                                <a href="{{route('business.to.do.set.in.progress',['portal'=>$institution->portal, 'id'=>$pendingToDo->id])}}"><i class="fa fa-arrow-circle-o-right "></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="in-progress-to-do">
                    @foreach($inProgressToDos as $inProgressToDo)
                        <li>
                            <div>
                                @if($inProgressToDo->is_end_date === 1)
                                    <small>end date: {{$inProgressToDo->end_date}}</small>
                                @endif
                                <small>{{$inProgressToDo->due_date}}</small>
                                @if($inProgressToDo->is_account === 1)
                                    <p><span class="badge badge-primary">Account:{{$inProgressToDo->account->name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_account_adjustment === 1)
                                    <p><span class="badge badge-primary">Account Adjustment:{{$inProgressToDo->accountAdjustment->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_campaign === 1)
                                    <p><span class="badge badge-primary">Campaign:{{$inProgressToDo->campaign->name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_contact === 1)
                                    <p><span class="badge badge-primary">Contact:{{$inProgressToDo->contact->first_name}} {{$inProgressToDo->contact->last_name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_deposit === 1)
                                    <p><span class="badge badge-primary">Deposit:{{$inProgressToDo->deposit->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_expense === 1)
                                    <p><span class="badge badge-primary">Expense:{{$inProgressToDo->expense->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_liability === 1)
                                    <p><span class="badge badge-primary">Liability:{{$inProgressToDo->liability->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_loan === 1)
                                    <p><span class="badge badge-primary">Loan:{{$inProgressToDo->loan->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_organization === 1)
                                    <p><span class="badge badge-primary">Organization:{{$inProgressToDo->organization->name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_payment === 1)
                                    <p><span class="badge badge-primary">Payment:{{$inProgressToDo->payment->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_product === 1)
                                    <p><span class="badge badge-primary">Product:{{$inProgressToDo->product->name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_product_group === 1)
                                    <p><span class="badge badge-primary">Product group:{{$inProgressToDo->productGroup->name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_sale === 1)
                                    <p><span class="badge badge-primary">Sale:{{$inProgressToDo->sale->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_transaction === 1)
                                    <p><span class="badge badge-primary">Transaction:{{$inProgressToDo->transaction->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_transfer === 1)
                                    <p><span class="badge badge-primary">Transfer:{{$inProgressToDo->transfer->reference}}</span></p>
                                @endif
                                @if($inProgressToDo->is_warehouse === 1)
                                    <p><span class="badge badge-primary">Warehouse:{{$inProgressToDo->warehouse->name}}</span></p>
                                @endif
                                @if($inProgressToDo->is_withdrawal === 1)
                                    <p><span class="badge badge-primary">Withdrawal:{{$inProgressToDo->withdrawal->reference}}</span></p>
                                @endif
                                <h4>{{$inProgressToDo->name}}</h4>
                                <p> {{ \Illuminate\Support\Str::limit($inProgressToDo->notes, 205, $end='...') }} </p>
                                <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$inProgressToDo->id])}}"><i class="fa fa-check "></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="overdue-to-do">
                    @foreach($overdueToDos as $overdueToDo)
                        <li>
                            <div>
                                @if($overdueToDo->is_end_date === 1)
                                    <small>end date: {{$overdueToDo->end_date}}</small>
                                @endif
                                @if($overdueToDo->is_account === 1)
                                    <p><span class="badge badge-primary">Account:{{$overdueToDo->account->name}}</span></p>
                                @endif
                                @if($overdueToDo->is_account_adjustment === 1)
                                    <p><span class="badge badge-primary">Account Adjustment:{{$overdueToDo->accountAdjustment->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_campaign === 1)
                                    <p><span class="badge badge-primary">Campaign:{{$overdueToDo->campaign->name}}</span></p>
                                @endif
                                @if($overdueToDo->is_contact === 1)
                                    <p><span class="badge badge-primary">Contact:{{$overdueToDo->contact->first_name}} {{$overdueToDo->contact->last_name}}</span></p>
                                @endif
                                @if($overdueToDo->is_deposit === 1)
                                    <p><span class="badge badge-primary">Deposit:{{$overdueToDo->deposit->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_expense === 1)
                                    <p><span class="badge badge-primary">Expense:{{$overdueToDo->expense->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_liability === 1)
                                    <p><span class="badge badge-primary">Liability:{{$overdueToDo->liability->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_loan === 1)
                                    <p><span class="badge badge-primary">Loan:{{$overdueToDo->loan->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_organization === 1)
                                    <p><span class="badge badge-primary">Organization:{{$overdueToDo->organization->name}}</span></p>
                                @endif
                                @if($overdueToDo->is_payment === 1)
                                    <p><span class="badge badge-primary">Payment:{{$overdueToDo->payment->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_product === 1)
                                    <p><span class="badge badge-primary">Product:{{$overdueToDo->product->name}}</span></p>
                                @endif
                                @if($overdueToDo->is_product_group === 1)
                                    <p><span class="badge badge-primary">Product group:{{$overdueToDo->productGroup->name}}</span></p>
                                @endif
                                @if($overdueToDo->is_sale === 1)
                                    <p><span class="badge badge-primary">Sale:{{$overdueToDo->sale->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_transaction === 1)
                                    <p><span class="badge badge-primary">Transaction:{{$overdueToDo->transaction->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_transfer === 1)
                                    <p><span class="badge badge-primary">Transfer:{{$overdueToDo->transfer->reference}}</span></p>
                                @endif
                                @if($overdueToDo->is_warehouse === 1)
                                    <p><span class="badge badge-primary">Warehouse:{{$overdueToDo->warehouse->name}}</span></p>
                                @endif
                                @if($overdueToDo->is_withdrawal === 1)
                                    <p><span class="badge badge-primary">Withdrawal:{{$overdueToDo->withdrawal->reference}}</span></p>
                                @endif
                                <h4>{{$overdueToDo->name}}</h4>
                                <p> {{ \Illuminate\Support\Str::limit($overdueToDo->notes, 205, $end='...') }} </p>
                                @if($overdueToDo->status->name === "Pending")
                                    <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                @elseif($overdueToDo->status->name === "In progress")
                                    <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                @endif

                                <a href="{{route('business.to.do.delete',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="completed-to-do">
                    @foreach($completedToDos as $completedToDo)
                        <li>
                            <div>
                                @if($completedToDo->is_end_date === 1)
                                    <small>end date: {{$completedToDo->end_date}}</small>
                                @endif
                                @if($completedToDo->is_account === 1)
                                    <p><span class="badge badge-primary">Account:{{$completedToDo->account->name}}</span></p>
                                @endif
                                @if($completedToDo->is_account_adjustment === 1)
                                    <p><span class="badge badge-primary">Account Adjustment:{{$completedToDo->accountAdjustment->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_campaign === 1)
                                    <p><span class="badge badge-primary">Campaign:{{$completedToDo->campaign->name}}</span></p>
                                @endif
                                @if($completedToDo->is_contact === 1)
                                    <p><span class="badge badge-primary">Contact:{{$completedToDo->contact->first_name}} {{$completedToDo->contact->last_name}}</span></p>
                                @endif
                                @if($completedToDo->is_deposit === 1)
                                    <p><span class="badge badge-primary">Deposit:{{$completedToDo->deposit->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_expense === 1)
                                    <p><span class="badge badge-primary">Expense:{{$completedToDo->expense->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_liability === 1)
                                    <p><span class="badge badge-primary">Liability:{{$completedToDo->liability->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_loan === 1)
                                    <p><span class="badge badge-primary">Loan:{{$completedToDo->loan->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_organization === 1)
                                    <p><span class="badge badge-primary">Organization:{{$completedToDo->organization->name}}</span></p>
                                @endif
                                @if($completedToDo->is_payment === 1)
                                    <p><span class="badge badge-primary">Payment:{{$completedToDo->payment->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_product === 1)
                                    <p><span class="badge badge-primary">Product:{{$completedToDo->product->name}}</span></p>
                                @endif
                                @if($completedToDo->is_product_group === 1)
                                    <p><span class="badge badge-primary">Product group:{{$completedToDo->productGroup->name}}</span></p>
                                @endif
                                @if($completedToDo->is_sale === 1)
                                    <p><span class="badge badge-primary">Sale:{{$completedToDo->sale->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_transaction === 1)
                                    <p><span class="badge badge-primary">Transaction:{{$completedToDo->transaction->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_transfer === 1)
                                    <p><span class="badge badge-primary">Transfer:{{$completedToDo->transfer->reference}}</span></p>
                                @endif
                                @if($completedToDo->is_warehouse === 1)
                                    <p><span class="badge badge-primary">Warehouse:{{$completedToDo->warehouse->name}}</span></p>
                                @endif
                                @if($completedToDo->is_withdrawal === 1)
                                    <p><span class="badge badge-primary">Withdrawal:{{$completedToDo->withdrawal->reference}}</span></p>
                                @endif
                                <h4>{{$completedToDo->name}}</h4>
                                <p> {{ \Illuminate\Support\Str::limit($completedToDo->notes, 205, $end='...') }} </p>
                                <a href="{{route('business.to.do.delete',['portal'=>$institution->portal, 'id'=>$completedToDo->id])}}"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
@include('business.layouts.modals.to_do_create')
@include('business.layouts.modals.to_do_edit')
@section('js')


<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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



{{--  Get due date to populate   --}}
<script>
    $(document).ready(function() {
        // Set date

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
        if (m < 10){
            m = '0'+m;
        }
        var date_today = mm + '/' + dd + '/' + yyyy;
        var time_curr = h + ':' + m;

        console.log(time_curr);
        document.getElementById("start_date").value = date_today;
        document.getElementById("end_date").value = date_today;
        document.getElementById("start_time").value = time_curr;
        document.getElementById("end_time").value = time_curr;

        // Set time
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

        var elem_4 = document.querySelector('.js-switch_4');
        var switchery_4 = new Switchery(elem_4, { color: '#1AB394' });

        var elem_5 = document.querySelector('.js-switch_5');
        var switchery_5 = new Switchery(elem_5, { color: '#1AB394' });

        var elem_6 = document.querySelector('.js-switch_6');
        var switchery_6 = new Switchery(elem_6, { color: '#1AB394' });

        var elem_7 = document.querySelector('.js-switch_7');
        var switchery_7 = new Switchery(elem_7, { color: '#1AB394' });

        var elem_8 = document.querySelector('.js-switch_8');
        var switchery_8 = new Switchery(elem_8, { color: '#1AB394' });

        var elem_9 = document.querySelector('.js-switch_9');
        var switchery_9 = new Switchery(elem_9, { color: '#1AB394' });

        var elem_10 = document.querySelector('.js-switch_10');
        var switchery_10 = new Switchery(elem_10, { color: '#1AB394' });

        var elem_11 = document.querySelector('.js-switch_11');
        var switchery_11 = new Switchery(elem_11, { color: '#1AB394' });

        var elem_12 = document.querySelector('.js-switch_12');
        var switchery_12 = new Switchery(elem_12, { color: '#1AB394' });

        var elem_13 = document.querySelector('.js-switch_13');
        var switchery_13 = new Switchery(elem_13, { color: '#1AB394' });

        var elem_14 = document.querySelector('.js-switch_14');
        var switchery_14 = new Switchery(elem_14, { color: '#1AB394' });

        var elem_15 = document.querySelector('.js-switch_15');
        var switchery_15 = new Switchery(elem_15, { color: '#1AB394' });

        var elem_16 = document.querySelector('.js-switch_16');
        var switchery_16 = new Switchery(elem_16, { color: '#1AB394' });

        var elem_17 = document.querySelector('.js-switch_17');
        var switchery_17 = new Switchery(elem_17, { color: '#1AB394' });

        var elem_18 = document.querySelector('.js-switch_18');
        var switchery_18 = new Switchery(elem_18, { color: '#1AB394' });
        console.log(switchery_18)

        var elem_19 = document.querySelector('.js-switch_19');
        var switchery_19 = new Switchery(elem_19, { color: '#1AB394' });

        function EnableDisableTextBox(is_end_date) {
            console.log(is_end_date)
            var end_date = document.getElementById("end_date");
            end_date.disabled = is_end_date.checked ? false : true;
            if (!end_date.disabled) {
                end_date.focus();

            }
        }

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
        $(".select2_demo_album").select2({
            placeholder: "Select Album",
            allowClear: true
        });
        $(".select2_demo_design").select2({
            placeholder: "Select Design",
            allowClear: true
        });
        $(".select2_demo_journal").select2({
            placeholder: "Select Journal",
            allowClear: true
        });
        $(".select2_demo_journal_series").select2({
            placeholder: "Select Journal Series",
            allowClear: true
        });
        $(".select2_demo_project").select2({
            placeholder: "Select Project",
            allowClear: true
        });
        $(".select2_demo_product").select2({
            placeholder: "Select Product",
            allowClear: true
        });
        $(".select2_demo_order").select2({
            placeholder: "Select Order",
            allowClear: true
        });
        $(".select2_demo_email").select2({
            placeholder: "Select Email",
            allowClear: true
        });
        $(".select2_demo_contact").select2({
            placeholder: "Select Contact",
            allowClear: true
        });
        $(".select2_demo_organization").select2({
            placeholder: "Select Organization",
            allowClear: true
        });
        $(".select2_demo_deal").select2({
            placeholder: "Select Deal",
            allowClear: true
        });
        $(".select2_demo_campaign").select2({
            placeholder: "Select Campaign",
            allowClear: true
        });
        $(".select2_demo_asset").select2({
            placeholder: "Select Asset",
            allowClear: true
        });
        $(".select2_demo_kit").select2({
            placeholder: "Select Kit",
            allowClear: true
        });
        $(".select2_demo_asset_action").select2({
            placeholder: "Select Asset Action",
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


</script>

<script type="text/javascript">

</script>

@endsection
