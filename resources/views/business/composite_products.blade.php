@extends('business.layouts.app')

@section('title', 'Composite products')

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
        <div class="col-lg-8">
            <h2>Composite products</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
                </li>
                <li class="active">
                    <strong>Composite products</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="{{route('business.composite.product.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Composite products / Services</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compositeProducts as $product)
                        <tr class="gradeA">
                            <td>{{$product->name}}</td>
                            <td>{{$product->composite_product_products_count}}</td>
                            <td class="center">
                                <p>@if ($product->is_service==1) Service: @elseif($product->is_service==0)Product: @endif <span class="label {{$product->status->label}}">{{$product->status->name}}</span></p>
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="{{ route('business.composite.product.show', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                    <a href="{{ route('business.composite.product.edit', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                    @if($product->status->name=="Discontinued")
                                        <a href="{{ route('business.composite.product.restore', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-danger btn-outline btn btn-xs">Restore</a>
                                    @else
                                        <a href="{{ route('business.composite.product.delete', ['portal'=>$institution->portal,'id'=>$product->id]) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                    @endif


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Products</th>
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
