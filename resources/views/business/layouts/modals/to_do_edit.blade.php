<div class="modal inmodal" id="toDoEdit" tabindex="-1" role="dialog" aria-labelledby="toDoEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-list modal-icon"></i>
                <h4 class="modal-title">Edit To-Do</h4>
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
                        <div class="col-md-7">
                            <div class="form-group">
                                <div class="has-warning">
                                    <input type="text" id="edit-task" name="edittask" required="required" placeholder="Task" class="form-control input-lg">
                                    <i>task</i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-1">
                            <div class="form-group" id="data_1">
                                <div class="has-warning">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" name="edit-due_date" id="edit-due_date" class="form-control input-lg" required>
                                    </div>
                                    <i> due date.</i>
                                    <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="has-warning">
                                    <textarea id="edit-notes" rows="5" name="edit-notes" class="resizable_textarea form-control input-lg" required="required" placeholder="Notes..."></textarea>
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
