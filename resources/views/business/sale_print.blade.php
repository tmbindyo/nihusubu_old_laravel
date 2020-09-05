<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nihusubu | Sale Print</title>

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
<div class="wrapper wrapper-content p-xl">
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <h5>From:</h5>
                <address>
                    <strong>{{$institution->name}}</strong><br>
                    {{$institution->address->address_line_1}}<br>
                    {{$institution->address->town}}, {{$institution->address->street}}<br>
                    {{-- @if ($institution->address->po_box) P. O. Box {{$institution->address->po_box}}, {{$institution->address->postal_code}} @endif <br> --}}
                    <abbr title="Phone">P:</abbr> {{$institution->phone_number}}
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Sale No.</h4>
                <h4 class="text-navy">{{$sale->reference}}</h4>
                @if($sale->contact)
                    <span>To:</span>
                    <address>
                        <strong>{{$sale->contact->last_name}} {{$sale->contact->first_name}}</strong><br>
                        <abbr title="Phone">tell:</abbr> {{$sale->contact->phone_number}}<br>
                        <abbr title="Email">email:</abbr> {{$sale->contact->email}}
                    </address>
                @endif
                <p>
                    <span><strong>Sale Date:</strong> {{$sale->date}} </span><br/>
                    <span><strong>Due Date:</strong> {{$sale->due_date}}</span>
                </p>

                @if($sale->payment_schedule_id)
                    <h5 class="text-navy">{{$sale->paymentSchedule->name}} [{{$sale->paymentSchedule->period}}]</h5>
                @endif
            </div>
        </div>

        <div class="table-responsive m-t">
            <table class="table sale-table">
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
                                    {!! $product->product->name !!}
                                </strong>
                            </div>
                        <small>
{{--                            {!! $product->product->description !!}--}}
                        </small>
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
                <td><strong>Adjustment :</strong></td>
                <td>{{$sale->discount}}</td>
            </tr>
            <tr>
                <td><strong>TOTAL :</strong></td>
                <td>{{$sale->total+$sale->tax}}</td>
            </tr>
            </tbody>
        </table>
        <div class="well m-t"><strong>Notes</strong>
            {{$sale->customer_notes}}
        </div>

        <div class="well m-t"><strong>Terms and Conditions</strong>
            {{$sale->terms_and_conditions}}
        </div>
    </div>

</div>

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>

<script type="text/javascript">
    window.print();
</script>

</body>

</html>
