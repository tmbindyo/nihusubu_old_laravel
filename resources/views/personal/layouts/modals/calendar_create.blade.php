<div class="modal inmodal" id="calendarRegistration" tabindex="-1" role="dialog" aria-labelledby="calendarRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-calendar modal-icon"></i>
                <h4 class="modal-title">Calender Entry</h4>
{{--                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>--}}
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('personal.calendar.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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

                    {{--  name  --}}
                    <div class="form-group">
                        <div class="has-warning">
                            <input type="text" id="name" name="name" required="required" class="form-control input-lg" placeholder="Name">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        {{--  due date  --}}
                        <div class="col-md-7">
                            <div class="has-warning">
                                <div class="form-group" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" name="date_due" id="date_due" class="form-control input-lg">
                                    </div>
                                    <i>due date</i>
                                </div>
                            </div>
                        </div>
                        {{--  time  --}}
                        <div class="col-md-5">
                            <div class="has-warning">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" name="time_due" id="time_due" class="form-control input-lg" >
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <i>Time</i>
                            </div>
                        </div>
                    </div>


                    <br>
                    {{--  description  --}}
                    <div class="form-group">
                        <div class="has-warning">
                            <textarea id="description" name="description" required="required" class="form-control input-lg" rows="5" placeholder="Description"></textarea>
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
