<div class="modal inmodal" id="manualJournalRegistration" tabindex="-1" role="dialog" aria-labelledby="manualJournalRegistration" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-money modal-icon"></i>
                <h4 class="modal-title">Manual Journal Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.manual.journal.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" id="name" name="name" required="required" placeholder="Warehouse Name" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" name="location" id="location" class="form-control input-lg" placeholder="Warehouse Location">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <input type="text" id="street" name="street" required="required" placeholder="Warehouse Street" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="has-warning">
                                <input type="text" name="city" id="city" class="form-control input-lg" placeholder="Warehouse City">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <input type="text" id="email" name="email" required="required" placeholder="Warehouse Email" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <input type="text" name="phone_number" id="phone_number" class="form-control input-lg" placeholder="Warehouse Phone number">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="ln_solid"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
