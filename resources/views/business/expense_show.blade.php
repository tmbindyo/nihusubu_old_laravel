@extends('business.layouts.app')

@section('title', ' Expense Show')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Expense</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.accounts',$institution->portal)}}">Accounts</a>
                </li>
                <li>
                    <a href="{{route('business.expenses',$institution->portal)}}">Expenses</a>
                </li>
                <li class="active">
                    <strong>Expense</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">

                <a href="{{route('business.expense.edit',['portal'=>$institution->portal, 'id'=>$expense->id])}}" class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{route('business.transaction.create',['portal'=>$institution->portal, 'id'=>$expense->id])}}" class="btn btn-warning btn-outline"> <i class="fa fa-dollar"></i> Make Payment</a>
                @if($expense->is_inventory_adjustment == 1)
                    <a href="{{route('business.inventory.adjustment.show',['portal'=>$institution->portal, 'id'=>$expense->inventory_adjustment_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Inventory Adjustment </a>
                @endif
                @if($expense->is_transfer_order == 1)
                    <a href="{{route('business.transfer.order.show',['portal'=>$institution->portal, 'id'=>$expense->transfer_order_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Transfer Order </a>
                @endif
                @if($expense->is_warehouse == 1)
                    <a href="{{route('business.warehouse.show',['portal'=>$institution->portal, 'id'=>$expense->warehouse_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Warehouse </a>
                @endif
                @if($expense->is_campaign == 1)
                    <a href="{{route('business.campaign.show',['portal'=>$institution->portal, 'id'=>$expense->campaign_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Campaign </a>
                @endif
                @if($expense->is_sale == 1)
                    <a href="{{route('business.sale.show',['portal'=>$institution->portal, 'id'=>$expense->sale_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Sale </a>
                @endif
                @if($expense->is_liability == 1)
                    <a href="{{route('business.liability.show',['portal'=>$institution->portal, 'id'=>$expense->liability_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Liability </a>
                @endif
                @if($expense->is_transfer == 1)
                    <a href="{{route('business.transfer.show',['portal'=>$institution->portal, 'id'=>$expense->transfer_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Transfer </a>
                @endif
                @if($expense->is_transaction == 1)
                    <a href="{{route('business.transaction.show',['portal'=>$institution->portal, 'id'=>$expense->transaction_id])}}" class="btn btn-primary btn-outline"><i class="fa fa-eye"></i> Transaction </a>
                @endif
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>By:</h5>
                                <address>
                                    <strong>{{$expense->user->name}}</strong>
                                </address>
                            </div>

                            <div class="col-sm-6 text-right">
                                <h4>Expense No.</h4>
                                <h4 class="text-navy">{{$expense->reference}}</h4>
                                <p>
                                    <span><strong>Expense Date:</strong> <a href="#" class="text-navy"> {{$expense->date}} </a> </span><br/>
                                </p>
                                <h4>Expense Details:</h4>
{{--                                <address>--}}
{{--                                    <strong>{{$expense->contact->last_name}} {{$expense->contact->first_name}}</strong><br>--}}
{{--                                    <abbr title="Phone">P:</abbr> {{$expense->contact->phone_number}}<br>--}}
{{--                                    <abbr title="Email">E:</abbr> {{$expense->contact->email}}--}}
{{--                                </address>--}}
                                <address>
                                    <strong>Status:</strong> <a><span >{{$expense->status->name}}</span></a><br>
                                    <strong>Expense Account:</strong> <a href="#" class="text-navy"> {{$expense->expenseAccount->name}} </a><br>
                                    <strong>Account:</strong> <a href="#" class="text-navy"> {{$expense->account->name}} </a><br>
                                    @isset($expense->sale_id)
                                        <strong>Sale:</strong> <a class="text-navy" href="{{ route('business.sale.show', ['portal'=>$institution->portal, 'id'=>$expense->sale_id]) }}">{{$expense->sale->reference}}</a><br>
                                    @endisset()
                                    @isset($expense->liability_id)
                                        <strong>Liability:</strong> <a class="text-navy" href="{{ route('business.liability.show', ['portal'=>$institution->portal, 'id'=>$expense->liability_id]) }}">{{$expense->liability->reference}}</a><br>
                                    @endisset()
                                    @isset($expense->transfer_id)
                                        <strong>Transfer:</strong> <a class="text-navy" href="{{ route('business.transfer.show', ['portal'=>$institution->portal, 'id'=>$expense->transfer_id]) }}">{{$expense->transfer->reference}}</a><br>
                                    @endisset()
                                    @isset($expense->campaign_id)
                                        <strong>Campaign:</strong> <a class="text-navy" href="{{ route('business.campaign.show', ['portal'=>$institution->portal, 'id'=>$expense->campaign_id]) }}">{{$expense->campaign->name}}</a><br>
                                    @endisset()
                                    <br>
                                    @if($expense->is_recurring == 1)
                                        <h5>Frequency</h5>
                                        <strong>Frequency:</strong> <a href="#" class="text-navy"> {{$expense->frequency->name}}</a><br>
                                        <strong>Start Repeat:</strong> <a href="#" class="text-navy"> {{$expense->start_repeat}}<br> </a>
                                        <strong>End Repeat:</strong> <a href="#" class="text-navy"> {{$expense->end_repeat}} </a>
                                    @endif

                                </address>

                            </div>
                        </div>

                        <div class="table-responsive m-t">
                            <table class="table invoice-table">
                                <thead>
                                <tr>
                                    <th>Item List</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expense->expenseItems as $product)
                                    <tr>
                                        <td>
                                            <div><strong>{{$product->name}}</strong></div>
                                        </td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->rate}}</td>
                                        <td>{{$product->amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /table-responsive -->

                        <table class="table invoice-total">
                            <tbody>
                            <tr>
                                <td><strong>Sub Total :</strong></td>
                                <td>{{$expense->subtotal}}</td>
                            </tr>
                            <tr>
                                <td><strong>TAX :</strong></td>
                                <td>{{$expense->tax}}</td>
                            </tr>
                            <tr>
                                <td><strong>Discount :</strong></td>
                                <td>{{$expense->discount}}</td>
                            </tr>
                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td>{{$expense->total}}</td>
                            </tr>
                            </tbody>
                        </table>
                        {{-- <div class="text-right">
                            <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                        </div> --}}

                        <div class="well m-t"><strong>Description</strong>
                            {{$expense->notes}}
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

                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab-1" data-toggle="tab">Payments</a></li>
                                                    <li class=""><a href="#tab-2" data-toggle="tab">Pending Payments</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-1">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-payments" >
                                                            <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Reference #</th>
                                                                <th>Account</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                @if($expense->status_id == '04f83a7c-9c4e-47ff-8e26-41b3b83b03d0')
                                                                    <th>Action</th>
                                                                @endif
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($payments as $transaction)
                                                                <tr class="gradeA">
                                                                    <td>{{$transaction->date}}</td>
                                                                    <td>{{$transaction->reference}}</td>
                                                                    <td>
                                                                        {{$transaction->account->name}}
                                                                    </td>
                                                                    <td>{{$transaction->amount}}</td>
                                                                    <td>
                                                                        <p><span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span></p>
                                                                    </td>
                                                                    @if($expense->status_id == '04f83a7c-9c4e-47ff-8e26-41b3b83b03d0')
                                                                        <td class="text-right">
                                                                            @if($transaction->is_billed == false)
                                                                                <div class="btn-group">
                                                                                    <a href="{{ route('business.transaction.billed', ['portal'=>$institution->portal, 'id'=>$transaction->id]) }}" class="btn-warning btn btn-xs">Mark Billed</a>
                                                                                </div>
                                                                            @else
                                                                                <label class="label label-primary">Marked Billed</label>
                                                                            @endif
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Reference #</th>
                                                                <th>Account</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                @if($expense->status_id == '04f83a7c-9c4e-47ff-8e26-41b3b83b03d0')
                                                                    <th>Action</th>
                                                                @endif
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab-2">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-pending-payments" >
                                                            <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Reference #</th>
                                                                <th>Account</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($pendingPayments as $transaction)
                                                                <tr class="gradeA">
                                                                    <td>{{$transaction->date}}</td>
                                                                    <td>{{$transaction->reference}}</td>
                                                                    <td>{{$transaction->account->name}}</td>
                                                                    <td>{{$transaction->amount}}</td>
                                                                    <td>
                                                                        <p><span class="label {{$transaction->status->label}}">{{$transaction->status->name}}</span></p>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('business.transaction.pending.payment', $transaction->id) }}" class="btn-warning btn btn-xs">Mark Paid</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Reference #</th>
                                                                <th>Account</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
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

        {{--    To Do's    --}}
        <div class="row m-t-lg">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>To Do's</h5>
                        <div class="ibox-tools">
                            <a data-toggle="modal" data-target="#toDoRegistration" class="btn btn-success btn-round btn-outline"> <span class="fa fa-plus"></span> New</a>
                        </div>
                    </div>
                    <div class="">
                        <ul class="pending-to-do">
                            @foreach($pendingToDos as $pendingToDo)
                                <li>
                                    <div>
                                        <small>{{$pendingToDo->due_date}}</small>
                                        <h4>{{$pendingToDo->name}}</h4>
                                        <p>{{$pendingToDo->notes}}.</p>
                                        @if($pendingToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$pendingToDo->design->name}}</span></p>
                                        @endif
                                        <a href="{{route('business.to.do.set.in.progress',['portal'=>$institution->portal, 'id'=>$pendingToDo->id])}}"><i class="fa fa-arrow-circle-o-right "></i></a>
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
                                        @if($inProgressToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$inProgressToDo->design->name}}</span></p>
                                        @endif
                                        <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$inProgressToDo->id])}}"><i class="fa fa-check "></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="overdue-to-do">
                            @foreach($overdueToDos as $overdueToDo)
                                <li>
                                    <div>
                                        <small>{{$overdueToDo->due_date}}</small>
                                        <h4>{{$overdueToDo->name}}</h4>
                                        <p>{{$overdueToDo->notes}}.</p>
                                        @if($overdueToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$overdueToDo->design->name}}</span></p>
                                        @endif
                                        @if($overdueToDo->status->name === "Pending")
                                            <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                        @elseif($overdueToDo->status->name === "In progress")
                                            <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="completed-to-do">
                            @foreach($completedToDos as $completedToDo)
                                <li>
                                    <div>
                                        <small>{{$completedToDo->due_date}}</small>
                                        <h4>{{$completedToDo->name}}</h4>
                                        <p>{{$completedToDo->notes}}.</p>
                                        @if($completedToDo->is_design === 1)
                                            <p><span class="badge badge-primary">{{$completedToDo->design->name}}</span></p>
                                        @endif
                                        <a href="{{route('business.to.do.delete',['portal'=>$institution->portal, 'id'=>$completedToDo->id])}}"><i class="fa fa-trash-o "></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>







@endsection

@include('business.layouts.modals.expense_to_do')

@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<!-- blueimp gallery -->
<script src="{{ asset('inspinia') }}/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

<!-- DROPZONE -->
<script src="{{ asset('inspinia') }}/js/plugins/dropzone/dropzone.js"></script>

<!-- Switchery -->
<script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

<!-- Image cropper -->
<script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- JSKnob -->
<script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

<!-- Input Mask-->
<script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- NouSlider -->
<script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

<!-- IonRangeSlider -->
<script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

<!-- MENU -->
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Clock picker -->
<script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

<!-- Select2 -->
<script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

<!-- TouchSpin -->
<script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Masonry -->
<script src="{{ asset('inspinia') }}/js/plugins/masonary/masonry.pkgd.min.js"></script>

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
{{--  Data tables  --}}
<script>
    $(document).ready(function(){
        $('.dataTables-payments').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$expense->reference}} Payments',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$expense->reference}} Payments',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },

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
        $('.dataTables-pending-payments').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$expense->reference}} Penidng Payemnts',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$expense->reference}} Penidng Payemnts',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },

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
