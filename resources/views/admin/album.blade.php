@extends('admin.layouts.app')

@section('title', $album->name.' Album')

@section('css')
    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/dropzone/dropzone.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

@endsection


@section('content')

    <div class="wrapper wrapper-content animated fadeIn">


            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-3"> <i class="fa fa-image"> Album Sets</i></a></li>
                            @foreach($albumSets as $albumSet)
                                <li class=""><a data-toggle="tab" href="#{{$albumSet->id}}"><i class="fa fa-desktop">{{$albumSet->name}}</i></a></li>
                            @endforeach
                            <li class=""><a  data-toggle="modal" data-target="#albumSetRegistration" aria-expanded="false"><i class="fa fa-plus"></i></a></li>
                        </ul>
                        <div class="row">
                            <div class="tab-content">
                                <div id="tab-3" class="tab-pane active">
                                    <div class="panel-body">
                                        <strong>Album sets</strong>

                                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                            existence in this spot, which was created for the bliss of souls like mine.</p>

                                        <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                            the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                                    </div>
                                </div>

                                @foreach($albumSets as $albumSet)
                                    <div id="{{$albumSet->id}}" class="tab-pane">
                                        <div class="panel-body">x

                                            <div class="lightBoxGallery">

                                                @isset($albumSet->album_images)
                                                    @foreach($albumSet->album_images as $albumSetImage)
                                                        <a href="{{ asset('') }}{{ $albumSetImage->large }}" title="{{ $albumSetImage->name }}" data-gallery=""><img src="{{ asset('') }}{{ $albumSetImage->small }}"></a>
                                                    @endforeach
                                                @endisset
                                                <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                                                <div id="blueimp-gallery" class="blueimp-gallery">
                                                    <div class="slides"></div>
                                                    <h3 class="title"></h3>
                                                    <a class="prev">‹</a>
                                                    <a class="next">›</a>
                                                    <a class="close">×</a>
                                                    <a class="play-pause"></a>
                                                    <ol class="indicator"></ol>
                                                </div>

                                            </div>

                                            <form id="my-awesome-dropzone" class="dropzone" action="{{route('admin.album.set.image.upload',$albumSet->id)}}">
                                                @csrf
                                                <div class="dropzone-previews"></div>
                                            </form>

                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <div class="row">
                            <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#collection_settings"> <i class="fa fa-cogs"></i> Collection Settings</a></li>
                                <li class=""><a data-toggle="tab" href="#design"><i class="fa fa-bookmark"></i> Design</a></li>
                                <li class=""><a data-toggle="tab" href="#privacy"><i class="fa fa-lock"></i> Privacy</a></li>
                                <li class=""><a data-toggle="tab" href="#download"><i class="fa fa-download"></i> Download</a></li>
                                <li class=""><a data-toggle="tab" href="#favourite"><i class="fa fa-heart"></i> Favourite</a></li>
                                <li class=""><a data-toggle="tab" href="#sharing"><i class="fa fa-share"></i> Sharing</a></li>
                                <li class=""><a data-toggle="tab" href="#store"><i class="fa fa-shopping-cart"></i> Store</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="collection_settings" class="tab-pane active">
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="form-group">
                                                <label>Collection Name</label>
                                                <input type="text" value="{{$album->name}}" class="form-control">
                                                <i>Pick something short and sweet. Imagine choosing a title for a photo album cover.</i>
                                            </div>
                                            <div class="form-group" id="data_1">
                                                <label class="font-noraml">Simple data input format</label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" value="{{$album->date}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" placeholder="Password" class="form-control">
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                                <label> <input type="checkbox" class="i-checks"> Remember me </label>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div id="design" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Donec quam felis</strong>

                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                                <div id="privacy" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Yak</strong>

                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                                <div id="download" class="tab-pane">
                                    <div class="panel-body">
                                        <form>

                                            <div class="container-fluid">

                                                <div class="row">
                                                    <div class="form-group">
                                                        <p>
                                                            Download Status
                                                        </p>
                                                        <input type="checkbox" name="download_status" class="js-switch" checked />
                                                        <i>Turn on to allow your clients to download photos from this Collection.</i>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label">Download PIN</label>
                                                        <div class="col-lg-4 ">
                                                            <input type="text" value="PIN" class="form-control">
                                                            <span class="help-block m-b-none">Your clients will be required to input this download pin to download photos.</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <p>
                                                            Gallery Download
                                                        </p>
                                                        <input type="checkbox" name="gallery_download" class="js-switch_2" checked />
                                                        <i>Turn on to allow your clients to download photos from this Collection.</i>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Download Sizes</label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-5">
                                                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="option1">High Resolution </label>
                                                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="option2">Original </label>
                                                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="option3">3600px </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-5">
                                                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="option1">High Resolution </label>
                                                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="option2">Original </label>
                                                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="option3">3600px </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </form>
                                    </div>
                                </div>
                                <div id="favourite" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Yak</strong>

                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                                <div id="sharing" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Yak</strong>

                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                                <div id="store" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Yak</strong>

                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

@endsection

@include('admin.layouts.modals.albumSet')

@section('js')

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- blueimp gallery -->
    <script src="{{ asset('inspinia') }}/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

    <!-- DROPZONE -->
    <script src="{{ asset('inspinia') }}/js/plugins/dropzone/dropzone.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/masonary/masonry.pkgd.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <style>

        .grid .ibox {
            margin-bottom: 0;
        }

        .grid-item {
            margin-bottom: 25px;
            width: 300px;
        }
    </style>

    <script>
        $(window).load(function() {

            $('.grid').masonry({
                // options
                itemSelector: '.grid-item',
                columnWidth: 300,
                gutter: 25
            });

        });
    </script>
    <script>
        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });

        var elem_2 = document.querySelector('.js-switch_2');
        var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

        var elem_3 = document.querySelector('.js-switch_3');
        var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });
    </script>

    <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                        files = this.files,
                        file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                divStyle.backgroundColor = ev.color.toHex();
            });

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

        $("#basic_slider").noUiSlider({
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#range_slider").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#drag-fixed").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
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
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
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
