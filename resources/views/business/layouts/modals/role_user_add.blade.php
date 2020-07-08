<div class="modal inmodal" id="userRegistration" tabindex="-1" role="dialog" aria-labelledby="tagRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user modal-icon"></i>
                <h4 class="modal-title">User Registration</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('business.user.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                <select name="user" class="select2_user form-control input-lg">
                                    <option></option>
                                    @foreach ($pendingUsers as $user)
                                        <option value="{{encrypt($user->id)}}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                                <i>type</i>
                            </div>
                        </div>
                    </div>
                    <br>

                    <hr>

                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-outline btn-lg btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
