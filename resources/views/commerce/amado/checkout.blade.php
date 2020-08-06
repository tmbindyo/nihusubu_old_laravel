@extends('commerce.amado.layouts.app')

@section('title', 'Checkout')

@section('css')
{{--    <style>--}}
{{--        /* Always set the map height explicitly to define the size of the div--}}
{{--        * element that contains the map. */--}}
{{--        #map {--}}
{{--        height: 100%;--}}
{{--        }--}}

{{--        /* Optional: Makes the sample page fill the window. */--}}
{{--        html,--}}
{{--        body {--}}
{{--        height: 100%;--}}
{{--        margin: 0;--}}
{{--        padding: 0;--}}
{{--        }--}}

{{--        #description {--}}
{{--        font-family: Roboto;--}}
{{--        font-size: 15px;--}}
{{--        font-weight: 300;--}}
{{--        }--}}

{{--        #infowindow-content .title {--}}
{{--        font-weight: bold;--}}
{{--        }--}}

{{--        #infowindow-content {--}}
{{--        display: none;--}}
{{--        }--}}

{{--        #map #infowindow-content {--}}
{{--        display: inline;--}}
{{--        }--}}

{{--        .pac-card {--}}
{{--        margin: 10px 10px 0 0;--}}
{{--        border-radius: 2px 0 0 2px;--}}
{{--        box-sizing: border-box;--}}
{{--        -moz-box-sizing: border-box;--}}
{{--        outline: none;--}}
{{--        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);--}}
{{--        background-color: #fff;--}}
{{--        font-family: Roboto;--}}
{{--        }--}}

{{--        #pac-container {--}}
{{--        padding-bottom: 12px;--}}
{{--        margin-right: 12px;--}}
{{--        }--}}

{{--        .pac-controls {--}}
{{--        display: inline-block;--}}
{{--        padding: 5px 11px;--}}
{{--        }--}}

{{--        .pac-controls label {--}}
{{--        font-family: Roboto;--}}
{{--        font-size: 13px;--}}
{{--        font-weight: 300;--}}
{{--        }--}}

{{--        #pac-input {--}}
{{--        background-color: #fff;--}}
{{--        font-family: Roboto;--}}
{{--        font-size: 15px;--}}
{{--        font-weight: 300;--}}
{{--        margin-left: 12px;--}}
{{--        padding: 0 11px 0 13px;--}}
{{--        text-overflow: ellipsis;--}}
{{--        width: 400px;--}}
{{--        }--}}

{{--        #pac-input:focus {--}}
{{--        border-color: #4d90fe;--}}
{{--        }--}}

{{--        #title {--}}
{{--        color: #fff;--}}
{{--        background-color: #4d90fe;--}}
{{--        font-size: 25px;--}}
{{--        font-weight: 500;--}}
{{--        padding: 6px 12px;--}}
{{--        }--}}

{{--        #target {--}}
{{--        width: 345px;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>--}}
{{--    <script--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8FFXhb8U-H-NRDEyefX6uNjgqsjXXmCs&callback=initAutocomplete&libraries=places&v=weekly"--}}
{{--        defer--}}
{{--    ></script>--}}
@endsection
@section('content')
    <!-- ##### Main Content Wrapper Start ##### -->
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>

                            <form id="my-form" action="{{route('commerce.user.checkout', $institution->portal)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <select class="w-100" id="country" name="country">
                                        <option value="usa">United States</option>
                                        <option value="uk">United Kingdom</option>
                                        <option value="ger">Germany</option>
                                        <option value="fra">France</option>
                                        <option value="ind">India</option>
                                        <option value="aus">Australia</option>
                                        <option value="bra">Brazil</option>
                                        <option value="cana">Canada</option>
                                    </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="town" name="town" placeholder="Town" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" id="street" name="street" placeholder="Street" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" class="form-control" id="po_box" name="po_box" min="0" placeholder="PO Box" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="Address Line 1" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="number" class="form-control" id="address_line_2" name="address_line_2" min="0" placeholder="Address Line 2" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" name="comment" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox d-block mb-2">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                        </div>
                                        <div class="custom-control custom-checkbox d-block">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span id="subtotal"> {{$institution->currency->name}} {{$total}}</span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>{{$institution->currency->name}} {{$total}}</span></li>
                            </ul>

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="{{ asset('e_commerce/amado') }}/img/core-img/paypal.png" alt=""></label>
                                </div>
                            </div>

                            <div class="cart-btn mt-100">
                                <button type="submit" form="my-form" class="btn amado-btn w-100">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection

@section('js')
{{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8FFXhb8U-H-NRDEyefX6uNjgqsjXXmCs&libraries=places"></script>--}}
{{--    <script>--}}
{{--        // This example adds a search box to a map, using the Google Place Autocomplete--}}
{{--        // feature. People can enter geographical searches. The search box will return a--}}
{{--        // pick list containing a mix of places and predicted search terms.--}}
{{--        // This example requires the Places library. Include the libraries=places--}}
{{--        // parameter when you first load the API. For example:--}}
{{--        // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8FFXhb8U-H-NRDEyefX6uNjgqsjXXmCs&libraries=places">--}}
{{--        function initAutocomplete() {--}}
{{--            const map = new google.maps.Map(document.getElementById("map"), {--}}
{{--                center: { lat: -33.8688, lng: 151.2195 },--}}
{{--                zoom: 13,--}}
{{--                mapTypeId: "roadmap"--}}
{{--            });--}}
{{--            // Create the search box and link it to the UI element.--}}
{{--            const input = document.getElementById("pac-input");--}}
{{--            const searchBox = new google.maps.places.SearchBox(input);--}}
{{--            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);--}}
{{--            // Bias the SearchBox results towards current map's viewport.--}}
{{--            map.addListener("bounds_changed", () => {--}}
{{--                searchBox.setBounds(map.getBounds());--}}
{{--            });--}}
{{--            let markers = [];--}}
{{--            // Listen for the event fired when the user selects a prediction and retrieve--}}
{{--            // more details for that place.--}}
{{--            searchBox.addListener("places_changed", () => {--}}
{{--                const places = searchBox.getPlaces();--}}

{{--                if (places.length == 0) {--}}
{{--                    return;--}}
{{--                }--}}
{{--                // Clear out the old markers.--}}
{{--                markers.forEach(marker => {--}}
{{--                    marker.setMap(null);--}}
{{--                });--}}
{{--                markers = [];--}}
{{--                // For each place, get the icon, name and location.--}}
{{--                const bounds = new google.maps.LatLngBounds();--}}
{{--                places.forEach(place => {--}}
{{--                    if (!place.geometry) {--}}
{{--                        console.log("Returned place contains no geometry");--}}
{{--                        return;--}}
{{--                    }--}}
{{--                    const icon = {--}}
{{--                        url: place.icon,--}}
{{--                        size: new google.maps.Size(71, 71),--}}
{{--                        origin: new google.maps.Point(0, 0),--}}
{{--                        anchor: new google.maps.Point(17, 34),--}}
{{--                        scaledSize: new google.maps.Size(25, 25)--}}
{{--                    };--}}
{{--                    // Create a marker for each place.--}}
{{--                    markers.push(--}}
{{--                        new google.maps.Marker({--}}
{{--                            map,--}}
{{--                            icon,--}}
{{--                            title: place.name,--}}
{{--                            position: place.geometry.location--}}
{{--                        })--}}
{{--                    );--}}

{{--                    if (place.geometry.viewport) {--}}
{{--                        // Only geocodes have viewport.--}}
{{--                        bounds.union(place.geometry.viewport);--}}
{{--                    } else {--}}
{{--                        bounds.extend(place.geometry.location);--}}
{{--                    }--}}
{{--                });--}}
{{--                map.fitBounds(bounds);--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}


@endsection
