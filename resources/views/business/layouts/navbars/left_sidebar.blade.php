<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile_small.jpg" />
                    </span>
                    {{--  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{$user->name}}</strong>  --}}
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">{{$user->name}}</strong>
                                        </span>
                                        <span class="text-muted text-xs block">
                                            @if($user->active_user_account->user_type->name == "Business")
                                                {{$user->active_user_account->institution->name}}
                                                <b class="caret"></b>
                                            @elseif($user->active_user_account->user_type->name == "Personal")
                                                Personal Account
                                                <b class="caret"></b>
                                            @elseif($user->active_user_account->user_type->name == "Admin")
                                                Nihusubu Admin
                                                <b class="caret"></b>
                                            @endif
                                                {{--  {{$user->active_user_account}}  --}}

                                        </span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    @foreach($user->inactive_user_account as $userAccount)
                                        @if($userAccount->user_type->name == "Business")
                                            <li><a href="{{route('activate.user.account',$userAccount->id)}}"> Access {{$userAccount->institution->name}} </a></li>
                                        @endif
                                        @if($userAccount->user_type->name == "Personal")
                                            <li><a href="{{route('activate.user.account',$userAccount->id)}}">Access Personal Account</a></li>
                                        @endif
                                        @if($userAccount->user_type->name == "Admin")
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

           <li class="nav-item {{ Route::currentRouteNamed( 'business.calendar',$institution->portal ) ?  'active' : '' }}">
               <a href="{{ route('business.calendar',$institution->portal) }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'business.to.dos',$institution->portal ) ?  'active' : '' }}">
                <a href="{{ route('business.to.dos',$institution->portal) }}"><i class="fa fa-list"></i> <span class="nav-label">To Do </span></a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span class="nav-label">Products </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.product.groups',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.product.groups',$institution->portal)}}">
                            Product Groups
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.products',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.products',$institution->portal)}}">
                            Products
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.composite.products',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.composite.products',$institution->portal)}}">
                            Composite Products
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span class="nav-label">Inventory </span>
                    <span class="fa arrow"></span>
{{--                    <span class="label label-info pull-right">16</span>--}}
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.inventory.adjustments',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.inventory.adjustments',$institution->portal)}}">
                            Inventory Adjustments
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.transfer.orders',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.transfer.orders',$institution->portal)}}">
                            Transfer Orders
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.warehouses',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.warehouses',$institution->portal)}}">
                            Warehouses
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">CRM </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.campaigns',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.campaigns',$institution->portal)}}">
                            Campaign
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.contacts',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.contacts',$institution->portal)}}">
                            Contacts
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.leads',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.leads',$institution->portal)}}">
                            Leads
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.organizations',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.organizations',$institution->portal)}}">
                            Organizations
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">Sales </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.estimates',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.estimates',$institution->portal)}}">
                            Estimates
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.invoices',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.invoices',$institution->portal)}}">
                            Invoices
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.sales',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.sales',$institution->portal)}}">
                            Sales
                        </a>
                    </li>
                </ul>
            </li>

