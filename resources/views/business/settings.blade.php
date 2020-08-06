@extends('business.layouts.app')

@section('title', 'Settings')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Settings</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li class="active">
                    <strong>Settings</strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <div class="tabs-left">
                        <ul class="nav nav-tabs">
                            <li class="@if(session()->get( 'active' ) == 'brands') active @elseif(is_null(session()->get( 'active' ))) active @endif"><a data-toggle="tab" href="#brands"> Brands</a></li>
                            <li class="@if(session()->get( 'active' ) == 'campaignTypes') active @endif"><a data-toggle="tab" href="#campaignTypes">Campaign Types</a></li>
                            <li class="@if(session()->get( 'active' ) == 'contactTypes') active @endif"><a data-toggle="tab" href="#contactTypes">Contact Types</a></li>
                            <li class="@if(session()->get( 'active' ) == 'frequencies') active @endif"><a data-toggle="tab" href="#frequencies">Frequencies</a></li>
                            <li class="@if(session()->get( 'active' ) == 'leadSources') active @endif"><a data-toggle="tab" href="#leadSources">Lead Sources</a></li>
                            <li class="@if(session()->get( 'active' ) == 'productCategories') active @endif"><a data-toggle="tab" href="#productCategories">Product Categories</a></li>
                            <li class="@if(session()->get( 'active' ) == 'productSubCategories') active @endif"><a data-toggle="tab" href="#productSubCategories">Product Sub Categories</a></li>
                            <li class="@if(session()->get( 'active' ) == 'taxes') active @endif"><a data-toggle="tab" href="#taxes">Taxes</a></li>
                            <li class="@if(session()->get( 'active' ) == 'titles') active @endif"><a data-toggle="tab" href="#titles">Titles</a></li>
                            <li class="@if(session()->get( 'active' ) == 'units') active @endif"><a data-toggle="tab" href="#units">Units</a></li>
                            <li class="@if(session()->get( 'active' ) == 'roles') active @endif"><a data-toggle="tab" href="#roles">Roles</a></li>
                            <li class="@if(session()->get( 'active' ) == 'users') active @endif"><a data-toggle="tab" href="#users">Users</a></li>
                            <li class="@if(session()->get( 'active' ) == 'institution') active @endif"><a data-toggle="tab" href="#institution">Institution</a></li>
                            <li class="@if(session()->get( 'active' ) == 'modules') active @endif"><a data-toggle="tab" href="#modules">Modules</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="brands" class="tab-pane @if(session()->get( 'active' ) == 'brands') active @elseif(is_null(session()->get( 'active' ))) active @endif">
                                <div class="panel-body">

                                    @can('add brand')
                                        <a data-toggle="modal" data-target="#brandRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Brand </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view brands')
                                        {{-- brands --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($brands as $brand)
                                                    <tr class="gradeX">
                                                        <td>{{$brand->name}}</td>
                                                        <td>{{$brand->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$brand->status->label}}">{{$brand->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view brand')
                                                                    <a href="{{ route('business.brand.show', ['portal'=>$institution->portal, 'id'=>$brand->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete brand')
                                                                    <a href="{{ route('business.brand.delete', ['portal'=>$institution->portal, 'id'=>$brand->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted brands --}}
                                        @if($deletedBrands->count())
                                            <h3 class="text-center">Deleted Brands</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedBrands as $brand)
                                                        <tr class="gradeX">
                                                            <td>{{$brand->name}}</td>
                                                            <td>{{$brand->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$brand->status->label}}">{{$brand->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view brand')
                                                                        <a href="{{ route('business.brand.show', ['portal'=>$institution->portal, 'id'=>$brand->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('view brand')
                                                                        <a href="{{ route('business.brand.restore', ['portal'=>$institution->portal, 'id'=>$brand->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="campaignTypes" class="tab-pane @if(session()->get( 'active' ) == 'campaignTypes') active @endif">
                                <div class="panel-body">

                                    @can('add campaign type')
                                        <a data-toggle="modal" data-target="#campaignTypeRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Campaign Type </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view campaign types')
                                        {{-- campaign types --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($campaignTypes as $campaignType)
                                                    <tr class="gradeX">
                                                        <td>{{$campaignType->name}}</td>
                                                        <td>{{$campaignType->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$campaignType->status->label}}">{{$campaignType->status->name}}</span>
                                                        </td>

                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view campaign type')
                                                                    <a href="{{ route('business.campaign.type.show', ['portal'=>$institution->portal, 'id'=>$campaignType->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete campaign type')
                                                                    <a href="{{ route('business.campaign.type.delete', ['portal'=>$institution->portal, 'id'=>$campaignType->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted campaign types --}}
                                        @if ($deletedCampaignTypes->count())
                                            <h3 class="text-center">Deleted Campaign Types</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedCampaignTypes as $campaignType)
                                                        <tr class="gradeX">
                                                            <td>{{$campaignType->name}}</td>
                                                            <td>{{$campaignType->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$campaignType->status->label}}">{{$campaignType->status->name}}</span>
                                                            </td>

                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view campaign type')
                                                                        <a href="{{ route('business.campaign.type.show', ['portal'=>$institution->portal, 'id'=>$campaignType->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete campaign type')
                                                                        <a href="{{ route('business.campaign.type.restore', ['portal'=>$institution->portal, 'id'=>$campaignType->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="contactTypes" class="tab-pane @if(session()->get( 'active' ) == 'contactTypes') active @endif">
                                <div class="panel-body">
                                    @can('add contact type')
                                        <a data-toggle="modal" data-target="#contactTypeRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Contact Type </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view contact types')
                                        {{-- contact types --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($contactTypes as $contactType)
                                                    <tr class="gradeX">
                                                        <td>{{$contactType->name}}</td>
                                                        <td>{{$contactType->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$contactType->status->label}}">{{$contactType->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view contact type')
                                                                    <a href="{{ route('business.contact.type.show', ['portal'=>$institution->portal, 'id'=>$contactType->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete contact type')
                                                                    <a href="{{ route('business.contact.type.delete', ['portal'=>$institution->portal, 'id'=>$contactType->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted contact types --}}
                                        @if($deletedContactTypes->count())
                                            <h3 class="text-center">Deleted Contact Types</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedContactTypes as $contactType)
                                                        <tr class="gradeX">
                                                            <td>{{$contactType->name}}</td>
                                                            <td>{{$contactType->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$contactType->status->label}}">{{$contactType->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view contact type')
                                                                        <a href="{{ route('business.contact.type.show', ['portal'=>$institution->portal, 'id'=>$contactType->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete contact type')
                                                                        <a href="{{ route('business.contact.type.restore', ['portal'=>$institution->portal, 'id'=>$contactType->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="frequencies" class="tab-pane @if(session()->get( 'active' ) == 'frequencies') active @endif">
                                <div class="panel-body">

                                    @can('add frequency')
                                        <a data-toggle="modal" data-target="#frequencyRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Frequency </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view frequencies')
                                        {{-- frequencies --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Frequency</th>
                                                    <th>User</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($frequencies as $frequency)
                                                    <tr class="gradeX">
                                                        <td>{{$frequency->name}}</td>
                                                        <td>{{$frequency->type}}</td>
                                                        <td>{{$frequency->frequency}}</td>
                                                        <td>{{$frequency->user->name}}</td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view frequency')
                                                                    <a href="{{ route('business.frequency.show', ['portal'=>$institution->portal, 'id'=>$frequency->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete frequency')
                                                                    <a href="{{ route('business.frequency.delete', ['portal'=>$institution->portal, 'id'=>$frequency->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Frequency</th>
                                                    <th>User</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted frequencies --}}
                                        @if($deletedFrequencies->count())
                                            <h3 class="text-center">Deleted Frequencies</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Type</th>
                                                        <th>Frequency</th>
                                                        <th>User</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedFrequencies as $frequency)
                                                        <tr class="gradeX">
                                                            <td>{{$frequency->name}}</td>
                                                            <td>{{$frequency->type}}</td>
                                                            <td>{{$frequency->frequency}}</td>
                                                            <td>{{$frequency->user->name}}</td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view frequency')
                                                                        <a href="{{ route('business.frequency.show', ['portal'=>$institution->portal, 'id'=>$frequency->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete frequency')
                                                                        <a href="{{ route('business.frequency.restore', ['portal'=>$institution->portal, 'id'=>$frequency->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Frequency</th>
                                                        <th>User</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="leadSources" class="tab-pane @if(session()->get( 'active' ) == 'leadSources') active @endif">
                                <div class="panel-body">

                                    @can('add lead source')
                                        <a data-toggle="modal" data-target="#leadSourceRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Lead Source </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view lead sources')
                                        {{-- lead sources --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($leadSources as $leadSource)
                                                    <tr class="gradeX">
                                                        <td>{{$leadSource->name}}</td>
                                                        <td>{{$leadSource->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$leadSource->status->label}}">{{$leadSource->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view lead source')
                                                                    <a href="{{ route('business.lead.source.show', ['portal'=>$institution->portal, 'id'=>$leadSource->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete lead source')
                                                                    <a href="{{ route('business.lead.source.delete', ['portal'=>$institution->portal, 'id'=>$leadSource->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted lead sources --}}
                                        @if($deletedLeadSources->count())
                                            <h3 class="text-center">Deleted Lead Sources</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedLeadSources as $leadSource)
                                                        <tr class="gradeX">
                                                            <td>{{$leadSource->name}}</td>
                                                            <td>{{$leadSource->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$leadSource->status->label}}">{{$leadSource->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view lead source')
                                                                        <a href="{{ route('business.lead.source.show', ['portal'=>$institution->portal, 'id'=>$leadSource->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete lead source')
                                                                        <a href="{{ route('business.lead.source.restore', ['portal'=>$institution->portal, 'id'=>$leadSource->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="productCategories" class="tab-pane @if(session()->get( 'active' ) == 'productCategories') active @endif">
                                <div class="panel-body">

                                    @can('add product category')
                                        <a data-toggle="modal" data-target="#productCategoryRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Product Category </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view product categories')
                                        {{-- product categories --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productCategories as $productCategory)
                                                    <tr class="gradeX">
                                                        <td>{{$productCategory->name}}</td>
                                                        <td>{{$productCategory->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$productCategory->status->label}}">{{$productCategory->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view product category')
                                                                    <a href="{{ route('business.product.category.show', ['portal'=>$institution->portal, 'id'=>$productCategory->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete product category')
                                                                    <a href="{{ route('business.product.category.delete', ['portal'=>$institution->portal, 'id'=>$productCategory->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted product categories --}}
                                        @if($deletedProductCategories->count())
                                            <h3 class="text-center">Deleted Product category</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedProductCategories as $productCategory)
                                                        <tr class="gradeX">
                                                            <td>{{$productCategory->name}}</td>
                                                            <td>{{$productCategory->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$productCategory->status->label}}">{{$productCategory->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view product category')
                                                                        <a href="{{ route('business.product.category.show', ['portal'=>$institution->portal, 'id'=>$productCategory->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('view product category')
                                                                        <a href="{{ route('business.product.category.restore', ['portal'=>$institution->portal, 'id'=>$productCategory->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="productSubCategories" class="tab-pane @if(session()->get( 'active' ) == 'productSubCategories') active @endif">
                                <div class="panel-body">

                                    @can('add product sub category')
                                        <a data-toggle="modal" data-target="#productSubCategoryRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Product Sub Category </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view product sub categories')
                                        {{-- product sub categories --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Product Category</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productSubCategories as $productSubCategory)
                                                    <tr class="gradeX">
                                                        <td>{{$productSubCategory->name}}</td>
                                                        <td>{{$productSubCategory->productCategory->name}}</td>
                                                        <td>{{$productSubCategory->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$productSubCategory->status->label}}">{{$productSubCategory->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view product sub category')
                                                                    <a href="{{ route('business.product.sub.category.show', ['portal'=>$institution->portal, 'id'=>$productSubCategory->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete product sub category')
                                                                    <a href="{{ route('business.product.sub.category.delete', ['portal'=>$institution->portal, 'id'=>$productSubCategory->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Product Category</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted product sub categories --}}
                                        @if($deletedProductSubCategories->count())
                                            <h3 class="text-center">Deleted Product Subcategories</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Product Category</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedProductSubCategories as $productSubCategory)
                                                        <tr class="gradeX">
                                                            <td>{{$productSubCategory->name}}</td>
                                                            <td>{{$productSubCategory->productCategory->name}}</td>
                                                            <td>{{$productSubCategory->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$productSubCategory->status->label}}">{{$productSubCategory->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view product sub category')
                                                                        <a href="{{ route('business.product.category.show', ['portal'=>$institution->portal, 'id'=>$productSubCategory->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('view product sub category')
                                                                        <a href="{{ route('business.product.category.restore', ['portal'=>$institution->portal, 'id'=>$productSubCategory->id]) }}" class="btn-warning btn btn-xs">Restore</a>
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Product Category</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="taxes" class="tab-pane @if(session()->get( 'active' ) == 'taxes') active @endif">
                                <div class="panel-body">

                                    @can('add tax')
                                        <a data-toggle="modal" data-target="#taxRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Tax </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view taxes')
                                        {{-- taxes --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Percentage</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($taxes as $tax)
                                                    <tr class="gradeX">
                                                        <td>{{$tax->name}}</td>
                                                        <td>{{$tax->amount}}</td>
                                                        <td>
                                                            <label class="label label-info">
                                                                @if($tax->is_percentage == True) Percentage @else Standard Price @endif
                                                            </label>
                                                        </td>
                                                        <td>{{$tax->user->name}}</td>
                                                        <td>
                                                            <span class="tax {{$tax->status->tax}}">{{$tax->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view tax')
                                                                    <a href="{{ route('business.tax.show', ['portal'=>$institution->portal, 'id'=>$tax->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete tax')
                                                                    <a href="{{ route('business.tax.delete', ['portal'=>$institution->portal, 'id'=>$tax->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Percentage</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted taxes --}}
                                        @if($deletedTaxes->count())
                                            <h3 class="text-center">Deleted Taxes</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedTaxes as $tax)
                                                        <tr class="gradeX">
                                                            <td>{{$tax->name}}</td>
                                                            <td>{{$tax->user->name}}</td>
                                                            <td>
                                                                <span class="tax {{$tax->status->tax}}">{{$tax->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view tax')
                                                                        <a href="{{ route('business.tax.show', ['portal'=>$institution->portal, 'id'=>$tax->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete tax')
                                                                        <a href="{{ route('business.tax.restore', ['portal'=>$institution->portal, 'id'=>$tax->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="titles" class="tab-pane @if(session()->get( 'active' ) == 'titles') active @endif">
                                <div class="panel-body">

                                    @can('add title')
                                        <a data-toggle="modal" data-target="#titleRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Title </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view titles')
                                        {{-- titles --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($titles as $title)
                                                    <tr class="gradeX">
                                                        <td>{{$title->name}}</td>
                                                        <td>{{$title->user->name}}</td>
                                                        <td>
                                                            <span class="label {{$title->status->label}}">{{$title->status->name}}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view title')
                                                                    <a href="{{ route('business.title.show', ['portal'=>$institution->portal, 'id'=>$title->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete title')
                                                                    <a href="{{ route('business.title.delete', ['portal'=>$institution->portal, 'id'=>$title->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted titles --}}
                                        @if($deletedTitles->count())
                                            <h3 class="text-center">Deleted Titles</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedTitles as $title)
                                                        <tr class="gradeX">
                                                            <td>{{$title->name}}</td>
                                                            <td>{{$title->user->name}}</td>
                                                            <td>
                                                                <span class="label {{$title->status->label}}">{{$title->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view title')
                                                                        <a href="{{ route('business.title.show', ['portal'=>$institution->portal, 'id'=>$title->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('view title')
                                                                        <a href="{{ route('business.title.restore', ['portal'=>$institution->portal, 'id'=>$title->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="units" class="tab-pane @if(session()->get( 'active' ) == 'units') active @endif">
                                <div class="panel-body">

                                    @can('add unit')
                                        <a data-toggle="modal" data-target="#unitRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Unit </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view units')
                                        {{-- units --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($units as $unit)
                                                        <tr class="gradeX">
                                                            <td>{{$unit->name}}</td>
                                                            <td>{{$unit->user->name}}</td>
                                                            <td>
                                                                <span class="unit {{$unit->status->unit}}">{{$unit->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view unit')
                                                                        <a href="{{ route('business.unit.show', ['portal'=>$institution->portal, 'id'=>$unit->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete unit')
                                                                        <a href="{{ route('business.unit.delete', ['portal'=>$institution->portal, 'id'=>$unit->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted units --}}
                                        @if($deletedUnits->count())
                                            <h3 class="text-center">Deleted Units</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedUnits as $unit)
                                                        <tr class="gradeX">
                                                            <td>{{$unit->name}}</td>
                                                            <td>{{$unit->user->name}}</td>
                                                            <td>
                                                                <span class="unit {{$unit->status->unit}}">{{$unit->status->name}}</span>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view unit')
                                                                        <a href="{{ route('business.unit.show', ['portal'=>$institution->portal, 'id'=>$unit->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete unit')
                                                                        <a href="{{ route('business.unit.restore', ['portal'=>$institution->portal, 'id'=>$unit->id]) }}" class="btn-warning btn btn-xs">Restore</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="roles" class="tab-pane @if(session()->get( 'active' ) == 'roles') active @endif">
                                <div class="panel-body">

                                    @can('add role')
                                        <a data-toggle="modal" data-target="#roleRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Role </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view roles')
                                        {{-- roles --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($roles as $role)
                                                    <tr class="gradeX">
                                                        <td>{{str_replace($institution->portal.' ', "", $role->name)}}</td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view role')
                                                                    <a href="{{ route('business.role.show', ['portal'=>$institution->portal, 'id'=>encrypt($role->id)]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete role')
                                                                    <a href="{{ route('business.role.delete', ['portal'=>$institution->portal, 'id'=>$role->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @endcan

                                </div>
                            </div>
                            <div id="users" class="tab-pane @if(session()->get( 'active' ) == 'users') active @endif">
                                <div class="panel-body">

                                    @can('add user')
                                        <a data-toggle="modal" data-target="#userRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> User </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view users')
                                        {{-- users --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Roles</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $institutionUser)
                                                    <tr class="gradeX">
                                                        <td>{{$institutionUser->user->name}}</td>
                                                        <td>{{$institutionUser->user->email}}</td>
                                                        <td>
                                                            @foreach($institutionUser->user->roles as $role)
                                                                <label class="label label-default">{{$role->name}}</label>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $institutionUser->created_at->format('d/m/Y H:i') }}</td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view user')
                                                                    <a href="{{ route('business.user.show', ['portal'=>$institution->portal, 'id'=>$institutionUser->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete user')
                                                                    <a href="{{ route('business.user.delete', ['portal'=>$institution->portal, 'id'=>$institutionUser->id]) }}" class="btn-danger btn btn-xs">Delete</a>
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
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted users --}}
                                        @if($deletedUsers->count())
                                            <h3 class="text-center">Deleted Users</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedUsers as $institutionUser)
                                                        <tr class="gradeX">
                                                            <td>{{$institutionUser->user->name}}</td>
                                                            <td>{{$institutionUser->user->email}}</td>
                                                            <td>{{ $institutionUser->created_at->format('d/m/Y H:i') }}</td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view user')
                                                                        <a href="{{ route('business.user.show', ['portal'=>$institution->portal, 'id'=>$institutionUser->user->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete user')
                                                                        <a href="{{ route('business.user.restore', ['portal'=>$institution->portal, 'id'=>$institutionUser->user->id]) }}" class="btn-warning btn btn-xs">Delete</a>
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
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>
                            <div id="institution" class="tab-pane @if(session()->get( 'active' ) == 'institution') active @endif">
                                <div class="panel-body">

                                    <div class="">
                                        <div class="col-md-12">
                                            <form method="post" action="{{ route('business.institution.update',['portal'=>$institution->portal, 'id'=>$institution->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="has-warning">
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="name" name="name" required="required" value="{{$institution->name}}" class="form-control input-lg">
                                                                <i>name</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('portal'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('portal') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="portal" name="portal" required="required" value="{{$institution->portal}}" class="form-control input-lg">
                                                                <i>portal</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('email'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="email" id="email" name="email" required="required" value="{{$institution->email}}" class="form-control input-lg">
                                                                <i>email</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('phone_number'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('"phone_number') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="phone_number" name="phone_number" data-mask="(999) 999-999-999" required="required" value="{{$institution->phone_number}}" class="form-control input-lg">
                                                                <i>phone number</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('address_line_1'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('address_line_1') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="address_line_1" name="address_line_1" required="required" value="{{$institution->address->address_line_1}}" class="form-control input-lg">
                                                                <i>address line 1</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('address_line_2'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('address_line_2') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="address_line_2" name="address_line_2" required="required" value="{{$institution->address->address_line_2}}" class="form-control input-lg">
                                                                <i>address line 2</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('street'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('street') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="street" name="street" required="required" value="{{$institution->address->street}}" class="form-control input-lg">
                                                                <i>street</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('city'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('city') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="city" name="city" required="required" value="{{$institution->address->town}}" class="form-control input-lg">
                                                                <i>city</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('postal_code'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="postal_code" name="postal_code" required="required" value="{{$institution->address->postal_code}}" class="form-control input-lg">
                                                                <i>postal code</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('currency'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('currency') }}</strong>
                                                            </span>
                                                                @endif
                                                                <select name="currency" data-placeholder="Choose a currency..." class="chosen-select" {{ $errors->has('currency') ? ' is-invalid' : '' }}  tabindex="2">
                                                                    <option></option>
                                                                    @foreach($currencies as $currency)
                                                                        <option @if($institution->currency->id == $currency->id) selected @endif value="{{$currency->id}}">{{$currency->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <i>currency</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('plan'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('plan') }}</strong>
                                                            </span>
                                                                @endif
                                                                    <select name="plan" data-placeholder="Choose a plan..." class="chosen-select {{ $errors->has('plan') ? ' is-invalid' : '' }}"  tabindex="2">
                                                                    <option></option>
                                                                    @foreach($plans as $plan)
                                                                        <option @if($institution->plan->id == $plan->id) selected @endif value="{{$plan->id}}">{{$plan->name}}[{{$plan->price}}]</option>
                                                                    @endforeach
                                                                </select>
                                                                <i>plan</i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    @can('edit institution')
                                                        <hr>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Update') }}</button>
                                                        </div>
                                                    @endcan
                                                </div>


                                            </form>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div id="modules" class="tab-pane @if(session()->get( 'active' ) == 'modules') active @endif">
                                <div class="panel-body">

                                    <div class="ibox">
                                        <div class="ibox-content">

                                            <div class="row m-b-lg m-t-lg">
                                                <div class="col-lg-6 col-md-3">

                                                    <div class="profile-image">
                                                        <img src="{{ asset('inspinia') }}/img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
                                                    </div>
                                                    <div class="profile-info">
                                                        <div class="">
                                                            <div>
                                                                <h2 class="no-margins">
                                                                    Alex Smith
                                                                </h2>
                                                                <h4>Founder of Groupeq</h4>
                                                                <small>
                                                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                                                    have suffered alteration in some form Ipsum available.
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <table class="table small m-b-xs">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>142</strong> Projects
                                                            </td>
                                                            <td>
                                                                <strong>22</strong> Followers
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>61</strong> Comments
                                                            </td>
                                                            <td>
                                                                <strong>54</strong> Articles
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>154</strong> Tags
                                                            </td>
                                                            <td>
                                                                <strong>32</strong> Friends
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-3 col-md-3">
                                                    <small>Month Price</small>
                                                    <h2 class="no-margins">{{$institution->currency->name}} 206 480</h2>
                                                    <div id="sparkline1"></div>
                                                    <br>
                                                </div>
                                            </div>
                                            <br>
                                            {{--  --}}
                                            <div class="row">
                                                @foreach($modules as $module)
                                                    <div class="col-lg-4">
                                                        <div class="ibox">
                                                            <div class="ibox-title">
                                                                <span class="label label-primary pull-right">NEW</span>
                                                                <h5>{{$module->name}}</h5>
                                                            </div>
                                                            <div class="ibox-content">
                                                                <div class="team-members">
                                                                    <a href="#"><img alt="member" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg"></a>
                                                                    <a href="#"><img alt="member" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg"></a>
                                                                    <a href="#"><img alt="member" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg"></a>
                                                                    <a href="#"><img alt="member" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg"></a>
                                                                    <a href="#"><img alt="member" class="img-circle" src="{{ asset('inspinia') }}/img/a6.jpg"></a>
                                                                </div>
                                                                <h4>Info about {{$module->name}}</h4>
                                                                <p>
                                                                    {{ Str::limit($module->description, $limit = 171, $end = '...') }}
                                                                </p>
                                                                <div>
                                                                    <span>Status of current project:</span>
                                                                    <div class="stat-percent">48%</div>
                                                                    <div class="progress progress-mini">
                                                                        <div style="width: 48%;" class="progress-bar"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row  m-t-sm">
                                                                    <div class="col-sm-4">
                                                                        <div class="font-bold">PROJECTS</div>
                                                                        12
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="font-bold">RANKING</div>
                                                                        4th
                                                                    </div>
                                                                    <div class="col-sm-4 text-right">
                                                                        <div class="font-bold">Price</div>
                                                                        {{$institution->currency->name}} {{$module->price}}
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="user-button">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-md-offset-6">
                                                                            @if ( in_array($module->id, $institutionModulesIds) )
                                                                                <a href="{{ route('business.module.unsubscribe', ['portal'=>$institution->portal, 'id'=>$module->id]) }}" type="button" class="btn btn-warning btn-sm btn-block pull-right"><i class="fa fa-times"></i> Unubscribe</a>
                                                                            @else
                                                                                <a href="{{ route('business.module.subscribe', ['portal'=>$institution->portal, 'id'=>$module->id]) }}" type="button" class="btn btn-primary btn-sm btn-block pull-right"><i class="fa fa-check"></i> Subscribe</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
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

    <br>

@endsection

@include('business.layouts.modals.brand_create')
@include('business.layouts.modals.campaign_type_create')
@include('business.layouts.modals.contact_type_create')
@include('business.layouts.modals.frequency_create')
@include('business.layouts.modals.lead_source_create')
@include('business.layouts.modals.product_category_create')
@include('business.layouts.modals.product_sub_category_create')
@include('business.layouts.modals.tax_create')
@include('business.layouts.modals.title_create')
@include('business.layouts.modals.unit_create')
@include('business.layouts.modals.role_create')
@include('business.layouts.modals.user_add')


@section('js')


    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <script>
        $(document).ready(function(){

            $('.chosen-select').chosen({width: "100%"});

            $(".select2_currency").select2({
                placeholder: "Select Currency",
                allowClear: true
            });

            $(".select2_plan").select2({
                placeholder: "Select Plan",
                allowClear: true
            });

            $(".select2_type").select2({
                placeholder: "Select Type",
                allowClear: true
            });

            $(".select2_product_category").select2({
                placeholder: "Select Product Category",
                allowClear: true
            });

        });

    </script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: 'Brands',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {extend: 'pdf',
                        title: 'Brands',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
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
