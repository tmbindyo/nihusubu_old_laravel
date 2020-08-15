@extends('business.layouts.app')

@section('title', 'Role Show')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Role's</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('business.calendar',$institution->portal)}}">Home</a></strong>
                </li>
                <li class="active">
                    <strong><a href="{{route('business.settings',$institution->portal)}}">Settings</a></strong>
                </li>
                <li class="active">
                    <strong>Role {{str_replace($institution->portal.' ', "", $role->name)}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
                @can('add user')
                    <a data-toggle="modal" data-target="#userRegistration" class="btn btn-success btn-round btn-outline"> <span class="fa fa-plus"></span> User </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-1" data-toggle="tab">Role Edit <small>form</small> </a></li>
                            <li class=""><a href="#tab-2" data-toggle="tab">Role Assign User <small>form</small></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="post" action="{{ route('business.role.update',['portal'=>$institution->portal, 'id'=>$role->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                        <input type="text" id="name" name="name" required="required" value="{{str_replace($institution->portal.' ', "", $role->name)}}" class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                                        <i>name</i>
                                                    </div>

                                                    @can('edit role')
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
                            <div class="tab-pane" id="tab-2">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="post" action="{{ route('business.user.assign.role',['portal'=>$institution->portal,'role_id'=>$role->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="has-warning">
                                                            @if ($errors->has('user'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('user') }}</strong>
                                                            </span>
                                                            @endif
                                                            <select name="user" style="width: 100%" class="select2_user form-control input-lg">
                                                                <option></option>
                                                                @foreach ($pendingUsers as $user)
                                                                    <option value="{{encrypt($user->id)}}">{{$user->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <i>user</i>
                                                        </div>
                                                    </div>
                                                </div>
                                                @can('user assign role')
                                                    <hr>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                                                    </div>
                                                @endcan

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Role Users <small>Form</small></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-products" >
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Roles</th>
                                    <th class="text-right" width="20em" data-sort-ignore="true">Revoke</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roleUsers as $user)
                                    <tr class="gradeA">
                                        <td>{{$user->name}}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="label label-primary">{{$role->name}} </span>
                                            @endforeach
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('user revoke role')
                                                    <a href="{{ route('business.user.revoke.role', ['portal'=>$institution->portal, 'id'=>encrypt($user->id), 'role_id'=>encrypt($role->id)]) }}" class="btn-success btn-danger btn btn-xs">Revoke</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Roles</th>
                                    <th class="text-right" width="13em" data-sort-ignore="true">Revoke</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  details  --}}
        <div class="row">
            <div class="">
                @foreach($institutionModules as $institutionModule)
                    <div class="">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5 class="text-center">{{$institutionModule->module->name}}</h5>

                                <div class="ibox-tools">
                                    {{-- todo add way to grant all permissions of module --}}
{{--                                    <input type="checkbox" class="pull-right js-switch-{{$institutionModule->id}}" />--}}
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    @foreach($institutionModule->module->permissions as $permission)
                                        <div class="col-sm-2">
                                            <div class="checkbox checkbox-primary">
                                                <input class="updateRolePermission" data-portal="{{$institution->portal}}" data-permission_id="{{encrypt($permission->id)}}" data-role_id="{{encrypt($role->id)}}" id="{{$permission->name}}" type="checkbox" @if(in_array($permission->name, $rolePermissionNames)) checked="true" @endif >
                                                <label for="{{$permission->name}}">
                                                    {{$permission->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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

    {{--  masonry  --}}
    <script src="{{ asset('inspinia') }}/js/plugins/masonary/masonry.pkgd.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Image cropper -->
    <script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <style>

        .grid .ibox {
            margin-bottom: 0;
        }

        .grid-item {
            margin-bottom: 25px;
            width: 300px;
        }
    </style>

    <script>
        $(window).load(function() {

            $('.grid').masonry({
                // options
                itemSelector: '.grid-item',
                columnWidth: 300,
                gutter: 25
            });

        });
    </script>

    <script>
        $(document).ready(function(){

            $(".select2_user").select2({
                placeholder: "Select User",
                allowClear: true
            });

            var elem = document.querySelector('.js-switch-2c4f7085-b137-4717-8f00-5e1a3be905c1');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            @foreach($institutionModules as $institutionModule)
                var elem = document.querySelector('.js-switch-{{$institutionModule->id}}');
                var switchery = new Switchery(elem, { color: '#1AB394' });
            @endforeach

        });

    </script>

    {{--  generate album set visibility  --}}
    <script>
        $('.updateRolePermission').on('click',function(){
            var permission_id = $(this).data('permission_id')
            var role_id = $(this).data('role_id')
            var portal = $(this).data('portal')

            // business/{portal}/role/update/{role_id}/permission/{permission_id}
            //send value by ajax to server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", '{{url('business')}}'+'/'+portal+'/role/update/'+role_id+'/permission/'+permission_id);
            xhr.setRequestHeader('Content-Type', '');
            xhr.send();
            xhr.onload = function() {
                alert("Role permission updated!");
            }
        });

    </script>

    {{--  Data tables  --}}
    <script>
        $(document).ready(function(){
            $('.dataTables-products').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$role->name}} Products',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$role->name}} Products',
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
    <script>
        $(document).ready(function(){
            $('.dataTables-product-groups').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: '{{$role->name}} Product Groups',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$role->name}} Product Groups',
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
