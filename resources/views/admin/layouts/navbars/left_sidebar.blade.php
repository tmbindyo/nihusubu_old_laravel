<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="">
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.dashboard' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.dashboard' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.dashboard')}}">
                            Client Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.design.dashboard' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.design.dashboard')}}">
                            Design Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.project.dashboard' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.project.dashboard')}}">
                            Project Dashboard
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.album.dashboard' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.album.dashboard')}}">
                            Album Dashboard
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item {{ Route::currentRouteNamed( 'admin.calendar' ) ?  'active' : '' }}">
                <a href="{{ route('admin.calendar') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.album.types' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.album.types')}}">
                            Album Types
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.tags' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.tags')}}">
                            Tags
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.categories' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.categories')}}">
                            Categories
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Client </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.settings' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.settings')}}">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.albums' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.albums')}}">
                            Albums
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-image"></i> <span class="nav-label">Personal </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.settings' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.settings')}}">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.albums' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.albums')}}">
                            Albums
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-pencil"></i> <span class="nav-label">Design </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.settings' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.settings')}}">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.albums' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.albums')}}">
                            Albums
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-folder-o"></i> <span class="nav-label">Project </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.settings' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.settings')}}">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.albums' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.albums')}}">
                            Albums
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">DIY Store </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.settings' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.settings')}}">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'admin.client.albums' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'admin.client.albums')}}">
                            Albums
                        </a>
                    </li>
                </ul>
            </li>




        </ul>

    </div>
</nav>