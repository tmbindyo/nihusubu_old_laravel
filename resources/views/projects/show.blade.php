@extends('layouts.app', ['title' => __('Project Details')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Project')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Project Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if (Auth::user()->user_type_id == 4)
                                    <a href="{{ route('project.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.update', $project) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Project information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $project->name) }}" required autofocus readonly>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description', $project->description) }}" required autofocus readonly>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('total_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total_budget">{{ __('Total budget') }}</label>
                                    <input type="text" name="total_budget" id="input-total_budget" class="form-control form-control-alternative{{ $errors->has('total_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Total budget') }}" value="{{ old('total_budget', $project->total_budget) }}" required autofocus readonly>

                                    @if ($errors->has('total_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('used_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-used_budget">{{ __('Used budget') }}</label>
                                    <input type="text" name="used_budget" id="input-used_budget" class="form-control form-control-alternative{{ $errors->has('used_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Used budget') }}" value="{{ old('used_budget', $project->used_budget) }}" required autofocus readonly>

                                    @if ($errors->has('used_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('used_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('remaining_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-remaining_budget">{{ __('Remaining budget') }}</label>
                                    <input type="text" name="remaining_budget" id="input-remaining_budget" class="form-control form-control-alternative{{ $errors->has('remaining_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Remaining budget') }}" value="{{ old('remaining_budget', $project->remaining_budget) }}" required autofocus readonly>

                                    @if ($errors->has('remaining_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('remaining_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('contributed_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-contributed_budget">{{ __('Contributed budget') }}</label>
                                    <input type="text" name="contributed_budget" id="input-contributed_budget" class="form-control form-control-alternative{{ $errors->has('contributed_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Contributed budget') }}" value="{{ old('contributed_budget', $project->contributed_budget) }}" required autofocus readonly>

                                    @if ($errors->has('contributed_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contributed_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    {{-- <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button> --}}
                                    @if (Auth::user()->user_type_id == 4)
                                        <a class="btn btn-success mt-4" href="{{ route('project.show', $project->id ) }}">{{ __('Edit') }}</a>
                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            
        </div>
        <br>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Project task') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    @if (Auth::user()->user_type_id == 4)
                                        <a href="{{ route('project.project_task.create', [$project->id] ) }}" class="btn btn-sm btn-primary">{{ __('Create project tasks') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('project.project_task.update', [$project->id,'1']) }}" autocomplete="off">
                                @csrf
                                @method('put')
    
                                <h6 class="heading-small text-muted mb-4">{{ __('Project task') }}</h6>
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
                                                        <th scope="col">{{ __('Priority') }}</th>
                                                        <th scope="col">{{ __('Start date') }}</th>
                                                        <th scope="col">{{ __('End date') }}</th>
                                                        <th scope="col">{{ __('Amount') }}</th>
                                                        <th scope="col">{{ __('Creation Date') }}</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($projectTasks as $projectTask)
                                                    
                                                        <tr>
                                                            <td>{{ $projectTask->name }}</td>
                                                            <td>{{ $projectTask->priority }}</td>
                                                            <td>{{ $projectTask->start_date }}</td>
                                                            <td>{{ $projectTask->end_date }}</td>
                                                            <td>{{ $projectTask->total_budget }}</td>
                                                            <td>{{ $projectTask->created_at }}</td>
                                                            @if (Auth::user()->user_type_id == 4)
                                                            <td class="text-right">
                                                                <div class="dropdown">
                                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                        @if ($project->id != auth()->id())
                                                                            <form action="{{ route('project.project_task.destroy', [$project->id,$projectTask->id]) }}" method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                
                                                                                <a class="dropdown-item" href="{{ route('project.project_task.edit', [$project->id, $projectTask->id]) }}">{{ __('Edit') }}</a>
                                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this project?") }}') ? this.parentElement.submit() : ''">
                                                                                    {{ __('Delete') }}
                                                                                </button>
                                                                                <a class="dropdown-item" href="{{ route('project.project_task.show', [$project->id, $projectTask->id]) }}">{{ __('Edit') }}</a>
                                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this project?") }}') ? this.parentElement.submit() : ''">
                                                                                    {{ __('Delete') }}
                                                                                </button>
                                                                            </form>    
                                                                        @else
                                                                            <a class="dropdown-item" href="{{ route('project.project_task.edit', [$project->id, $projectTask->id] ) }}">{{ __('Edit') }}</a>
                                                                            <a class="dropdown-item" href="{{ route('project.project_task.show', [$project->id, $projectTask->id] ) }}">{{ __('Show') }}</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @endif
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
        <br>
        <div class="row">
            <div class="col-xl-6 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Project bids') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    @if (Auth::user()->user_type_id == 3)
                                        <a href="{{ route('project.project_bid.create', $project->id ) }}" class="btn btn-sm btn-primary">{{ __('Create project bids') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('project.project_bid.update', [$project->id,'1']) }}" autocomplete="off">
                                @csrf
                                @method('put')
    
                                <h6 class="heading-small text-muted mb-4">{{ __('Project bids') }}</h6>
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
                                                    @foreach ($projectBids as $projectBid)
                                                        <tr>
                                                            <td>{{ Auth::user()->name }}</td>
                                                            <td>{{ $projectBid->bid_amount }}</td>
                                                            <td>{{ $projectBid->created_at }}</td>
                                                            @if (Auth::user()->user_type_id == 4)
                                                            <td class="text-right">
                                                                <div class="dropdown">
                                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                        @if (Auth::user()->user_type_id == 3)
                                                                            <a class="dropdown-item" href="{{ route('project.project_bid.edit', [$project->id,$projectBid->id]) }}">{{ __('Edit') }}</a>
                                                                        @endif
                                                                        @if (Auth::user()->user_type_id == 4)

                                                                            <a class="dropdown-item" href="{{ route('project.bid', [$project->id,$projectBid->id]) }}">{{ __('Approve') }}</a>  
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @endif
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
                                {{-- @if (Auth::user()->user_type_id == 4)
                                    <a href="{{ route('project.project_investment.create', $project->id ) }}" class="btn btn-sm btn-primary">{{ __('Create project investment') }}</a>
                                @endif --}}
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
                                                        @if (Auth::user()->user_type_id == 4)
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
                                                        @endif
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