@extends('admin.layouts.app')

@section('title', 'Album Type')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection



@section('content')


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Category <small>edit</small></h5>
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
                            <div class="row">
                                <div class="col-sm-8 b-r">
                                    <p>Edit category.</p>
                                    <form method="post" action="{{ route('admin.category.update',$category->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="name" name="name" value="{{$category->name}}" class="form-control">
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Update</strong></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4"><h4>Not a member?</h4>
                                    <p>You can create an account:</p>
                                    <p class="text-center">
                                        <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Category Albums</h5>
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
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryAlbums as $categoryAlbum)
                        <tr class="gradeX">
                            <td>{{$categoryAlbum->name}}</td>
                            <td>{{$categoryAlbum->description}}</td>
                            <td>{{$categoryAlbum->user->name}}</td>
                            @if($categoryAlbum->status->name === "Active")
                                <td>
                                <span class="label label-primary">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @elseif($categoryAlbum->status->name === "Inactive")
                                <td>
                                <span class="label label-danger">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @elseif($categoryAlbum->status->name === "Ongoing")
                                <td>
                                <span class="label label-danger">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @elseif($categoryAlbum->status->name === "Preview")
                                <td>
                                <span class="label label-warning">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @elseif($categoryAlbum->status->name === "Completed")
                                <td>
                                <span class="label label-primary">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @elseif($categoryAlbum->status->name === "Hidden")
                                <td>
                                <span class="label label-danger">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @elseif($categoryAlbum->status->name === "Published")
                                <td>
                                <span class="label label-warning">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @else
                                <td>
                                <span class="label label-default">{{$categoryAlbum->status->name}}</span>
                                </td>
                            @endif

                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="{{ route('admin.album', $categoryAlbum->id) }}" class="btn-white btn btn-xs">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
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

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

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

    </script>

@endsection