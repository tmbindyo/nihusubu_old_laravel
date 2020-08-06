@extends('business.layouts.app')

@section('title', ' Invoice')

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Invoice</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales',$institution->portal)}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.invoices',$institution->portal)}}">Invoices</a>
                    </li>
                    <li class="active">
                        <strong>Invoice</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    @if($invoice->is_sale == 0)
                        @can('edit invoice')
                            <a href="{{route('business.invoice.edit',['portal'=>$institution->portal, 'id'=>$invoice->id])}}" class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit </a>
                        @endcan
                        @can('convert to sale')
                            <a href="{{route('business.invoice.convert.to.sale',['portal'=>$institution->portal, 'id'=>$invoice->id])}}" class="btn btn-warning btn-outline"><i class="fa fa-shopping-cart"></i> Convert to Sale </a>
                        @endcan
                    @else
                        @can('view sale')
                            <a href="{{route('business.sale.show',['portal'=>$institution->portal, 'id'=>$invoice->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-shopping-cart"></i> View Sale </a>
                        @endcan
                    @endif
                    @can('send invoice')
                        <a href="{{route('business.invoice.compose',['portal'=>$institution->portal, 'id'=>$invoice->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-send-o"></i> Send </a>
                    @endcan
                    @can('print invoice')
                        <a href="{{route('business.invoice.print',['portal'=>$institution->portal, 'id'=>$invoice->id])}}" target="_blank" class="btn btn-success btn-outline"><i class="fa fa-print"></i> Print </a>
                    @endcan
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
                                    <h4>Invoice No.</h4>
                                    <h4 class="text-navy">{{$invoice->reference}}</h4>
                                    @if(isset($invoice->contact))
                                        <span>To:</span>
                                        <address>
                                            <strong>{{$invoice->contact->last_name}} {{$invoice->contact->first_name}}</strong><br>
                                            <abbr title="Phone">P:</abbr> {{$invoice->contact->phone_number}}<br>
                                            <abbr title="Email">E:</abbr> {{$invoice->contact->email}}
                                        </address>
                                    @endif
                                    {{-- <address>
                                        <strong>Corporate, Inc.</strong><br>
                                        112 Street Avenu, 1080<br>
                                        Miami, CT 445611<br>
                                        <abbr title="Phone">P:</abbr> (120) 9000-4321
                                    </address> --}}
                                    <p>
                                        <span><strong>Invoice Date:</strong> {{$invoice->date}} </span><br/>
                                        <span><strong>Due Date:</strong> {{$invoice->due_date}} </span>
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
                                    @foreach($invoice->saleProducts as $product)
                                        <tr>
                                            <td>
                                                <div><strong>{{$product->product->name}}</strong></div>
                                                <small>{!!$product->product->description!!}</small>
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
                                    <td>{{$invoice->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td><strong>TAX :</strong></td>
                                    <td>{{$invoice->tax}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Discount :</strong></td>
                                    <td>{{$invoice->discount}}</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>{{$invoice->total}}</td>
                                </tr>
                                </tbody>
                            </table>
                            {{-- <div class="text-right">
                                <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                            </div> --}}

                            <div class="well m-t"><strong>Notes</strong>
                                {{$invoice->customer_notes}}
                            </div>

                            <div class="well m-t"><strong>Terms and Conditions</strong>
                                {{$invoice->terms_and_conditions}}
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

@endsection
