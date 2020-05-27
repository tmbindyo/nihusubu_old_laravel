<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nihusubu | Estimate Print</title>

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
                    <abbr title="Phone">P:</abbr> {{$institution->phone_number}}<br>
                    <abbr title="Email">E:</abbr> {{$institution->email}}
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Estimate No.</h4>
                <h4 class="text-navy">{{$estimate->reference}}</h4>
                @if($estimate->contact)
                    <span>To:</span>
                    <address>
                        <strong>{{$estimate->contact->last_name}} {{$estimate->contact->first_name}}</strong><br>
                        <abbr title="Phone">P:</abbr> {{$estimate->contact->phone_number}}<br>
                        <abbr title="Email">E:</abbr> {{$estimate->contact->email}}
                    </address>
                @endif
                <p>
                    <span><strong>Estimate Date:</strong> {{$estimate->date}} </span><br/>
                    <span><strong>Due Date:</strong> {{$estimate->due_date}}</span>
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
        <div class="well m-t"><strong>Notes</strong>
            {{$estimate->customer_notes}}
        </div>

        <div class="well m-t"><strong>Terms and Conditions</strong>
            {{$estimate->terms_and_conditions}}
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
