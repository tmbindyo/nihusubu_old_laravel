<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nihusubu | Expense Print</title>

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
                    106 Jorg Avenu, 600/10<br>
                    Chicago, VT 32456<br>
                    <abbr title="Phone">P:</abbr> {{$institution->phone_number}}
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Expense No.</h4>
                <h4 class="text-navy">{{$expense->reference}}</h4>
                <span>To:</span>
                @if($expense->customer->is_business == 1)
                {{--  if business  --}}
                <address>
                    <strong>{{$expense->customer->company_name}}</strong><br>
                    112 Street Avenu, 1080<br>
                    Miami, CT 445611<br>
                    <abbr title="Phone">P:</abbr> {{$expense->customer->phone_number}}
                </address>
                @else
                {{--  if not business  --}}
                <address>
                    <strong>{{$expense->customer->first_name}} {{$expense->customer->last_name}}</strong><br>
                    112 Street Avenu, 1080<br>
                    Miami, CT 445611<br>
                    <abbr title="Phone">P:</abbr> {{$expense->customer->phone_number}}
                </address>
                @endif
                <p>
                    <span><strong>Expense Date:</strong> {{$expense->date}} </span><br/>
                    <span><strong>Due Date:</strong> {{$expense->due_date}}</span>
                </p>
            </div>
        </div>

        <div class="table-responsive m-t">
            <table class="table expense-table">
                <thead>
                <tr>
                    <th>Item List</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expense->sale_products as $product)
                    <tr>
                        <td><div><strong>{{$product->product->name}}</strong></div>
                            <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->rate}}</td>
                        <td>{{$product->amount}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- /table-responsive -->

        <table class="table expense-total">
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
        <div class="well m-t"><strong>Notes</strong>
            {{$expense->customer_notes}}
        </div>

        <div class="well m-t"><strong>Terms and Conditions</strong>
            {{$expense->terms_and_conditions}}
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
