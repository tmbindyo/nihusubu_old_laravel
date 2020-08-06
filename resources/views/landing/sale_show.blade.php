<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('nihusubu.ico') }}" >

    <title>{{$institution->portal}} | Sale {{$sale->reference}}</title>

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

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
                            @if(isset($sale->contact))
                                <span>To:</span>
                                <address>
                                    <strong>{{$sale->contact->last_name}} {{$sale->contact->first_name}}</strong><br>
                                    <abbr title="Phone">P:</abbr> {{$sale->contact->phone_number}}<br>
                                    <abbr title="Email">E:</abbr> {{$sale->contact->email}}
                                </address>
                            @endif
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
                            @foreach($sale->saleProducts as $product)
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
                    <div class="text-right">
                        <a href="{{route('print.order',$sale->id)}}" target="_blank" class="btn btn-success btn-outline"><i class="fa fa-print"></i> Print Invoice </a>
{{--                        <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>--}}
                    </div>

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

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-3.1.1.min.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>

</body>

</html>
