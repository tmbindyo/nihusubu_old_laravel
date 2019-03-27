@extends('layouts.app', ['title' => __('Project bid Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Project bid')])   

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
                                <a href="{{ route('project.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.project_bid.update', [$project->id, $projectBid]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Project bid information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('bid_amount') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-bid_amount">{{ __('Bid amount') }}</label>
                                        <input type="text" name="bid_amount" id="input-bid_amount" class="form-control form-control-alternative{{ $errors->has('bid_amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Bid amount') }}" value="{{ old('bid_amount', $projectBid->bid_amount) }}" required>
    
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