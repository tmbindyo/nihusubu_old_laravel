<div class="modal inmodal" id="productImageUpload" tabindex="-1" role="dialog" aria-labelledby="productImageUploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-image modal-icon"></i>
                <h4 class="modal-title">Product Image Upload</h4>
{{--                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>--}}
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('business.product.image.upload',$product->id) }}" id="my-awesome-dropzone" class="dropzone" enctype="multipart/form-data">
                    @csrf
                    <div class="dropzone-previews"></div>
                </form>

            </div>
        </div>
    </div>
</div>
