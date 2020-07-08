@extends('business.layouts.app')

@section('title', 'Campaign Type')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Campaign Type's</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="#">Settings</a>
            </li>
            <li class="active">
                <a href="{{route('business.campaign.types',$institution->portal)}}">Campaign Type's</a>
            </li>
            <li class="active">
                <strong>Campaign Type</strong>
            </li>
        </ol>
    </div>
    <div class="col-md-3">
        <div class="title-action">
            <a href="{{route('business.campaign.type.campaign.create',['portal'=>$institution->portal, 'id'=>$campaignType->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Campaign </a>
        </div>
    </div>
</div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Campaign Type <small>edit</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form method="post" action="{{ route('business.campaign.type.update',['portal'=>$institution->portal, 'id'=>$campaignType->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                                        <div class="has-warning">
                                            <input type="name" name="name" value="{{$campaignType->name}}" class="form-control input-lg">
                                            <i>name</i>
                                        </div>

                                        @can('edit campaign type')
                                            <hr>

                                            <div>
                                                <button class="btn btn-lg btn-primary btn-block" type="submit"><strong>Update</strong></button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @can('view campaigns')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Campaigns ({{$campaignType->campaigns_count}})</h5>

                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campaigns as $campaign)
                                                <tr class="gradeX">
                                                    <td>{{$campaign->name}}</td>
                                                    <td>{{$campaign->campaignType->name}}</td>
                                                    <td>{{$campaign->start_date}}</td>
                                                    <td>{{$campaign->end_date}}</td>
                                                    <td>{{$campaign->user->name}}</td>
                                                    <td>
                                                        <span class="label {{$campaign->status->label}}">{{$campaign->status->name}}</span>
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            @can('view campaign')
                                                                <a href="{{ route('business.campaign.show', ['portal'=>$institution->portal, 'id'=>$campaign->id]) }}" class="btn-white btn btn-xs">View</a>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

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
                    {extend: 'excel',
                        title: '{{$campaignType->name}} Campaigns',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {extend: 'pdf',
                        title: '{{$campaignType->name}} Campaigns',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
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
