@extends('commerce.amado.layouts.app')

@section('title', 'Cart')

@section('content')
    <!-- ##### Main Content Wrapper Start ##### -->
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                        <tr>
                                            <td class="cart_product_img">
                                                <a href="#"><img src="{{ asset('e_commerce/amado') }}/img/bg-img/cart1.jpg" alt="Product"></a>
                                            </td>
                                            <td class="cart_product_desc">
                                                <h5>{{$item->attributes->name}}</h5>
                                            </td>
                                            <td class="price">
                                                <span>{{$institution->currency->name}} {{number_format($item->price, 2)}}</span>
                                            </td>
                                            <td class="qty">
                                                <div class="qty-btn d-flex">
                                                    <p>Qty</p>
                                                    <div class="quantity">
                                                        <span class="qty-minus subtractCartItemQuantity" data-fid="{{$item->id}}" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                        <input type="number" disabled class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="{{$item->quantity}}">
                                                        <span class="qty-plus AddCartItemQuantity" data-fid="{{$item->id}}" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span id="subtotal"> {{$institution->currency->name}} {{$total}}</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span id="total">{{$institution->currency->name}} {{$total}}</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="{{route('commerce.checkout',$institution->portal)}}" class="btn amado-btn w-100">Checkout</a>
                                <br>
                                <a href="{{route('clear.cart',$institution->portal)}}" class="btn amado-btn w-100">Clear Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection

@section('js')

    <script>
        $('.AddCartItemQuantity').on('click',function(){
            var id = $(this).data('fid')

            //send value by ajax to server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", '{{url('add/cart/item/quantity')}}'+'/'+id, true);
            xhr.setRequestHeader('Content-Type', '');
            xhr.responseType = 'json';
            xhr.send();
            xhr.onload = function() {

                // parse json response to array
                var jsonResponse = xhr.response;

                // Get value of price updated item
                var price = jsonResponse.price;
                var quantity = jsonResponse.quantity;

                // Get new subtotal
                var newsubtotal = Number(quantity) * Number(price);

                // set new price to subtotal span
                document.getElementById("subtotal").textContent='{{$institution->currency->name}} '+ newsubtotal;
                document.getElementById("total").textContent='{{$institution->currency->name}} '+ newsubtotal;
                alert("Item quantity increased.");
            }
        });

    </script>

    <script>
        $('.subtractCartItemQuantity').on('click',function(){
            var id = $(this).data('fid')

            //send value by ajax to server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", '{{url('subtract/cart/item/quantity')}}'+'/'+id, true);
            xhr.setRequestHeader('Content-Type', '');
            xhr.responseType = 'json';
            xhr.send();
            xhr.onload = function() {

                // parse json response to array
                var jsonResponse = xhr.response;

                // Get value of price updated item
                var price = jsonResponse.price;
                var quantity = jsonResponse.quantity;

                // Get new subtotal
                var newsubtotal = Number(quantity) * Number(price);

                // set new price to subtotal span
                document.getElementById("subtotal").textContent='{{$institution->currency->name}} '+ newsubtotal;
                document.getElementById("total").textContent='{{$institution->currency->name}} '+ newsubtotal;
                alert("Item quantity reduced.");
            }
        });

    </script>

@endsection
