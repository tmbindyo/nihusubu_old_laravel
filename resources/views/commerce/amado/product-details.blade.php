@extends('commerce.amado.layouts.app')

@section('title', 'Product Details')

@section('content')
        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                @if ($product->productSubCategory)
                                    <li class="breadcrumb-item"><a href="#">{{$product->productSubCategory->productCategory->name}}</a></li>
                                    <li class="breadcrumb-item"><a href="#">{{$product->productSubCategory->name}}</a></li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url({{ asset('e_commerce/amado') }}/img/product-img/pro-big-1.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url({{ asset('e_commerce/amado') }}/img/product-img/pro-big-2.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url({{ asset('e_commerce/amado') }}/img/product-img/pro-big-3.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url({{ asset('e_commerce/amado') }}/img/product-img/pro-big-4.jpg);">
                                    </li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-1.jpg">
                                            <img class="d-block w-100" src="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-1.jpg" alt="First slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-2.jpg">
                                            <img class="d-block w-100" src="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-2.jpg" alt="Second slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-3.jpg">
                                            <img class="d-block w-100" src="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-3.jpg" alt="Third slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-4.jpg">
                                            <img class="d-block w-100" src="{{ asset('e_commerce/amado') }}/img/product-img/pro-big-4.jpg" alt="Fourth slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                @if ($product->is_product_group == 1)
                                    <p>From {{$institution->currency->name}} {{$product->productGroupProductMin[0]->selling_price}}</p>
                                @else
                                    <p>{{$institution->currency->name}} {{$product->selling_price}}</p>
                                @endif
                                <a href="product-details.html">
                                    <h6>{{$product->name}}</h6>
                                </a>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="review">
                                        <a href="#">Write A Review</a>
                                    </div>
                                </div>
                                <!-- Avaiable -->
                                @if($product->is_inventory == true)
                                    <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                                    <p class="low_stock"><i class="fa fa-circle"></i> Running Low On Stock</p>
                                    <p class="in_avaibility"><i class="fa fa-circle"></i> Out Of Stock</p>
                                @endif
                            </div>

                            <div class="short_overview my-5">
                                <p>{!! $product->description !!}</p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix" method="post" action="{{ route('add.cart', ['portal'=>$institution->portal,'product_id'=>$product->id]) }}">
                                @csrf
                                <div class="cart-btn d-flex mb-15">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                @if($product->productGroupProducts->count() > 0)
                                    <div class="cart-btn d-flex mb-50">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <select name="product" class="w-100" id="country">
                                                    @foreach($product->productGroupProducts as $product)
                                                        <option data-fid="" value="{{$product->id}}">{{$product->name}} {{$institution->currency->name}} {{$product->selling_price}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->
@endsection
