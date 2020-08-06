<div class="modal inmodal" id="taxRegistration" tabindex="-1" role="dialog" aria-labelledby="tagRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-cogs modal-icon"></i>
                <h4 class="modal-title">Tax Registration</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('business.tax.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <br>
                                {{--  Product returnable  --}}
                                @if ($errors->has('is_percentage'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('is_percentage') }}</strong>
                                        </span>
                                @endif
                                <div class="checkbox">
                                    <input id="is_percentage" name="is_percentage" type="checkbox">
                                    <label for="is_percentage">
                                        percentage
                                    </label>
                                    <span><i data-toggle="tooltip" data-placement="right" title="Enable this option if the tax charged is a percentage of the price." class="fa fa-2x fa-question-circle"></i></span>
                                </div>
                                <br>
                                <div class="has-warning">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                    <input type="text" id="name" name="name" required placeholder="Name" value="{{ old('name') }}" class="form-control input-lg">
                                    <i>name</i>
                                </div>
                                <br>
                                <div class="has-warning">
                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                    @endif
                                    <input type="number" name="amount" class="select form-control input-lg" value="{{ old('amount') }}" placeholder="Amount" required>
                                    <i>amount</i>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
