<div class="modal inmodal" id="paymentRegistration" tabindex="-1" role="dialog" aria-labelledby="paymentRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-dollar-sign modal-icon"></i>
                <h4 class="modal-title">Payment Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.sale.record.payment',$sale->id) }}" autocomplete="off" class="form-horizontal form-label-left">
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

                    <div class="row">
                        <div class="">
                            <div class="has-warning">
                                <input type="number" name="amount" required="required" placeholder="Amount" class="form-control input-lg">
                                <i>amount paid</i>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
