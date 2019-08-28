@extends('business.layouts.app')

@section('title', ' Expense')

@section('css')
    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Expense</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.dashboard')}}">Home</a>
                </li>
                <li class="active">
                    <strong>Expense</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="#" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Item </a>
                <a href="#" class="btn btn-warning btn-outline"><i class="fa fa-pencil"></i> Edit </a>
                <a href="{{route('business.expense.print',1)}}" target="_blank" class="btn btn-success btn-outline"><i class="fa fa-print"></i> Print </a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-9">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>5</strong>) items</span>
                        <h5>Items in your cart</h5>
                    </div>
                    <div class="ibox-content">


                        <div class="table-responsive">
                            <table class="table shoping-cart-table">

                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="#" class="text-navy">
                                                Desktop publishing software
                                            </a>
                                        </h3>
                                        <p class="small">
                                            It is a long established fact that a reader will be distracted by the readable
                                            content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $180,00
                                        <s class="small text-muted">$230,00</s>
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $180,00
                                        </h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">

                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="#" class="text-navy">
                                                Text editor
                                            </a>
                                        </h3>
                                        <p class="small">
                                            There are many variations of passages of Lorem Ipsum available
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>List is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $50,00
                                        <s class="small text-muted">$63,00</s>
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="2">
                                    </td>
                                    <td>
                                        <h4>
                                            $100,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">

                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="#" class="text-navy">
                                                CRM software
                                            </a>
                                        </h3>
                                        <p class="small">
                                            Distracted by the readable
                                            content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $110,00
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $110,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">

                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="#" class="text-navy">
                                                PM software
                                            </a>
                                        </h3>
                                        <p class="small">
                                            Readable content of a page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $130,00
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $130,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">

                                <tbody>
                                <tr>
                                    <td width="90">
                                        <div class="cart-product-imitation">
                                        </div>
                                    </td>
                                    <td class="desc">
                                        <h3>
                                            <a href="#" class="text-navy">
                                                Photo editor
                                            </a>
                                        </h3>
                                        <p class="small">
                                            Page when looking at its layout. The point of using Lorem Ipsum is
                                        </p>
                                        <dl class="small m-b-none">
                                            <dt>Description lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                        </dl>

                                        <div class="m-t-sm">
                                            <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                            |
                                            <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                        </div>
                                    </td>

                                    <td>
                                        $700,00
                                    </td>
                                    <td width="65">
                                        <input type="text" class="form-control" placeholder="1">
                                    </td>
                                    <td>
                                        <h4>
                                            $70,00
                                        </h4>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ibox-content">

                        <button class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                        <button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button>

                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                            $390,00
                        </h2>

                        <hr/>
                        <span class="text-muted small">
                            *For United States, France and Germany applicable sales tax will be applied
                        </span>
                        <div class="m-t-sm">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Support</h5>
                    </div>
                    <div class="ibox-content text-center">



                        <h3><i class="fa fa-phone"></i> +43 100 783 001</h3>
                        <span class="small">
                            Please contact with us if you have any questions. We are avalible 24h.
                        </span>


                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">

                        <p class="font-bold">
                            Other products you may be interested
                        </p>

                        <hr/>
                        <div>
                            <a href="#" class="product-name"> Product 1</a>
                            <div class="small m-t-xs">
                                Many desktop publishing packages and web page editors now.
                            </div>
                            <div class="m-t text-righ">

                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                        <hr/>
                        <div>
                            <a href="#" class="product-name"> Product 2</a>
                            <div class="small m-t-xs">
                                Many desktop publishing packages and web page editors now.
                            </div>
                            <div class="m-t text-righ">

                                <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payments</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="gradeX">
                                    <td>Trident</td>
                                    <td>Internet
                                        Explorer 4.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                </tr>

                                <tr class="gradeC">
                                    <td>Trident</td>
                                    <td>Internet
                                        Explorer 5.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                                    <td class="center">C</td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
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
<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>
<!-- Page-Level Scripts -->
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

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }
</script>
@endsection
