<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    {{-- <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a> --}}
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        {{-- <i class="fas fa-heart" ></i> --}}
                        <i class="far fa-address-card" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('User management') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('institution.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Institution') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('age_cluster.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Age cluster') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('agriculture_type.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Agriculture type') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('farm_size.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Farm size') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('family_size.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Family size') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sand_type.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Sand type') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fertility_type.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Fertility type') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fertility.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Fertility') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('topography.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Topography') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gender.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Gender') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('farm.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Farm') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('domain.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Domain') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kingdom.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Kingdom') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('phylum.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Phylum') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('phylum_class.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Phylum class') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Order') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('family.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Family') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('genus.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Genus') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('species.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Species') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('disease.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Diseases') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('causes.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Causes') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('symptom.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Symptoms') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('spread.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Spread') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('management.index') }}">
                        <i class="fas fa-landmark" style="color: #f4645f;"></i> {{ __('Management') }}
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>


