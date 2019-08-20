<div class="modal inmodal" id="albumTypeRegistration" tabindex="-1" role="dialog" aria-labelledby="albumTypeRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">Album Type Registration</h4>
                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.album.type.save') }}" autocomplete="off" class="form-horizontal form-label-left">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                            Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea id="description" name="description" class="resizable_textarea form-control" required="required" placeholder="Description..."></textarea>
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