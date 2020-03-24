<div class="modal inmodal" id="albumRegistration" tabindex="-1" role="dialog" aria-labelledby="albumRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">Album Registration</h4>
                <small class="font-bold">Sample Input dummy text of the printing and typesetting industry.</small>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.album.save') }}" autocomplete="off" class="form-horizontal form-label-left">
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

                    <div class="col-md-4">
                        <p>
                            Select2 also supports multi-value select boxes. The select below is declared with the multiple attribute.
                        </p>
                        <select class="select2_demo_2 form-control" multiple="multiple">
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Collection Name</label>
                        <input type="text" id="name" name="name" required="required" placeholder="Collection Name" class="form-control">
                        <i>Give your collection a name</i>
                    </div>


                    <div class="form-group" id="data_1">
                        <label class="font-noraml">Collection Date</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                        </div>
                        <i>What is the date of the event?</i>
                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                    </div>

                    <div class="col-md-4">
                        <p>
                            Select2 also supports multi-value select boxes. The select below is declared with the multiple attribute.
                        </p>
                        <select class="select2_demo_2 form-control" multiple="multiple">
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                        </select>
                        <i>What kind of collection is this? Separate your tags with a comma. e.g. wedding, outdoor, summer</i>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    Tags <span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input id="tags_1" name="tags" type="text" class="tags form-control" />
                                    <i>What kind of collection is this? Separate your tags with a comma. e.g. wedding, outdoor, summer</i>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                    AutoExpiry*
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                                    </div>
                                                    <i>Collection will become Hidden when it reaches 11:59pm on the expiry date.</i>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>
                                        <input name="is_homepage_visible" type="checkbox" class="js-switch" checked /> Homepage Visibility

                                    </label>
                                    <i>Show or hide your collection in your Homepage area.</i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>
                                        <input name="is_auto_expiry" type="checkbox" class="js-switch" checked /> Auto Expiry

                                    </label>
                                    <i>Auto expiry.</i>
                                </div>
                            </div>
                        </div>


                    </div>
                    <br />

                    <div class="ln_solid"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>