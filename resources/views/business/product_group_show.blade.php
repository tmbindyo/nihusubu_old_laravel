@extends('business.layouts.app')

@section('title', ' Product Group')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Product Group</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.products',$institution->portal)}}">Products</a>
            </li>
            <li>
                <a href="{{route('business.product.groups',$institution->portal)}}">Product Groups</a>
            </li>
            <li class="active">
                <strong>Product Group Products</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            {{-- <a href="#" data-toggle="modal" data-target="#productRegistration" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add </a> --}}
            <a href="{{route('business.product.group.edit',['portal'=>$institution->portal, 'id'=>$productGroup->id])}}"class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit </a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        {{--  foreach  --}}
        @foreach($productGroup->products as $product)
            <div class="col-md-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="text-center">{{$product->name}}</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            {{--                            <img alt="image" class="img-fluid" src="img/profile_big.jpg">--}}
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>{{$institution->currency->name}} {{$product->selling_price}}</strong></h4>
                            @isset($product->unit_id)
                                <p><i class="fa fa-map-marker"></i> {{$product->unit->name}}</p>
                            @endisset
                            <h5>
                                About
                            </h5>
                            <p>
                                {!! \Illuminate\Support\Str::limit($product->name, 205, $end='...') !!}
                            </p>
{{--                            todo graph of product details--}}
{{--                            <div class="row m-t-lg">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <span class="bar">5,3,9,6,5,9,7,3,5,2</span>--}}
{{--                                    <h5><strong>169</strong> Sales</h5>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <span class="line">5,3,9,6,5,9,7,3,5,2</span>--}}
{{--                                    <h5><strong>28</strong> Views</h5>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>--}}
{{--                                    <h5><strong>240</strong> Followers</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <br>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>--}}
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])}}" type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-arrow-right"></i> View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--  endforeach  --}}

        {{--  foreach  --}}
{{--        @foreach($productGroup->products as $product)--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="ibox">--}}
{{--                    <div class="ibox-content product-box">--}}

{{--                        <div class="product-imitation">--}}
{{--                            [ INFO ]--}}
{{--                        </div>--}}
{{--                        <div class="product-desc">--}}
{{--                            <span class="product-price">--}}
{{--                                {{$product->selling_price}}--}}
{{--                            </span>--}}
{{--                            <small class="text-muted">Category</small>--}}
{{--                            <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])}}" class="product-name"> {{$product->name}}</a>--}}



{{--                            <div class="small m-t-xs">--}}
{{--                                {!! Str::limit($product->description, 100) !!}--}}
{{--                            </div>--}}

{{--                            <div class="m-t text-righ">--}}

{{--                                <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])}}" class="btn btn-xs btn-outline btn-primary">View <i class="fa fa-long-arrow-right"></i> </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
        {{--  endforeach  --}}

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

<!-- Peity -->
<script src="{{ asset('inspinia') }}/js/plugins/peity/jquery.peity.min.js"></script>

<!-- Peity -->
<script src="{{ asset('inspinia') }}/js/demo/peity-demo.js"></script>

@endsection
