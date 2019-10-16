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
                        <li><a href="{{route('personal.profile')}}">Profile</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.dashboard' ) ?  'active' : '' }}">
                <a href="{{ route('personal.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.calendar' ) ?  'active' : '' }}">
                <a href="{{ route('personal.calendar') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.to.dos' ) ?  'active' : '' }}">
                <a href="{{ route('personal.to.dos') }}"><i class="fa fa-list"></i> <span class="nav-label">To Do </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.income' ) ?  'active' : '' }}">
                <a href="{{ route('personal.income') }}"><i class="fa fa-money"></i> <span class="nav-label">Income </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.budget' ) ?  'active' : '' }}">
                <a href="{{ route('personal.budget') }}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Budgeting</span></a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-dollar"></i>
                    <span class="nav-label">Expenses </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.expenses' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.expenses')}}">
                            Expenses
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.bills' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.bills')}}">
                            Bills
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.assets' ) ?  'active' : '' }}">
                <a href="{{ route('personal.assets') }}"><i class="fa fa-archive"></i> <span class="nav-label">Assets</span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.saccos' ) ?  'active' : '' }}">
                <a href="{{ route('personal.saccos') }}"><i class="fa fa-database"></i> <span class="nav-label">SACCO</span></a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="nav-label">Growth </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.investments' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.investments')}}">
                            Investments
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.goals' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.goals')}}">
                            Goals
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.ways.to.save' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.ways.to.save')}}">
                            Ways to save
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-area-chart"></i>
                    <span class="nav-label">Trends </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.analysis' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.analysis')}}">
                            Analysis
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.cash.flow' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.cash.flow')}}">
                            Cash Flow
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.accounts' ) ?  'active' : '' }}">
                <a href="{{ route('personal.accounts') }}"><i class="fa fa-credit-card"></i> <span class="nav-label">Accounts</span></a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-sliders"></i>
                    <span class="nav-label">Settings</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.commitments' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.commitments')}}">
                            Commitments
                        </a>
                    </li>
                </ul>
            </li>


        </ul>

    </div>
</nav>
