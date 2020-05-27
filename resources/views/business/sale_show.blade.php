@extends('business.layouts.app')

@section('title', ' Sale')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Sale</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
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
                <a href="{{route('business.contact.show',['portal'=>$institution->portal,'id'=>$sale->contact_id])}}" class="btn btn-success btn-outline"><i class="fa fa-eye"></i> Contact </a>
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
                                <h5>From:</h5>
                                <address>
                                    <strong>{{$institution->name}}</strong><br>
                                    {{$institution->address->address_line_1}}<br>
                                    {{$institution->address->town}}, {{$institution->address->street}}<br>
                                    <abbr title="Phone">P:</abbr> {{$institution->phone_number}}<br>
                                    <abbr title="Email">E:</abbr> {{$institution->email}}
                                </address>
                            </div>

                            <div class="col-sm-6 text-right">
                                <h4>Sale No.</h4>
                                <h4 class="text-navy">{{$sale->reference}}</h4>
                                <span>To:</span>
                                <address>
                                    <strong>{{$sale->contact->last_name}} {{$sale->contact->first_name}}</strong><br>
                                    <abbr title="Phone">P:</abbr> {{$sale->contact->phone_number}}<br>
                                    <abbr title="Email">E:</abbr> {{$sale->contact->email}}
                                </address>
                                {{-- <address>
                                    <strong>Corporate, Inc.</strong><br>
                                    112 Street Avenu, 1080<br>
                                    Miami, CT 445611<br>
                                    <abbr title="Phone">P:</abbr> (120) 9000-4321
                                </address> --}}
                                <p>
                                    <span><strong>Invoice Date:</strong> {{$sale->date}} </span><br/>
                                    <span><strong>Due Date:</strong> {{$sale->due_date}} </span>
                                </p>
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
                                @foreach($sale->sale_products as $product)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>
                                                    {{$product->product->name}}
                                                </strong>
                                            </div>
{{--                                            <small>{!!$product->product->description!!}</small>--}}
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
                                <td>{{$sale->subtotal}}</td>
                            </tr>
                            <tr>
                                <td><strong>TAX :</strong></td>
                                <td>{{$sale->tax}}</td>
                            </tr>
                            <tr>
                                <td><strong>Discount :</strong></td>
                                <td>{{$sale->discount}}</td>
                            </tr>
                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td>{{$sale->total}}</td>
                            </tr>
                            </tbody>
                        </table>
                        {{-- <div class="text-right">
                            <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                        </div> --}}

                        <div class="well m-t"><strong>Notes</strong>
                            {{$sale->customer_notes}}
                        </div>

                        <div class="well m-t"><strong>Terms and Conditions</strong>
                            {{$sale->terms_and_conditions}}
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
