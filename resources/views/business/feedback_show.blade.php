@extends('business.layouts.app')

@section('title', 'Feedback Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">


@endsection


@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Feedback's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    CRM
                </li>
                <li class="active">
                    <a href="{{route('business.feedbacks',$institution->portal)}}">Feedback's</a>
                </li>
                <li class="active">
                    <strong>Feedback Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
                <a href="{{route('business.feedback.uploads',['portal'=>$institution->portal,'id'=>$feedback->id])}}" class="btn btn-success btn-outline">Uploads</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Feedback Registration <small>Form</small></h5>

                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('business.feedback.update',['portal'=>$institution->portal,'id'=>$feedback->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <br>
                                    <div class="has-warning">
                                        <input type="text" id="name" name="name" required="required" value="{{$feedback->name}}" class="form-control input-lg">
                                        <i>name</i>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        <textarea rows="5" id="description" name="description" required="required" class="form-control input-lg">{{$feedback->description}}</textarea>
                                        <i>description</i>
                                    </div>

                                    <br>
                                    <hr>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>


                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  details  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label {{$feedback->status->label}}">{{$feedback->status->name}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>{{$feedback->user->name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{$feedback->updated_at}}</dd>
                                        <dt>Created:</dt> <dd> {{$feedback->created_at}} </dd>
                                    </dl>
                                </div>
                            </div>
                            {{--  <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#products" data-toggle="tab">Products</a></li>
                                            <li class=""><a href="#product-groups" data-toggle="tab">Product Groups</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="products">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>SKU</th>
                                                            <th>Stock on Hand</th>
                                                            <th>Reorder Level</th>
                                                            <th>Status</th>
                                                            <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($feedback->products as $product)
                                                            <tr class="gradeA">
                                                                <td>{{$product->name}}</td>
                                                                <td>{{$product->feedback->name}}</td>

                                                                @if($product->is_service == "1")
                                                                    <td>N/A</td>
                                                                @else
                                                                    <td>{{$product->stock_on_hand->first()->stock_on_hand}}</td>
                                                                @endif

                                                                <td class="center">{{$product->reorder_level}}</td>
                                                                <td class="center">
                                                                    <p>@if ($product->is_service==1) Service: @elseif($product->is_service==0)Product: @endif <span class="label {{$product->status->label}}">{{$product->status->name}}</span></p>
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('business.product.show', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                        <a href="{{ route('business.product.edit', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                                                        @if($product->status->name=="Discontinued")
                                                                            <a href="{{ route('business.product.restore', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-danger btn-outline btn btn-xs">Restore</a>
                                                                        @else
                                                                            <a href="{{ route('business.product.delete', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                                                        @endif


                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>SKU</th>
                                                            <th>Stock on Hand</th>
                                                            <th>Reorder Level</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="product-groups">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Attributes</th>
                                                            <th>Attribute Options</th>
                                                            <th>Status</th>
                                                            <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($feedback->product_groups as $productGroup)
                                                            <tr class="gradeA">
                                                                    <td>{{$productGroup->name}} <label class="badge badge-circle badge-info">{{$productGroup->products_count}} products</label></td>
                                                                    <td>{{$productGroup->attributes}}</td>
                                                                    <td>{{$productGroup->attribute_options}}</td>
                                                                    <td>
                                                                        <p>@if ($productGroup->is_service==1) Service: @elseif($productGroup->is_service==0)Product: @endif <span class="label {{$productGroup->status->label}}">{{$productGroup->status->name}}</span></p>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('business.product.group.show', ['portal'=>$institution->portal,'id'=>$productGroup->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                            <a href="{{ route('business.product.group.edit', ['portal'=>$institution->portal,'id'=>$productGroup->id]) }}" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                                                            <a href="{{ route('business.product.group.delete', ['portal'=>$institution->portal,'id'=>$productGroup->id]) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                                                        </div>
                                                                    </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>SKU</th>
                                                            <th>Stock on Hand</th>
                                                            <th>Status</th>
                                                            <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                </div>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>


    {{--  Data tables  --}}
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

    </script>

@endsection