{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-dollar"></i>--}}
{{--                    <span class="nav-label">Expenses </span>--}}
{{--                    <span class="fa arrow"></span>--}}
{{--                </a>--}}
{{--                <ul class="nav nav-second-level collapse">--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.purchase.orders' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.purchase.orders')}}">--}}
{{--                            Purchase Order--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.vendors' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.vendors')}}">--}}
{{--                            Vendors--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.expenses' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.expenses')}}">--}}
{{--                            Expenses--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.bills' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.bills')}}">--}}
{{--                            Bills--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.payments.made' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.payments.made')}}">--}}
{{--                            Payments Made--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.expense.settings' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.expense.settings')}}">--}}
{{--                            Settings--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-money"></i>--}}
{{--                    <span class="nav-label">Accounting </span>--}}
{{--                    <span class="fa arrow"></span>--}}
{{--                    <span class="label label-info pull-right">16</span>--}}
{{--                </a>--}}
{{--                <ul class="nav nav-second-level collapse">--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.chart.of.accounts' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.chart.of.accounts')}}">--}}
{{--                            Chart Of Accounts--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.transactions' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.transactions')}}">--}}
{{--                            Transactions--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.manual.journals' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.manual.journals')}}">--}}
{{--                            Manual Journals--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-folder"></i>--}}
{{--                    <span class="nav-label">Projects </span>--}}
{{--                    <span class="fa arrow"></span>--}}
{{--                    <span class="label label-info pull-right">16</span>--}}
{{--                </a>--}}
{{--                <ul class="nav nav-second-level collapse">--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects.feed' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects.feed')}}">--}}
{{--                            Feed--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">--}}
{{--                            Projects--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </li>--}}

{{--            <li class="nav-item {{ Route::currentRouteNamed( 'business.assets' ) ?  'active' : '' }}">--}}
{{--                <a href="{{ route('business.assets') }}"><i class="fa fa-archive"></i> <span class="nav-label">Assets</span></a>--}}
{{--            </li>--}}

{{--            <li class="nav-item {{ Route::currentRouteNamed( 'business.assets' ) ?  'active' : '' }}">--}}
{{--                <a href="{{ route('business.assets') }}"><i class="fa fa-archive"></i> <span class="nav-label">Investments</span></a>--}}
{{--            </li>--}}
{{--            --}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-users"></i>--}}
{{--                    <span class="nav-label">Human Resource </span>--}}
{{--                    <span class="fa arrow"></span>--}}
{{--                    <span class="label label-info pull-right">16</span>--}}
{{--                </a>--}}
{{--                <ul class="nav nav-second-level collapse">--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.employees' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.employees')}}">--}}
{{--                            Employees--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.leave' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.leave')}}">--}}
{{--                            Leave--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.payroll' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.payroll')}}">--}}
{{--                            Payroll--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.employer' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.employer')}}">--}}
{{--                            Employer--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ Route::currentRouteNamed( 'business.human.resource.settings' ) ?  'active' : '' }}">--}}
{{--                        <a itemprop="url" class="nav-link" href="{{route( 'business.human.resource.settings')}}">--}}
{{--                            Settings--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </li>--}}


            <li>
                <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label">Accounting</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.accounts',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.accounts',$institution->portal)}}">
                            Accounts
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.expenses',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.expenses',$institution->portal)}}">
                            Expenses
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.liabilities',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.liabilities',$institution->portal)}}">
                            Liabilities
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.loans',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.loans',$institution->portal)}}">
                            Loans
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.payments',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.payments',$institution->portal)}}">
                            Payments
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.refunds',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.refunds',$institution->portal)}}">
                            Refunds
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.transactions',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.transactions',$institution->portal)}}">
                            Transactions
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.transfers',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.transfers',$institution->portal)}}">
                            Transfers
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-sliders"></i>
                    <span class="nav-label">Settings</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.campaign.types',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.campaign.types',$institution->portal)}}">
                            Campaign Types
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.contact.types',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.contact.types',$institution->portal)}}">
                            Contact Types
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.frequencies',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.frequencies',$institution->portal)}}">
                            Frequency
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.lead.sources',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.lead.sources',$institution->portal)}}">
                            Lead source
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.titles',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.titles',$institution->portal)}}">
                            Titles
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'business.units',$institution->portal ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.units',$institution->portal)}}">
                            Units
                        </a>
                    </li>
{{--
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.accounts' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.accounts')}}">
                            Accounts
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.opening.balances' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.opening.balances')}}">
                            Opening Balances
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.users.roles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.users.roles')}}">
                            Users & Roles
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.currencies' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.currencies')}}">
                            Currencies
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.taxes' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.taxes')}}">
                            Taxes
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.emails' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.emails')}}">
                            Emails
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.reminders' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.reminders')}}">
                            Reminders
                        </a>
                    </li>  --}}
                </ul>
            </li>

        </ul>

    </div>
</nav>
