@extends('layouts.app', ['title' => __('Project task Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Project task')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Project task Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('project.project_task.index', $project->id) }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.project_task.store', $project->id) }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Project task information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('priority') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-priority">{{ __('Priority') }}</label>
                                        <input type="number" name="priority" id="input-priority" class="form-control form-control-alternative{{ $errors->has('priority') ? ' is-invalid' : '' }}" placeholder="{{ __('Priority') }}" value="{{ old('priority') }}" required autofocus>
    
                                        @if ($errors->has('priority'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('priority') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('total_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total_budget">{{ __('Total budget') }}</label>
                                    <input type="number" name="total_budget" id="input-total_budget" class="form-control form-control-alternative{{ $errors->has('total_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Total budget') }}" value="{{ old('description') }}" required>

                                    @if ($errors->has('total_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-daterange datepicker row align-items-center">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-description">{{ __('Start date') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input class="form-control" name="start_date" placeholder="Start date" type="text" value="06/18/2018">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                    <label class="form-control-label" for="input-description">{{ __('End date') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input class="form-control" name="end_date" placeholder="End date" type="text" value="06/22/2018">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection