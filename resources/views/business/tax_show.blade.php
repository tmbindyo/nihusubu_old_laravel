@extends('business.layouts.app')

@section('title', 'Tax Show')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Tax's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    CRM
                </li>
                <li class="active">
                    <a href="{{route('business.taxes',$institution->portal)}}">Tax's</a>
                </li>
                <li class="active">
                    <strong>Tax Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Tax Registration <small>Form</small></h5>

                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('business.tax.update',['portal'=>$institution->portal, 'id'=>$tax->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                    @if ($errors->has('is_percentage'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('is_percentage') }}</strong>
                                        </span>
                                    @endif
                                    <div class="checkbox">
                                        <input id="is_percentage" name="is_percentage" @if($tax->is_percentage == 1) checked @endif type="checkbox">
                                        <label for="is_percentage">
                                            percentage
                                        </label>
                                        <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the tax charged is a percentage of the price." class="fa fa-2x fa-question-circle"></i></span>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                        <input type="text" id="name" name="name" required="required" value="{{$tax->name}}" class="form-control input-lg">
                                        <i>name</i>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                        @endif
                                        <input type="number" id="amount" name="amount" required="required" value="{{$tax->amount}}" class="form-control input-lg">
                                        <i>amount</i>
                                    </div>
                                    @can('edit tax')
                                        <hr>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    @endcan
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
                                        <dt>Status:</dt> <dd><span class="label {{$tax->status->label}}">{{$tax->status->name}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>{{$tax->user->name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{$tax->updated_at}}</dd>
                                        <dt>Created:</dt> <dd> {{$tax->created_at}} </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel blank-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#products" data-toggle="tab">Products</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="products">
                                                    @can('view products')
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>SKU</th>
                                                                        <th>Stock on Hand</th>
                                                                        <th>Reorder Level</th>
                                                                        <th>Status</th>
                                                                        <th class="text-right" width="10em" data-sort-ignore="true">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($tax->productTaxes as $product_tax)
                                                                        <tr class="gradeA">
                                                                            <td>{{$product_tax->product->name}}</td>
                                                                            <td>
                                                                                @isset($product_tax->product->unit->name)
                                                                                    {{$product_tax->product->unit->name}}
                                                                                @endisset
                                                                            </td>
                                                                            <td>
                                                                                @if($product_tax->product->is_service == "1")
                                                                                    N/A
                                                                                @else
                                                                                    @isset($product_tax->product->stock_on_hand->first()->stock_on_hand)
                                                                                        {{$product_tax->product->stock_on_hand->first()->stock_on_hand}}
                                                                                    @endisset
                                                                                @endif
                                                                            </td>
                                                                            <td class="center">
    {{--                                                                            @if($product_tax->product->is_composite_product == "0")--}}
    {{--                                                                                {{$product_tax->product->reorder_level}}--}}
    {{--                                                                            @else--}}
    {{--                                                                                N/A--}}
    {{--                                                                            @endif--}}
                                                                                @if ($product_tax->product->is_service==1)
                                                                                    N/A
                                                                                @elseif ($product_tax->product->is_service==0)
                                                                                        @if($product_tax->product->is_composite_product == "0")
                                                                                            {{$product_tax->product->reorder_level}}
                                                                                        @else
                                                                                            N/A
                                                                                        @endif

                                                                                @endif
                                                                            </td>
                                                                            <td class="center">
                                                                                <p>
                                                                                    @if ($product_tax->product->is_service==1)
                                                                                        Service:
                                                                                    @elseif($product_tax->product->is_service==0)
                                                                                        Product:
                                                                                    @endif
                                                                                        <span class="label {{$product_tax->product->status->label}}">{{$product_tax->product->status->name}}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <div class="btn-group">
                                                                                    <a href="{{ route('business.product.show', ['portal'=>$institution->portal, 'id'=>$product_tax->product->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
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
                                                                        <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
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
                    {extend: 'excel',
                        title: '{{$tax->name}} Products',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }

                    },
                    {extend: 'pdf',
                        title: '{{$tax->name}} Products',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }

                    },

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
