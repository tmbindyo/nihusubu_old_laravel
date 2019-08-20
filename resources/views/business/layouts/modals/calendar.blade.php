<div class="modal inmodal" id="calendarRegistration" tabindex="-1" role="dialog" aria-labelledby="categoryRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-calendar modal-icon"></i>
                <h4 class="modal-title">Calender Entry</h4>
                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.calendar.save') }}" autocomplete="off" class="form-horizontal form-label-left">
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


                    <div class="form-group">
                        <label class="font-noraml" for="name">
                            Name <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="name" name="name" required="required" class="form-control input-lg" required="required">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group" id="data_1">
                                <label class="font-noraml">
                                    Due Date  <span class="required">*</span>
                                </label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="date_due" id="date_due" class="form-control input-lg">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="font-noraml">
                                Due Time <span class="required">*</span>
                            </label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" name="time_due" id="time_due" class="form-control input-lg" >
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="font-noraml" for="description">
                            Description <span class="required">*</span>
                        </label>
                        <div class="">
                            <textarea id="description" name="description" required="required" class="form-control input-lg" rows="4"></textarea>
                        </div>
                    </div>



                    <div class="ln_solid"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
