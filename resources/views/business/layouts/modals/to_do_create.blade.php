<div class="modal inmodal" id="toDoRegistration" tabindex="-1" role="dialog" aria-labelledby="toDoRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-list modal-icon"></i>
                <h4 class="modal-title">To-Do Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.to.do.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                            <div class="form-group">
                                <div class="has-warning">
                                    <input type="text" id="name" name="name" required="required" placeholder="To Do" class="form-control input-lg">
                                    <i>task</i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="has-warning">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="is_end_date" type="checkbox" class="js-switch_18" />
                                    <br>
                                    <i>Check if it takes a couple of days.</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="start_date" id="start_date" class="form-control input-lg" required>
                                </div>
                                <i>start date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="end_date" id="end_date" class="form-control input-lg">
                                </div>
                                <i>end date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="has-warning">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="is_end_time" type="checkbox" class="js-switch_19" />
                                    <br>
                                    <i>Check if it takes a time period.</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" name="start_time" id="start_time" class="form-control input-lg" required>
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                </div>
                                <i>start time.</i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" name="end_time" id="end_time" class="form-control input-lg" value="09:30">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                </div>
                                <i>end time.</i>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="has-warning">
                                    <textarea id="notes" rows="5" name="notes" class="resizable_textarea form-control input-lg" required="required" placeholder="Notes..."></textarea>
                                </div>
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
