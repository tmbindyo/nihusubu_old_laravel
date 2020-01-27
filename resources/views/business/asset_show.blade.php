@extends('business.layouts.app')

@section('title', 'Asset')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">


    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Assets</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.assets',$institution->portal)}}">Assets</a>
            </li>
            <li class="active">
                <strong>Asset</strong>
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>
                                <h2>Contract with Zender Company</h2>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Status:</dt> <dd><span class="label label-primary">Active</span></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">

                                <dt>Created by:</dt> <dd>Alex Smith</dd>
                                <dt>Messages:</dt> <dd>  162</dd>
                                <dt>Client:</dt> <dd><a href="#" class="text-navy"> Zender Company</a> </dd>
                                <dt>Version:</dt> <dd> 	v1.4.2 </dd>
                            </dl>
                        </div>
                        <div class="col-lg-7" id="cluster_info">
                            <dl class="dl-horizontal" >

                                <dt>Last Updated:</dt> <dd>16.08.2014 12:15:57</dd>
                                <dt>Created:</dt> <dd> 	10.07.2014 23:36:57 </dd>
                                <dt>Participants:</dt>
                                <dd class="project-people">
                                    <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg"></a>
                                    <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg"></a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Completed:</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                    <small>Project completed in <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-1" data-toggle="tab">Users messages</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">Last activity</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-1">
                                            <div class="feed-activity-list">
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                        <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                                        <div class="well">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                            Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">2 days ago at 8:30am</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right text-navy">5h ago</small>
                                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                                        <div class="actions">
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                        <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                                        <div class="well">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                            Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">23h ago</small>
                                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a7.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab-2">

                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Title</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Comments</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
                                                    </td>
                                                    <td>
                                                        Create project in webapp
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
                                                    </td>
                                                    <td>
                                                        Various versions
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                                                    </td>
                                                    <td>
                                                        There are many variations
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Reported</span>
                                                    </td>
                                                    <td>
                                                        Latin words
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            Latin words, combined with a handful of model sentence structures
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
                                                    </td>
                                                    <td>
                                                        The generated Lorem
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                                                    </td>
                                                    <td>
                                                        The first line
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Reported</span>
                                                    </td>
                                                    <td>
                                                        The standard chunk
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
                                                    </td>
                                                    <td>
                                                        Lorem Ipsum is that
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
                                                    </td>
                                                    <td>
                                                        Contrary to popular
                                                    </td>
                                                    <td>
                                                        12.07.2014 10:10:1
                                                    </td>
                                                    <td>
                                                        14.07.2014 10:16:36
                                                    </td>
                                                    <td>
                                                        <p class="small">
                                                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                                                        </p>
                                                    </td>

                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="wrapper wrapper-content project-manager">
            <h4>Project description</h4>
            <img src="{{ asset('inspinia') }}/img/zender_logo.png" class="img-responsive">
            <p class="small">
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
            </p>
            <p class="small font-bold">
                <span><i class="fa fa-circle text-warning"></i> High priority</span>
            </p>
            <h5>Project tag</h5>
            <ul class="tag-list" style="padding: 0">
                <li><a href=""><i class="fa fa-tag"></i> Zender</a></li>
                <li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                <li><a href=""><i class="fa fa-tag"></i> Passages</a></li>
                <li><a href=""><i class="fa fa-tag"></i> Variations</a></li>
            </ul>
            <h5>Project files</h5>
            <ul class="list-unstyled project-files">
                <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
            </ul>
            <div class="text-center m-t-md">
                <a href="#" class="btn btn-xs btn-primary">Add files</a>
                <a href="#" class="btn btn-xs btn-primary">Report contact</a>

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
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- JSKnob -->
    <script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- NouSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Page-Level Scripts -->
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
            '.chosen-select-width'     : {width:"100%"}
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


    {{--  Data tables  --}}
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

    </script>

@endsection
