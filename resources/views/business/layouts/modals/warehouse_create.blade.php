<div class="modal inmodal" id="warehouseRegistration" tabindex="-1" role="dialog" aria-labelledby="warehouseRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-building modal-icon"></i>
                <h4 class="modal-title">Warehouse Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.warehouse.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                        <div class="col-md-12">
                            <div class="has-warning">
                                <input type="text" id="name" name="name" required="required" placeholder="Name" class="form-control input-lg">
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <input type="text" id="street" name="street" required="required" placeholder="Street" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <input type="text" name="town" id="town" class="form-control input-lg" placeholder="Town">
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <input type="text" id="po_box" name="po_box" required="required" placeholder="P.O. Box" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <input type="text" name="postal_code" id="postal_code" class="form-control input-lg" placeholder="Postal Code">
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <input type="text" id="address_line_1" name="address_line_1" required="required" placeholder="Address Line 1" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <input type="text" name="address_line_2" id="address_line_2" class="form-control input-lg" placeholder="Address Line 2">
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <input type="text" id="email" name="email" required="required" placeholder="Email" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="">
                                <input type="text" name="phone_number" id="phone_number" class="form-control input-lg" placeholder="Phone number">
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
