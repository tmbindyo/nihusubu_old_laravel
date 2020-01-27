<div class="modal inmodal" id="productDiscountEdit" tabindex="-1" role="dialog" aria-labelledby="productDiscountEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-list modal-icon"></i>
                <h4 class="modal-title">Product Discount Edit</h4>
{{--                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>--}}
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.product.discount.update',['portal'=>$institution->portal,'id'=>$product->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                            <div class="form-group" id="data_1">
                                <div class="has-warning">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" name="start_date" id="start_date" class="form-control input-lg" required>
                                    </div>
                                    <i> start date.</i>
                                    <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="data_1">
                                <div class="has-warning">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" name="end_date" id="end_date" class="form-control input-lg" required>
                                    </div>
                                    <i> end date.</i>
                                    <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="has-warning">
                                    <input type="integer" name="quantity" id="quantity" placeholder="Quantity" class="form-control input-lg" required>
                                </div>
                                <i> Quantity of discount.</i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="has-warning">
                                    <input type="text" name="discount" id="discount" placeholder="1,000" class="form-control input-lg" required>
                                </div>
                                <i> Minimum items.</i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="has-warning">
                                    <input type="text" name="discount" id="discount" placeholder="1,000" class="form-control input-lg" required>
                                </div>
                                <i> Discount value.</i>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="checkbox checkbox-info">
                            <input id="is_created" name="is_created" type="checkbox">
                            <label for="is_created">
                                Percentage?
                            </label>
                            <span><i data-toggle="tooltip" data-placement="right" title="Check this option if the discount is a percentage of the value." class="fa fa-2x fa-question-circle"></i></span>
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
