@extends('layouts.app', ['title' => __('Project bid Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Project bid')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Project bid Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('project.project_bid.index', $project->id) }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.project_bid.store', $project->id) }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Project bid information') }}</h6>
                            <div class="pl-lg-4">
                                
                                <div class="form-group{{ $errors->has('remaining_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-remaining_budget">{{ __('Total budget') }}</label>
                                    <input type="text" name="remaining_budget" id="input-remaining_budget" class="form-control form-control-alternative{{ $errors->has('remaining_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Total budget') }}" value="{{ $project->total_budget }}" required autofocus readonly>

                                    @if ($errors->has('remaining_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('remaining_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('contributed_budget') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-contributed_budget">{{ __('Remaining budget') }}</label>
                                    <input type="text" name="contributed_budget" id="input-contributed_budget" class="form-control form-control-alternative{{ $errors->has('contributed_budget') ? ' is-invalid' : '' }}" placeholder="{{ __('Remaining budget') }}" value="{{ $project->contributed_budget }}" required autofocus readonly>

                                    @if ($errors->has('contributed_budget'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contributed_budget') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('return_rate') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-return_rate">{{ __('Return rate') }}</label>
                                        <input type="text" name="return_rate" id="input-return_rate" class="form-control form-control-alternative{{ $errors->has('return_rate') ? ' is-invalid' : '' }}" placeholder="{{ __('Return rate') }}" value="{{ $project->return_rate }}" required autofocus readonly>
    
                                        @if ($errors->has('return_rate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('return_rate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                                <div class="form-group{{ $errors->has('bid_amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-bid_amount">{{ __('Bid Amount') }}</label>
                                    <input type="number" name="bid_amount" id="input-bid_amount" class="form-control form-control-alternative{{ $errors->has('bid_amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Bid Amount') }}" value="{{ old('description') }}" required>

                                    @if ($errors->has('bid_amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bid_amount') }}</strong>
                                        </span>
                                    @endif
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