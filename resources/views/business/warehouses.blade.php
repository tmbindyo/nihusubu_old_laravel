@extends('business.layouts.app')

@section('title', 'Warehouses')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('inspinia') }}/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Warehouses</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Inventory
                </li>
                <li class="active">
                    <strong>Warehouses</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="#" data-toggle="modal" data-target="#warehouseRegistration" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i> New </a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">


        <div class="row">
            @foreach($warehouses as $warehouse)
                <div class="col-lg-3">
                    <div class="contact-box center-version">

                        <a href="profile.html">

                            <span class="fa fa-4x fa-database"></span>


                            <h3 class="m-b-xs"><strong>{{$warehouse->name}}</strong></h3>
                            <address class="m-t-md">
                                {{$warehouse->address->town}}, {{$warehouse->address->street}}<br>
                                P. O. Box {{$warehouse->address->po_box}}, {{$warehouse->address->postal_code}}.<br>
                                <abbr title="Phone">P:</abbr> {{$warehouse->address->phone_number}}<br>
                                <abbr title="Email">E:</abbr> {{$warehouse->address->email}}
                            </address>

                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a href="{{route('business.warehouse.show',['portal'=>$institution->portal,'id'=>$warehouse->id])}}" class="btn btn-xs btn-outline btn-primary"> View </a>
                                <a href="" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-cross"></i> Delete</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection

@include('business.layouts.modals.warehouse_create')

@section('js')
    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- FooTable -->
    <script src="{{ asset('inspinia') }}/js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();

        });

    </script>

@endsection
