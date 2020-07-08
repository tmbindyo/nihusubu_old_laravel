<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{$user->name}}</strong>
                            </span>
                            <span class="text-muted text-xs block">
                                @if($user->activeUserAccount->userType->name == "Business")
                                    {{$user->activeUserAccount->institution->name}}
                                    <b class="caret"></b>
                                @elseif($user->activeUserAccount->userType->name == "Personal")
                                    Personal Account
                                    <b class="caret"></b>
                                @elseif($user->activeUserAccount->userType->name == "Admin")
                                    Nihusubu Admin
                                    <b class="caret"></b>
                                @endif
                                    {{--  {{$user->activeUserAccount}}  --}}

                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        @foreach($user->inactiveUserAccount as $userAccount)
                            @if($userAccount->userType->name == "Business")
                                <li><a href="{{route('activate.user.account',$userAccount->id)}}"> Access {{$userAccount->institution->name}} </a></li>
                            @endif
                            @if($userAccount->userType->name == "Personal")
                                <li><a href="{{route('activate.user.account',$userAccount->id)}}">Access Personal Account</a></li>
                            @endif
                            @if($userAccount->userType->name == "Admin")
                                <li><a href="{{route('activate.user.account',$userAccount->id)}}">Access Admin Account</a></li>
                            @endif
                        @endforeach
                        <li><a href="{{route('create.user.account')}}">Create New Account</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <img alt="image" style="height: 20px;" src="{{ asset('inspinia') }}/img/nihusubu.jpg" />
                </div>
            </li>

            {{-- <li class="nav-item {{ Route::currentRouteNamed( 'business.dashboard' ) ?  'active' : '' }}">
                <a href="{{ route('business.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li> --}}

            @can('view to dos')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.to.dos',$institution->portal ) ?  'active' : '' }}">
                    <a href="{{ route('business.to.dos',$institution->portal) }}"><i class="fa fa-list"></i> <span class="nav-label">To Do </span></a>
                </li>
            @endcan

            @can('view calendar')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.calendar',$institution->portal ) ?  'active' : '' }}">
                   <a href="{{ route('business.calendar',$institution->portal) }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
                </li>
            @endcan

            <li>
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span class="nav-label">Products </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @can('view product groups')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.product.groups',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.product.groups',$institution->portal)}}">
                                Product Groups
                            </a>
                        </li>
                    @endcan
                    @can('view products')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.products',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.products',$institution->portal)}}">
                                Products
                            </a>
                        </li>
                    @endcan
                    @can('view composite products')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.composite.products',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.composite.products',$institution->portal)}}">
                                Composite Products
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>


            <li>
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span class="nav-label">Inventory </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @can('view inventory adjustments')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.inventory.adjustments',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.inventory.adjustments',$institution->portal)}}">
                                Inventory Adjustments
                            </a>
                        </li>
                    @endcan
                    @can('view transfer orders')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.transfer.orders',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.transfer.orders',$institution->portal)}}">
                                Transfer Orders
                            </a>
                        </li>
                    @endcan
                    @can('view warehouses')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.warehouses',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.warehouses',$institution->portal)}}">
                                Warehouses
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>


            <li>
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span class="nav-label">CRM </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @can('view campaigns')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.campaigns',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.campaigns',$institution->portal)}}">
                                Campaign
                            </a>
                        </li>
                    @endcan
                    @can('view contacts')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.contacts',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.contacts',$institution->portal)}}">
                                Contacts
                            </a>
                        </li>
                    @endcan
                    @can('view leads')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.leads',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.leads',$institution->portal)}}">
                                Leads
                            </a>
                        </li>
                    @endcan
                    @can('view organizations')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.organizations',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.organizations',$institution->portal)}}">
                                Organizations
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">Sales </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @can('view estimates')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.estimates',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.estimates',$institution->portal)}}">
                                Estimates
                            </a>
                        </li>
                    @endcan
                    @can('view invoices')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.invoices',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.invoices',$institution->portal)}}">
                                Invoices
                            </a>
                        </li>
                    @endcan
                    @can('view sales')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.sales',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.sales',$institution->portal)}}">
                                Sales
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label">Accounting</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('view accounts')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.accounts',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.accounts',$institution->portal)}}">
                                Accounts
                            </a>
                        </li>
                    @endcan
                    @can('view expenses')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.expenses',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.expenses',$institution->portal)}}">
                                Expenses
                            </a>
                        </li>
                    @endcan
                    @can('view loans')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.loans',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.loans',$institution->portal)}}">
                                Loans
                            </a>
                        </li>
                    @endcan
                    @can('view payments')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.payments',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.payments',$institution->portal)}}">
                                Payments
                            </a>
                        </li>
                    @endcan
                    @can('view refunds')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.refunds',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.refunds',$institution->portal)}}">
                                Refunds
                            </a>
                        </li>
                    @endcan
                    @can('view transfers')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.transfers',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.transfers',$institution->portal)}}">
                                Transfers
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-sliders"></i>
                    <span class="nav-label">Settings</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @can('view campaign types')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.campaign.types',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.campaign.types',$institution->portal)}}">
                                Campaign Types
                            </a>
                        </li>
                    @endcan
                    @can('view contact types')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.contact.types',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.contact.types',$institution->portal)}}">
                                Contact Types
                            </a>
                        </li>
                    @endcan
                    @can('view frequencies')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.frequencies',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.frequencies',$institution->portal)}}">
                                Frequency
                            </a>
                        </li>
                    @endcan
                    @can('view lead sources')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.lead.sources',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.lead.sources',$institution->portal)}}">
                                Lead source
                            </a>
                        </li>
                    @endcan
                    @can('view taxes')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.taxes',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.taxes',$institution->portal)}}">
                                Taxes
                            </a>
                        </li>
                    @endcan
                    @can('view titles')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.titles',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.titles',$institution->portal)}}">
                                Titles
                            </a>
                        </li>
                    @endcan
                    @can('view units')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.units',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.units',$institution->portal)}}">
                                Units
                            </a>
                        </li>
                    @endcan
                    @can('view roles')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.roles',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.roles',$institution->portal)}}">
                                Roles
                            </a>
                        </li>
                    @endcan
                    @can('view users')
                        <li class="nav-item {{ Route::currentRouteNamed( 'business.users',$institution->portal ) ?  'active' : '' }}">
                            <a itemprop="url" class="nav-link" href="{{route( 'business.users',$institution->portal)}}">
                                Users
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'business.feedback',$institution->portal ) ?  'active' : '' }}">
                <a href="{{ route('business.feedback',$institution->portal) }}"><i class="fa fa-mail-reply-all"></i> <span class="nav-label">Feedback </span></a>
             </li>

        </ul>

    </div>
</nav>
