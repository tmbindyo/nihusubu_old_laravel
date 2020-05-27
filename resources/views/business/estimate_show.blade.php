@extends('business.layouts.app')

@section('title', ' Estimate')

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h2>Estimate</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales',$institution->portal)}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.estimates',$institution->portal)}}">Estimates</a>
                    </li>
                    <li class="active">
                        <strong>Estimate</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-6">
                <div class="title-action">
                    @if($estimate->is_invoice == 0)
                        <a href="{{route('business.estimate.edit',['portal'=>$institution->portal,'id'=>$estimate->id])}}" class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit </a>
                        <a href="{{route('business.estimate.convert.to.invoice',['portal'=>$institution->portal,'id'=>$estimate->id])}}" class="btn btn-warning btn-outline"><i class="fa fa-shopping-cart"></i> Convert to Invoice </a>
                    @else
                        <a href="{{route('business.invoice.show',['portal'=>$institution->portal,'id'=>$estimate->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-shopping-cart"></i> View Invoice </a>

                    @endif
                    <a href="{{route('business.estimate.print',['portal'=>$institution->portal,'id'=>$estimate->id])}}" target="_blank" class="btn btn-success btn-outline"><i class="fa fa-print"></i> Print </a>
                    <a href="{{route('business.contact.show',['portal'=>$institution->portal,'id'=>$estimate->contact_id])}}" class="btn btn-success btn-outline"><i class="fa fa-eye"></i> Contact </a>
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
                                        <h4 class="text-navy">{{$estimate->reference}}</h4>
                                        <span>To:</span>
                                        <address>
                                            <strong>{{$estimate->contact->last_name}} {{$estimate->contact->first_name}}</strong><br>
                                            <abbr title="Phone">P:</abbr> {{$estimate->contact->phone_number}}<br>
                                            <abbr title="Email">E:</abbr> {{$estimate->contact->email}}
                                        </address>
                                        {{-- <address>
                                            <strong>Corporate, Inc.</strong><br>
                                            112 Street Avenu, 1080<br>
                                            Miami, CT 445611<br>
                                            <abbr title="Phone">P:</abbr> (120) 9000-4321
                                        </address> --}}
                                        <p>
                                            <span><strong>Invoice Date:</strong> {{$estimate->date}} </span><br/>
                                            <span><strong>Due Date:</strong> {{$estimate->due_date}} </span>
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
                                        @foreach($estimate->sale_products as $product)
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
                                        <td>{{$estimate->subtotal}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>TAX :</strong></td>
                                        <td>{{$estimate->tax}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Discount :</strong></td>
                                        <td>{{$estimate->discount}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>TOTAL :</strong></td>
                                        <td>{{$estimate->total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{-- <div class="text-right">
                                    <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                                </div> --}}

                                <div class="well m-t"><strong>Notes</strong>
                                    {{$estimate->customer_notes}}
                                </div>

                                <div class="well m-t"><strong>Terms and Conditions</strong>
                                    {{$estimate->terms_and_conditions}}
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
