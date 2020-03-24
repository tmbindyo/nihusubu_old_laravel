<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile_small.jpg" />
                             </span>
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
                    N
                </div>
            </li>

            {{--  <li class="nav-item {{ Route::currentRouteNamed( 'personal.dashboard' ) ?  'active' : '' }}">
                <a href="{{ route('personal.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>  --}}

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.calendar' ) ?  'active' : '' }}">
                <a href="{{ route('personal.calendar') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.to.dos' ) ?  'active' : '' }}">
                <a href="{{ route('personal.to.dos') }}"><i class="fa fa-list"></i> <span class="nav-label">To Do </span></a>
            </li>

            <li class="nav-item {{ Route::currentRouteNamed( 'personal.contacts' ) ?  'active' : '' }}">
                <a href="{{ route('personal.contacts') }}"><i class="fa fa-group"></i> <span class="nav-label">Contacts </span></a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span class="nav-label">Budgeting </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.budget' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.budget')}}">
                            Budgeting
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.income' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.income')}}">
                            Income
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ Route::currentRouteNamed( 'personal.chamas' ) ?  'active' : '' }}">
                <a href="{{ route('personal.chamas') }}"><i class="fa fa-sliders"></i> <span class="nav-label">Chamas </span></a>
            </li>

            {{--  <li>
                <a href="#">
                    <i class="fa fa-sliders"></i>
                    <span class="nav-label">Chama</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.chamas' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.chamas')}}">
                            Chamas
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Accounts
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Goals
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Loans
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Meetings
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Members
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Merry Go Round
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Penalties
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Shares
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Soft Loans
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Welfare
                        </a>
                    </li>
                </ul>
            </li>  --}}

            {{--  <li>
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
            </li>  --}}

            {{--  <li>
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
            </li>  --}}

            <li>
                <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label">Accounting</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.accounts' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.accounts')}}">
                            Accounts
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.expenses' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.expenses')}}">
                            Expenses
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.liabilities' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.liabilities')}}">
                            Liabilities
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.loans' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.loans')}}">
                            Loans
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.payments' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.payments')}}">
                            Payments
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.refunds' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.refunds')}}">
                            Refunds
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.transactions' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.transactions')}}">
                            Transactions
                        </a>
                    </li>

                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.transfers' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.transfers')}}">
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
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.contact.types' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.contact.types')}}">
                            Contact Types
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.expense.accounts' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.expense.accounts')}}">
                            Expense Accounts
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.frequencies' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.frequencies')}}">
                            Frequency
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed( 'personal.titles' ) ?  'active' : '' }}">
                        <a itemprop="url" class="nav-link" href="{{route( 'personal.titles')}}">
                            Titles
                        </a>
                    </li>
                </ul>
            </li>


        </ul>

    </div>
</nav>
