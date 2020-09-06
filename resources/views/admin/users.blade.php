@extends('admin.layouts.app')

@section('title', ' Users')

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Users</h2>
                <ol class="breadcrumb">
                    <li>
                        <strong><a href="{{route('admin.dashboard')}}">Home</a></strong>
                    </li>
                    <li>
                        Users
                    </li>
                    <li class="active">
                        <strong>Users</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
                <div class="title-action">
                    @can('admin create user')
                        <a data-toggle="modal" data-target="#userRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> User </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Users</h5>
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
                                        <th>User</th>
                                        <th>Roles</th>
                                        <th>Created</th>
                                        <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $institutionUser)
                                        <tr class="gradeX">
                                            <td>{{$institutionUser->user->name}}</td>
                                            <td>{{$institutionUser->user->email}}</td>
                                            <td>
                                                @foreach($institutionUser->user->adminRoles as $role)
                                                    <label class="label label-default">{{$role->name}}</label>
                                                @endforeach
                                            </td>
                                            <td>{{ $institutionUser->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    @can('admin view user')
                                                        <a href="{{ route('admin.user.show', encrypt($institutionUser->user->id)) }}" class="btn-white btn btn-xs">View</a>
                                                    @endcan
                                                    @can('admin delete user')
                                                        <a href="{{ route('admin.user.delete', encrypt($institutionUser->user->id)) }}" class="btn-danger btn btn-xs">Delete</a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th>Roles</th>
                                        <th>Created</th>
                                        <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
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

@include('admin.layouts.modals.user_add')

@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<script>
    $(document).ready(function(){

        $('.chosen-select').chosen({width: "100%"});
    });
</script>
{{--  Data tables  --}}
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: 'Users',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf',
                    title: 'Users',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
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
