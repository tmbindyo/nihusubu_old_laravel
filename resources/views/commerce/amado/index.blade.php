@extends('commerce.amado.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Product Catagories Area Start -->
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">

            @foreach($products as $product)
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="{{route('commerce.product.detail',['portal'=>$institution->portal,'product_id'=>$product->id])}}">
                        @if($product->productImages->count() > 0)
                            <img src="{{asset('storage')}}/{{$product->productImages[1]->upload->small_thumbnail}}" alt="">
                        @else
                            <img src="{{ asset('e_commerce/amado') }}/img/bg-img/2.jpg" alt="">

                        @endif
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            @if ($product->is_product_group == 1)
                                <p>From {{$institution->currency->name}} {{$product->productGroupProductMin[0]->taxed_selling_price}}</p>
                            @else
                                <p>{{$institution->currency->name}} {{$product->taxed_selling_price}}</p>
                            @endif
                            <h4>{{$product->name}}</h4>
                        </div>
                    </a>
                </div>
                @endforeach
        </div>
    </div>
    <!-- Product Catagories Area End -->
@endsection
