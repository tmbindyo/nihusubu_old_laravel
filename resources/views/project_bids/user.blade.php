@extends('layouts.app', ['title' => __('User bids Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <br>
        <div class="row">
            <div class="col-xl-6 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('User bids') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('project.index') }}" autocomplete="off">
                                @csrf
                                @method('put')
    
                                <h6 class="heading-small text-muted mb-4">{{ __('User bids') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="col-12">
                                            @if (session('status'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('status') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                    
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">{{ __('Name') }}</th>
                                                        <th scope="col">{{ __('Amount') }}</th>
                                                        <th scope="col">{{ __('Creation Date') }}</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($userBids as $userBid)
                                                        <tr>
                                                            <td>{{ Auth::user()->name }}</td>
                                                            <td>{{ $userBid->bid_amount }}</td>
                                                            <td>{{ $userBid->created_at }}</td>
                                                            <td class="text-right">
                                                                <div class="dropdown">
                                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                        @if ($project->id != auth()->id())
                                                                            <form action="{{ route('project.project_bid.destroy', [$project->id,$projectBid->id]) }}" method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                
                                                                                <a class="dropdown-item" href="{{ route('project.project_bid.edit', [$project->id,$projectBid->id]) }}">{{ __('Edit') }}</a>
                                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this project?") }}') ? this.parentElement.submit() : ''">
                                                                                    {{ __('Delete') }}
                                                                                </button>
                                                                            </form>    
                                                                        @else
                                                                            <a class="dropdown-item" href="{{ route('project.project_bid.edit', [$project->id,$projectBid->id] ) }}">{{ __('Edit') }}</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- <div class="card-footer py-4">
                                            <nav class="d-flex justify-content-end" aria-label="...">
                                                {{ $projects->links() }}
                                            </nav>
                                        </div> --}}
    
    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <div class="col-xl-6 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Project investment') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('project.project_investment.create', $project->id ) }}" class="btn btn-sm btn-primary">{{ __('Create project investment') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.project_investment.update', [$project->id,'1']) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Project investment') }}</h6>
                            <div class="pl-lg-4">
                                <div class="col-12">
                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">{{ __('Amount') }}</th>
                                                    <th scope="col">{{ __('Investor') }}</th>
                                                    <th scope="col">{{ __('Creation Date') }}</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($projectInvestments as $projectInvestment)
                                                    <tr>
                                                        <td>{{ $projectInvestment->amount }}</td>
                                                        <td>{{ Auth::user()->name }}</td>
                                                        <td>{{ $projectInvestment->created_at }}</td>
                                                        <td class="text-right">
                                                            <div class="dropdown">
                                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    @if ($project->id != auth()->id())
                                                                        <form action="{{ route('project.project_investment.destroy', [$project->id,$projectInvestment->id]) }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            
                                                                            <a class="dropdown-item" href="{{ route('project.project_investment.edit', [$project->id,$projectInvestment->id]) }}">{{ __('Edit') }}</a>
                                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this project?") }}') ? this.parentElement.submit() : ''">
                                                                                {{ __('Delete') }}
                                                                            </button>
                                                                        </form>    
                                                                    @else
                                                                        <a class="dropdown-item" href="{{ route('project.project_investment.edit', [$project->id,$projectInvestment->id] ) }}">{{ __('Edit') }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="card-footer py-4">
                                        <nav class="d-flex justify-content-end" aria-label="...">
                                            {{ $projects->links() }}
                                        </nav>
                                    </div> --}}


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection