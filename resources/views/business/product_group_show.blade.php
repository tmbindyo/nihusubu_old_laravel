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
                <div class="col-lg-3">
                    <div class="contact-box center-version">

                        <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])}}">

                            <img alt="image" class="rounded-circle" src="img/a2.jpg">


                            <h3 class="m-b-xs"><strong>{{$product->name}}</strong></h3>

                            <div class="font-bold">{{$institution->currency->name}} {{$product->selling_price}}</div>
                            <address class="m-t-md">
                                {!! Str::limit($product->description, 100) !!}
                            </address>

                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a href="{{route('business.product.show',['portal'=>$institution->portal, 'id'=>$product->id])}}"  class="btn btn-xs btn-white"> View <i class="fa fa-long-arrow-right"></i> </a>
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

@endsection
