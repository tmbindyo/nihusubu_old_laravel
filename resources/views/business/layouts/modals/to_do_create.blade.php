{{--<div class="modal inmodal" id="toDoRegistration" tabindex="-1" role="dialog" aria-labelledby="toDoRegistrationLabel" aria-hidden="true">--}}
<div class="modal inmodal fade" id="toDoRegistration" tabindex="-1" role="dialog"  aria-hidden="true">
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


                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="has-warning">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <input type="text" id="name" name="name" required="required" placeholder="To Do" class="form-control input-lg {{ $errors->has('name') ? ' is-invalid' : '' }}">
                                <i>task</i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="start_date" id="start_date" class="form-control input-lg {{ $errors->has('start_date') ? ' is-invalid' : '' }}" required>
                                </div>
                                <i>start date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    <input type="text" name="end_date" id="end_date" disabled="disabled" class="form-control input-lg {{ $errors->has('end_date') ? ' is-invalid' : '' }}">
                                </div>
                                <i>end date.</i>
                                <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="has-warning">
                                @if ($errors->has('is_end_date'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_end_date') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="is_end_date" id="is_end_date" type="checkbox" class="enableEndDate {{ $errors->has('is_end_date') ? ' is-invalid' : '' }}" />
                                    <i>end date</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="has-warning">
                                @if ($errors->has('start_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="start_time" data-mask="99:99" id="start_time" class="form-control input-lg {{ $errors->has('start_time') ? ' is-invalid' : '' }}" required>
                                </div>
                                <i>start time.</i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="has-warning" id="data_1">
                                @if ($errors->has('end_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" name="end_time" disabled data-mask="99:99" id="end_time" class="form-control input-lg {{ $errors->has('end_time') ? ' is-invalid' : '' }}" value="09:30">
                                </div>
                                <i>end time.</i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="has-warning">
                                @if ($errors->has('is_end_time'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_end_time') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input name="is_end_time" id="is_end_time" type="checkbox" class="enableEndTime {{ $errors->has('is_end_time') ? ' is-invalid' : '' }}" />
                                    <i>end time.</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="has-warning">
                                @if ($errors->has('notes'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                                <textarea id="notes" rows="5" name="notes" class="resizable_textarea form-control input-lg {{ $errors->has('notes') ? ' is-invalid' : '' }}" required="required" placeholder="Notes..."></textarea>
                            </div>
                        </div>
                    </div>
                    <br>

                    @isset($account)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_account'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_account') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_account" type="checkbox" class="js-switch_2 {{ $errors->has('is_account') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Account.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('account'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                    @endif
                                    <select name="account" data-placeholder="Choose an account..." class="chosen-select form-control input-lg {{ $errors->has('account') ? ' is-invalid' : '' }}">
                                        <option value="{{$account->id}}" selected>{{$account->name}}</option>
                                    </select>
                                    <i>What account does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($campaign)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_campaign'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_campaign') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_campaign" type="checkbox" class="js-switch_2 {{ $errors->has('is_campaign') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a campaign.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('campaign'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('campaign') }}</strong>
                                    </span>
                                    @endif
                                    <select name="campaign" data-placeholder="Choose a campaign..." class="chosen-select form-control input-lg {{ $errors->has('campaign') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        <option value="{{$campaign->id}}" selected>{{$campaign->name}}</option>
                                    </select>
                                        <br>
                                    <i>What campaign does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($contact)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_contact'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_contact') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_contact" type="checkbox" class="js-switch_18 {{ $errors->has('is_contact') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Contact.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                    <select name="contact" data-placeholder="Choose a contact..."  class="chosen-select form-control input-lg {{ $errors->has('contact') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        <option value="{{$contact->id}}" selected>{{$contact->first_name}} {{$contact->last_name}}</option>
                                    </select>
                                    <i>What contact does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($deposit)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_deposit'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_deposit') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_deposit" type="checkbox" class="js-switch_2 {{ $errors->has('is_deposit') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Deposit.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('deposit'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('deposit') }}</strong>
                                    </span>
                                    @endif
                                    <select name="deposit" data-placeholder="Choose a deposit..."  class="chosen-select form-control input-lg {{ $errors->has('deposit') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        <option value="{{$deposit->id}}" selected>{{$deposit->reference}}</option>
                                    </select>
                                    <i>What deposit does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($expense)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_expense'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_expense') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_expense" type="checkbox" class="js-switch_2 {{ $errors->has('is_expense') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Expense.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('expense'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('expense') }}</strong>
                                    </span>
                                    @endif
                                    <select name="expense" data-placeholder="Choose an expense..."  class="chosen-select form-control input-lg {{ $errors->has('expense') ? ' is-invalid' : '' }}">
                                        <option></option>

                                        <option value="{{$expense->id}}" selected>{{$expense->reference}}</option>
                                    </select>
                                    <i>What expense does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($loan)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_loan'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_loan') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_loan" type="checkbox" class="js-switch_2 {{ $errors->has('is_loan') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Loan.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('loan'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('loan') }}</strong>
                                    </span>
                                    @endif
                                    <select name="loan" data-placeholder="Choose a loan..."  class="chosen-select form-control input-lg {{ $errors->has('loan') ? ' is-invalid' : '' }}">
                                        <option></option>

                                        <option value="{{$loan->id}}" selected>{{$loan->reference}}</option>
                                    </select>
                                    <i>What loan does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($organization)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_organization'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_organization') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_organization" type="checkbox" class="js-switch_2 {{ $errors->has('is_organization') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Organization.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('organization'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif
                                    <select name="organization" data-placeholder="Choose an organization..."  class="chosen-select form-control input-lg {{ $errors->has('organization') ? ' is-invalid' : '' }}">
                                        <option></option>
                                        <option value="{{$organization->id}}" selected>{{$organization->name}}</option>
                                    </select>
                                    <i>What organization does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($payment)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_payment'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_payment') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_payment" type="checkbox" class="js-switch_2 {{ $errors->has('is_payment') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Payment.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('payment'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('payment') }}</strong>
                                    </span>
                                    @endif
                                    <select name="payment" data-placeholder="Choose a payment..."  class="chosen-select form-control input-lg {{ $errors->has('payment') ? ' is-invalid' : '' }}">
                                        <option></option>

                                        <option value="{{$payment->id}}" selected>{{$payment->reference}}</option>
                                    </select>
                                    <i>What payment does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($refund)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_refund'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_refund') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_refund" type="checkbox" class="js-switch_2 {{ $errors->has('is_refund') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Refund.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('refund'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('refund') }}</strong>
                                    </span>
                                    @endif
                                    <select name="refund" data-placeholder="Choose a refund..."  class="chosen-select form-control input-lg {{ $errors->has('refund') ? ' is-invalid' : '' }}">
                                        <option></option>

                                        <option value="{{$refund->id}}" selected>{{$refund->reference}}</option>
                                    </select>
                                    <i>What refund does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($transfer)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_transfer'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_transfer') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_transfer" type="checkbox" class="js-switch_2 {{ $errors->has('is_transfer') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Transfer.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('transfer'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('transfer') }}</strong>
                                    </span>
                                    @endif
                                    <select name="transfer" data-placeholder="Choose a transfer..."  class="chosen-select form-control input-lg {{ $errors->has('transfer') ? ' is-invalid' : '' }}">
                                        <option></option>

                                        <option value="{{$transfer->id}}" selected>{{$transfer->reference}}</option>
                                    </select>
                                    <i>What transfer does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset
                    @isset($withdrawal)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="has-warning">
                                    @if ($errors->has('is_withdrawal'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('is_withdrawal') }}</strong>
                                    </span>
                                    @endif
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input name="is_withdrawal" type="checkbox" class="js-switch_2 {{ $errors->has('is_withdrawal') ? ' is-invalid' : '' }}" checked />
                                        <br>
                                        <i>Check if it belongs to a Withdrawal.</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="has-warning">
                                    @if ($errors->has('withdrawal'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('withdrawal') }}</strong>
                                    </span>
                                    @endif
                                    <select name="withdrawal" data-placeholder="Choose a withdrawal..."  class="chosen-select form-control input-lg {{ $errors->has('withdrawal') ? ' is-invalid' : '' }}">
                                        <option></option>

                                        <option value="{{$withdrawal->id}}" selected>{{$withdrawal->reference}}</option>
                                    </select>
                                    <i>What withdrawal does the to do belong to</i>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endisset


                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
