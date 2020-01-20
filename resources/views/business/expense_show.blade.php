@extends('business.layouts.app')

@section('title', ' Expense')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Expense</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.accounts')}}">Accounts</a>
                </li>
                <li>
                    <a href="{{route('business.expenses')}}">Expenses</a>
                </li>
                <li class="active">
                    <strong>Expense</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="{{route('business.expense.edit',$expense->id)}}" class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit </a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-md-9">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>{{$expense->expense_items_count}}</strong>) items</span>
                        <h5>Items</h5>
                    </div>
                    @foreach($expense->expense_items as $product)
                        <div class="ibox-content">


                        <div class="table-responsive">
                            <table class="table shoping-cart-table">

                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="{{route('business.product.show',$product->id)}}" class="text-navy">
                                                {{$product->name}}
                                            </a>
                                        </h3>

{{--                                            {!! $product->product->description !!}--}}

                                        <div class="m-t-sm">
                                            <a href="{{route('business.expense.product.delete',$product->id)}}" class="text-warning"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        <h4>
                                            {{$product->rate}}
                                        </h4>
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" value="{{$product->quantity}}" readonly>
                                    </td>
                                    <td>
                                        <h4>
                                            {{$product->amount}}
                                        </h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    @endforeach
                    <div class="ibox-content">


                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                            {{$expense->total}}
                        </h2>

                        <hr/>
                        <span>
                            Sub Total
                        </span>
                        <h2 class="font-bold">
                            {{$expense->sub_total}}
                        </h2>

                        <hr/>
                        <span>
                            Discount
                        </span>
                        <h2 class="font-bold">
                            {{$expense->adjustment}}
                        </h2>

                        <hr/>
                        <span>
                            Paid
                        </span>
                        <h2 class="font-bold">
                            {{$expense->paid}}
                        </h2>

                        <hr/>
                        <span class="text-muted small">
{{--                                @if($expense->customer->is_business == 1)--}}
{{--                                    --}}{{--  if business  --}}
{{--                                    <address>--}}
{{--                                        <strong>{{$expense->customer->company_name}}</strong><br>--}}
{{--                                        112 Street Avenu, 1080<br>--}}
{{--                                        Miami, CT 445611<br>--}}
{{--                                        <abbr title="Phone">P:</abbr> {{$expense->customer->phone_number}}<br>--}}
{{--                                        <abbr title="Email">E:</abbr> {{$expense->customer->email}}--}}
{{--                                    </address>--}}
{{--                                @else--}}
{{--                                    --}}{{--  if not business  --}}
{{--                                    <address>--}}
{{--                                        <strong>{{$expense->customer->first_name}} {{$expense->customer->last_name}}</strong><br>--}}
{{--                                        112 Street Avenu, 1080<br>--}}
{{--                                        Miami, CT 445611<br>--}}
{{--                                        <abbr title="Phone">P:</abbr> {{$expense->customer->phone_number}}<br>--}}
{{--                                        <abbr title="Email">E:</abbr> {{$expense->customer->email}}--}}
{{--                                    </address>--}}
{{--                                @endif--}}
                        </span>
                        <div class="m-t-sm">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-mail-forward"></i> Send</a>
                                <a href="#" class="btn btn-danger btn-sm"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    @if($expense->is_draft == 1)
                                        <a href="#" class="btn btn-white btn-xs pull-right"> Draft</a>
                                    @endif
                                    <h2>{{$expense->reference}}</h2>
                                    <a href="{{route('business.transaction.create',$expense->id)}}" class="pull-right btn btn-primary btn-outline">Make Payment</a>
                                </div>
                                <dl class="dl-horizontal">
                                    <dt>Status:</dt> <dd><span class="label {{$expense->status->label}}">{{$expense->status->name}}</span></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <dl class="dl-horizontal">

                                    <dt>Created by:</dt> <dd>{{$expense->user->name}}</dd>
                                    <dt>Expense Account:</dt> <dd><a href="#" class="text-navy"> {{$expense->expense_account->name}}</a> </dd>
                                    <dt>Date:</dt> <dd>{{$expense->date}}</dd>
                                </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                                <dl class="dl-horizontal" >


                                    @if($expense->is_recurring == 1)
                                        <dt>Frequency:</dt> <dd><a href="#" class="text-navy"> {{$expense->frequency->name}}</a> </dd>
                                        <dt>Start Repeat:</dt> <dd> 	{{$expense->start_repeat}} </dd>
                                        <dt>End Repeat:</dt> <dd> 	{{$expense->end_repeat}} </dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <dl class="dl-horizontal">
                                    <dt>Completed:</dt>
                                    <dd>
                                        <div class="progress progress-striped active m-b-sm">
                                            <div style="width: 60%;" class="progress-bar"></div>
                                        </div>
                                        <small>Project completed in <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                    </dd>
                                </dl>
                            </div>
                        </div>
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
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
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
                                                                        @if($transaction->is_billed == False)
                                                                            <div class="btn-group">
                                                                                    <a href="{{ route('business.transaction.billed', $transaction->id) }}" class="btn-warning btn btn-xs">Mark Billed</a>
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
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
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
        <div class="col-lg-3">
            <div class="wrapper wrapper-content project-manager">
                <h4>Expense description</h4>
                <p class="small">
                    {{$expense->notes}}
                </p>
                <p class="small font-bold">
                    @if($expense->is_recurring == 1)
                    <span><i class="fa fa-circle text-warning"></i>
                        Recurring
                    </span>
                    @endif
                </p>
                <h5>Relationship</h5>
                <ul class="tag-list" style="padding: 0">
                    @if($expense->is_order == 1)
                        <li><a href="{{route('business.order.show',$expense->order->id)}}"><i class="fa fa-shopping-cart"></i> {{$expense->order->order_number}}</a></li>
                    @endif
                        @if($expense->is_album == 1)
                            @if($expense->album->album_type_id = "ca64a5e0-d39b-4f2c-a136-9c523d935ea4")
                                <li><a href="{{route('business.client.proof.show',$expense->album->id)}}"><i class="fa fa-camera"></i> {{$expense->album->name}}</a></li>
                            @elseif($expense->album->album_type_id = "6fdf4858-01ce-43ff-bbe6-827f09fa1cef")
                                <li><a href="{{route('business.personal.album.show',$expense->album->id)}}"><i class="fa fa-camera"></i> {{$expense->album->name}}</a></li>
                            @endif
                    @endif
                    @if($expense->is_project == 1)
                        <li><a href="{{route('business.project.show',$expense->project->id)}}"><i class="fa fa-trello"></i> {{$expense->project->name}}</a></li>
                    @endif
                    @if($expense->is_design == 1)
                        <li><a href="{{route('business.design.show',$expense->design->id)}}"><i class="fa fa-paint-brush"></i> {{$expense->design->name}}</a></li>
                    @endif
                    @if($expense->is_transfer == 1 )
                        <li><a href="{{route('business.transfer.show',$expense->transfer->id)}}"><i class="fa fa-share"></i> {{$expense->transfer->reference}}</a></li>
                    @endif
                    @if($expense->is_campaign == 1 )
                        <li><a href="{{route('business.campaign.show',$expense->campaign->id)}}"><i class="fa fa-share"></i> {{$expense->campaign->name}}</a></li>
                    @endif
                    @if($expense->is_asset == 1 )
                        <li><a href="{{route('business.asset.show',$expense->asset->id)}}"><i class="fa fa-share"></i> {{$expense->asset->name}}</a></li>
                    @endif
                    @if($expense->is_liability == 1 )
                        <li><a href="{{route('business.liability.show',$expense->liability->id)}}"><i class="fa fa-share"></i> {{$expense->liability->reference}}</a></li>
                    @endif
                    @if($expense->is_transaction == 1)
                        <li><a href="#"><i class="fa fa-dollar"></i> {{$expense->transaction->reference}}</a></li>
                    @endif
                </ul>
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

<!-- Datatables -->
<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

{{--  Data tables  --}}
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
@endsection
