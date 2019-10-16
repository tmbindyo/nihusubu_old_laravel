<div class="modal inmodal" id="toDoRegistration" tabindex="-1" role="dialog" aria-labelledby="toDoRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-list modal-icon"></i>
                <h4 class="modal-title">To Do Registration</h4>
{{--                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>--}}
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('personal.to.do.store') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name" name="name" required="required" placeholder="To Do Name" class="form-control input-lg">
                                <i>Give your to do a name</i>
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-1">
                            <div class="form-group" id="data_1">
                                <label>Due Date</label>
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="due_date" id="date_due" class="form-control input-lg">
                                </div>
                                <i> due date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Notes
                                </label>
                                <textarea id="notes" rows="6" name="notes" class="resizable_textarea form-control input-lg" required="required" placeholder="Notes..."></textarea>
                            </div>
                        </div>
                    </div>

{{--  TODO figure out how to tie it to things like orders and clients  --}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="">Is Album</label>--}}
{{--                                <div class="col-md-12 col-sm-12 col-xs-12">--}}
{{--                                    <input name="is_album" type="checkbox" class="js-switch_3" checked />--}}
{{--                                    <i>Check if it belongs to Album.</i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Album <span class="required">*</span>--}}
{{--                                </label>--}}
{{--                                <select name="album" class="select2_demo_2 form-control input-lg">--}}
{{--                                    <option>Select Album</option>--}}
{{--                                    @foreach($albums as $album)--}}
{{--                                        <option value="{{$album->id}}">{{$album->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <i>What album does the to do belong to</i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}






                    <div class="ln_solid"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
