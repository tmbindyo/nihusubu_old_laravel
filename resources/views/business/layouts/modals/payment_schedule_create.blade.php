<div class="modal inmodal" id="paymentScheduleRegistration" tabindex="-1" role="dialog" aria-labelledby="tagRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-cogs modal-icon"></i>
                <h4 class="modal-title">Payment Schedule Registration</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('business.payment.schedule.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                <div class="has-warning">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <input type="text" id="name" name="name" required="required" value="{{ old('name') }}" placeholder="Name" class="form-control input-lg">
                                    <i>name</i>
                                </div>
                                <br>
                                <div class="has-warning">
                                    @if ($errors->has('period'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('period') }}</strong>
                                        </span>
                                    @endif
                                    <input type="number" id="period" name="period" required="required" value="{{ old('period') }}" placeholder="Period" class="form-control input-lg">
                                    <i>name</i>
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
