@extends('layouts.app', ['title' => __('Project investment Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Project investment')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Project investment Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('project.project_investment.index', $project->id) }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.project_investment.store', $project->id) }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Project investment information') }}</h6>
                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('user') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-user">{{ __('Investor:') }}</label>
                                    <select name="user" class="form-control form-control-alternative {{ $errors->has('user') ? ' is-invalid' : '' }}" value="{{ old('user') }}" required>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('user'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                    @endif
                                </div> 

                                
                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{ __('Investment Amount') }}</label>
                                    <input type="number" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Bid Amount') }}" value="{{ old('description') }}" required>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
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