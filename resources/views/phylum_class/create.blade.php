@extends('layouts.app', ['title' => __('Phylum class Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Phylum class')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Phylum class Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('phylum_class.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('phylum_class.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Phylum class information') }}</h6>
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
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('phylum') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phylum">{{ __('Phylum:') }}</label>
                                    <select name="phylum" class="form-control form-control-alternative {{ $errors->has('phylum') ? ' is-invalid' : '' }}" value="{{ old('phylum') }}" required>

                                        @foreach($phylums as $phylum)
                                            <option value="{{ $phylum->id }}">{{ $phylum->name }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('phylum'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phylum') }}</strong>
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