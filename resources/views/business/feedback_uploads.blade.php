@extends('business.layouts.app')

@section('title', 'Feedback Uploads')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Feedback's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    CRM
                </li>
                <li class="active">
                    <a href="{{route('business.feedbacks',$institution->portal)}}">Feedbacks</a>
                </li>
                <li class="active">
                    <a href="{{route('business.feedback.show',['portal'=>$institution->portal,'id'=>$feedback->id])}}">Feedback</a>
                </li>
                <li class="active">
                    <strong>Feedback Create</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">

        {{--  Upload form  --}}
        <div class="row">
            <div class="ibox float-e-margins">
                <div class="tab-content">
                    <div class="panel-body">
                        <form id="my-awesome-dropzone" class="dropzone" action="{{route('business.feedback.upload.store',['portal'=>$institution->portal,'id'=>$feedback->id])}}">
                            @csrf
                            <div class="dropzone-previews"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--  Uploads  --}}
        <div class="row">
            <div class="col-lg-12 animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">

                        @foreach ($feedback->feedback_uploads as $upload)
                        <div class="file-box">
                            <a href="#">
                                <div class="file">
                                    <span class="corner"></span>
                                    <div class="icon">
                                        @if($upload->file_type == "image")
                                            <img alt="image" class="img-responsive" src="{{ asset('') }}{{ $upload->original }}">
                                        @elseif($upload->file_type == "document")
                                            <i class="fa fa-bar-chart-o"></i>
                                        @elseif($upload->file_type == "video")
                                            <i class="img-responsive fa fa-film"></i>
                                        @elseif($upload->file_type == "audio")
                                            <i class="fa fa-music"></i>
                                        @elseif($upload->file_type == "pdf")
                                            <i class="fa fa-file"></i>
                                        @elseif($upload->file_type == "unknown")
                                            <i class="fa fa-file"></i>
                                        @endif
                                    </div>
                                    <div class="file-name">
                                        {{$upload->name}}
                                        <br/>
                                        <small>Added: {{$upload->created_at}}</small>
                                        <a href="{{route('business.feedback.upload.download',['portal'=>$institution->portal, 'id'=>$upload->id])}}" class="btn btn-xs btn-primary btn-block">Download</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('js')

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- DROPZONE -->
    <script src="{{ asset('inspinia') }}/js/plugins/dropzone/dropzone.js"></script>
    <script>
        $(document).ready(function(){
            $('.file-box').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            Dropzone.options.dropzone =
                {
                    maxFilesize: 12,
                    renameFile: function(file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        return time+file.name;
                    },
                    addRemoveLinks: true,
                    timeout: 50000,
                    removedfile: function(file)
                    {
                        var name = file.upload.filename;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{ url("image/delete") }}',
                            data: {filename: name},
                            success: function (data){
                                console.log("File has been successfully removed!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    },

                    success: function(file, response)
                    {
                        console.log(response);
                    },
                    error: function(file, response)
                    {
                        return false;
                    }
                };
        });
    </script>

@endsection
