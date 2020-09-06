

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

            @can('admin view dashboard')
                <li class="nav-item {{ Route::currentRouteNamed( 'admin.dashboard' ) ?  'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>
            @endcan
            @can('admin view institutions')
                <li class="nav-item {{ Route::currentRouteNamed( 'admin.institutions' ) ?  'active' : '' }}">
                    <a href="{{ route('admin.institutions') }}"><i class="fa fa-institution"></i> <span class="nav-label">Institutions</span></a>
                </li>
            @endcan
            @can('admin view modules')
                <li class="nav-item {{ Route::currentRouteNamed( 'admin.modules' ) ?  'active' : '' }}">
                    <a href="{{ route('admin.modules') }}"><i class="fa fa-desktop"></i> <span class="nav-label">Modules</span></a>
                </li>
            @endcan
            @can('admin view nihusubu payments')
                <li class="nav-item {{ Route::currentRouteNamed( 'admin.payments' ) ?  'active' : '' }}">
                    <a href="{{ route('admin.payments') }}"><i class="fa fa-credit-card"></i> <span class="nav-label">Payments</span></a>
                </li>
            @endcan
            @can('admin view users')
                <li class="nav-item {{ Route::currentRouteNamed( 'admin.users' ) ?  'active' : '' }}">
                    <a href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
                </li>
            @endcan
            @can('admin view roles')
                <li class="nav-item {{ Route::currentRouteNamed( 'admin.roles' ) ?  'active' : '' }}">
                    <a href="{{ route('admin.roles') }}"><i class="fa fa-list-alt"></i> <span class="nav-label">Roles</span></a>
                </li>
            @endcan


        </ul>

    </div>
</nav>
