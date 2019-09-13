<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <img alt="image" style="height: 20px;" src="{{ asset('inspinia') }}/img/nihusubu.jpg" />
                </div>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'business.dashboard' ) ?  'active' : '' }}">
                <a href="{{ route('business.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'business.calendar' ) ?  'active' : '' }}">
                <a href="{{ route('business.calendar') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'business.to.dos' ) ?  'active' : '' }}">
                <a href="{{ route('business.to.dos') }}"><i class="fa fa-list"></i> <span class="nav-label">To Do </span></a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span class="nav-label">Products </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.product.groups' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.product.groups')}}">
                            Product Groups
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.products' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.products')}}">
                            Products
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.composite.products' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.composite.products')}}">
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
                    <span class="label label-info pull-right">16</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.inventory.adjustments' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.inventory.adjustments')}}">
                            Inventory Adjustments
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.transfer.orders' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.transfer.orders')}}">
                            Transfer Orders
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.warehouses' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.warehouses')}}">
                            Warehouses
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">Sales </span>
                    <span class="fa arrow"></span>
                    <span class="label label-info pull-right">16</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.clients' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.clients')}}">
                            Clients
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.estimates' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.estimates')}}">
                            Estimates
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.invoices' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.invoices')}}">
                            Invoices
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.orders' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.orders')}}">
                            Orders
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.sales' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.sales')}}">
                            Sales
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.payments.received' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.payments.received')}}">
                            Payments Received
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-dollar"></i>
                    <span class="nav-label">Expenses </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.purchase.orders' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.purchase.orders')}}">
                            Purchase Order
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.vendors' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.vendors')}}">
                            Vendors
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.expenses' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.expenses')}}">
                            Expenses
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.bills' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.bills')}}">
                            Bills
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.payments.made' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.payments.made')}}">
                            Payments Made
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.expense.settings' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.expense.settings')}}">
                            Settings
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span class="nav-label">Accounting </span>
                    <span class="fa arrow"></span>
                    <span class="label label-info pull-right">16</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.purchase.orders' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.purchase.orders')}}">
                            Income
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.purchase.orders' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.purchase.orders')}}">
                            Purchase Order
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span class="nav-label">Projects </span>
                    <span class="fa arrow"></span>
                    <span class="label label-info pull-right">16</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects.feed' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects.feed')}}">
                            Feed
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Projects
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'business.assets' ) ?  'active' : '' }}">
                <a href="{{ route('business.assets') }}"><i class="fa fa-archive"></i> <span class="nav-label">Assets</span></a>
            </li>


            <li>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="nav-label">Human Resource </span>
                    <span class="fa arrow"></span>
                    <span class="label label-info pull-right">16</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.employees' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.employees')}}">
                            Employees
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Leave
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Attendance
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Document Workflow
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Team
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Payroll
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Employer
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.projects' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.projects')}}">
                            Settings
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
                    <li class="nav-item {{ Route::currentRouteNamed( 'business.organization.profile' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'business.organization.profile')}}">
                            Organization Profile
                        </a>
                    </li>
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
                    </li>
                </ul>
            </li>


        </ul>

    </div>
</nav>
