@extends('business.layouts.app')

@section('title', ' Sale')

@section('css')
    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Sale</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.sales',$institution->portal)}}">Sales</a>
                </li>
                <li class="active">
                    <strong>Sale</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-6">
            <div class="title-action">
                {{--  todo return --}}
                <a href="{{route('business.sale.payment.create',['portal'=>$institution->portal,'id'=>$sale->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Payment </a>
                <a href="{{route('business.sale.print',['portal'=>$institution->portal,'id'=>$sale->id])}}" target="_blank" class="btn btn-success btn-outline"><i class="fa fa-print"></i> Print Invoice </a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-9">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>{{$sale->sale_products_count}}</strong>) items</span>
                        <h5>Items</h5>
                    </div>
                    @foreach($sale->sale_products as $product)
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
                                                <a href="{{route('business.product.show',['portal'=>$institution->portal,'id'=>$product->product->id])}}" class="text-navy">
                                                    {{$product->product->name}}
                                                </a>
                                            </h3>

                                            {!! $product->product->description !!}

                                            <div class="m-t-sm">
                                                <a href="{{route('business.sale.product.delete',['portal'=>$institution->portal,'id'=>$product->id])}}" class="text-warning"><i class="fa fa-trash"></i> Remove item</a>
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
                            {{$sale->total}}
                        </h2>

                        <hr/>
                        <span>
                                Tax
                            </span>
                        <h2 class="font-bold">
                            {{$sale->tax}}
                        </h2>

                        <hr/>
                        <span>
                                Discount
                            </span>
                        <h2 class="font-bold">
                            {{$sale->discount}}
                        </h2>

                        <hr/>
                        @if($sale->customer)
                            <span class="text-muted small">

                                @if($sale->customer->is_business == 1)
                                    {{--  if business  --}}
                                    <address>
                                            <strong>{{$sale->customer->company_name}}</strong><br>
                                            112 Street Avenu, 1080<br>
                                            Miami, CT 445611<br>
                                            <abbr title="Phone">P:</abbr> {{$sale->customer->phone_number}}<br>
                                            <abbr title="Email">E:</abbr> {{$sale->customer->email}}
                                        </address>
                                @else
                                    {{--  if not business  --}}
                                    <address>
                                            <strong>{{$sale->customer->first_name}} {{$sale->customer->last_name}}</strong><br>
                                            112 Street Avenu, 1080<br>
                                            Miami, CT 445611<br>
                                            <abbr title="Phone">P:</abbr> {{$sale->customer->phone_number}}<br>
                                            <abbr title="Email">E:</abbr> {{$sale->customer->email}}
                                        </address>
                                @endif
                            </span>
                        @endif
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
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payments</h5>
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
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Initial</th>
                                        <th>Subsequent</th>
                                        <th>Date</th>
                                        <th>Account</th>
                                        <th>For</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr class="gradeX">
                                            <td>
                                                {{$payment->reference}}
                                                <span><i data-toggle="tooltip" data-placement="right" title="{{$payment->notes}}." class="fa fa-facebook-messenger"></i></span>
                                            </td>
                                            <td>{{$payment->amount}}</td>
                                            <td>{{$payment->initial_balance}}</td>
                                            <td>{{$payment->current_balance}}</td>
                                            <td>{{$payment->date}}</td>
                                            <td>{{$payment->account->name}}</td>
                                            <td>
                                                @if($payment->is_order == 1)
                                                    <span class="label label-success">Order: {{$payment->order->reference}}</span>
                                                @elseif($payment->is_quote == 1)
                                                    <span class="label label-success">Quote: {{$payment->quote->reference}}</span>
                                                @elseif($payment->is_asset_action == 1)
                                                    <span class="label label-success">Asset Action: {{$payment->asset_action->reference}}</span>
                                                @elseif($payment->is_loan == 1)
                                                    <span class="label label-success">Loan: {{$payment->loan->reference}}</span>
                                                @endif
                                            </td>
                                            <td>{{$payment->user->name}}</td>
                                            <td>
                                                <span class="label {{$payment->status->label}}">{{$payment->status->name}}</span>
                                            </td>

                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="{{ route('business.payment.show', ['portal'=>$institution->portal,'id'=>$payment->id]) }}" class="btn-default btn btn-xs">Show</a>
                                                    @if($payment->status_id == "b810f2f1-91c2-4fc9-b8e1-acc068caa03a")
                                                        <a href="{{ route('business.payment.restore', ['portal'=>$institution->portal,'id'=>$payment->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                    @else
                                                        <a href="{{ route('business.payment.delete', ['portal'=>$institution->portal,'id'=>$payment->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Initial</th>
                                        <th>Subsequent</th>
                                        <th>Date</th>
                                        <th>Account</th>
                                        <th>For</th>
                                        <th>User</th>
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
<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>
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

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }
</script>
@endsection
