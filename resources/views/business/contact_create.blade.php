@extends('business.layouts.app')

@section('title', 'Contact Create')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Contact's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="#">Settings</a>
                </li>
                <li class="active">
                    <a href="{{route('business.contacts',$institution->portal)}}">Contacts</a>
                </li>
                <li class="active">
                    <strong>Contact Create</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Contact Registration <small>Form</small></h5>

                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('business.contact.store',$institution->portal) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                    @if ($errors->has('is_lead'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('is_lead') }}</strong>
                                            </span>
                                    @endif
                                    <div class="col-md-6">
                                        <input type="checkbox" name="is_lead" class="js-switch_3" />
                                        <i>lead</i>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                        <select required="required" name="title" class="select2_demo_title form-control input-lg">
                                            <option></option>
                                            @foreach($titles as $title)
                                                <option value="{{$title->id}}">{{$title->name}}</option>
                                            @endforeach
                                        </select>
                                        <i>title</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required="required" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="First Name">
                                            <i>first name</i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required="required" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="Last Name">
                                            <i>last name</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            @if ($errors->has('phone_number'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required="required" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="Phone number">
                                            <i>phone number</i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                            <input type="email" id="email" name="email" value="{{ old('email') }}" required="required" class="form-control col-md-7 col-xs-12 input-lg" required="required" placeholder="Email">
                                            <i>email</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($errors->has('organization'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('organization') }}</strong>
                                            </span>
                                        @endif
                                        <select name="organization" class="select2_demo_organization form-control input-lg">
                                            <option></option>
                                            @foreach($organizations as $organization)
                                                <option @isset($contactOrganization) @if($contactOrganization->id == $organization->id) selected @endif @endisset value="{{$organization->id}}">{{$organization->name}}</option>
                                            @endforeach
                                        </select>
                                        <i>organization</i>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($errors->has('contact_types'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('contact_types') }}</strong>
                                            </span>
                                        @endif
                                        <select name="contact_types[]" class="select2_demo_contact_type form-control input-lg" multiple required="required">
                                            <option></option>
                                            @foreach($contactTypes as $contactType)
                                                <option @isset($contactContactType) @if($contactContactType->id == $contactType->id) selected @endif @endisset value="{{$contactType->id}}">{{$contactType->name}}</option>
                                            @endforeach
                                        </select>
                                        <i>contact types</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($errors->has('lead_source'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('lead_source') }}</strong>
                                            </span>
                                        @endif
                                        <select name="lead_source" class="select2_demo_lead_source form-control input-lg">
                                            <option></option>
                                            @foreach($leadSources as $leadSource)
                                                <option @isset($contactLeadSource) @if($contactLeadSource->id == $leadSource->id) selected @endif @endisset value="{{$leadSource->id}}">{{$leadSource->name}}</option>
                                            @endforeach
                                        </select>
                                        <i>lead source</i>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            @if ($errors->has('campaign'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('campaign') }}</strong>
                                            </span>
                                            @endif
                                            <select name="campaign" class="select2_demo_campaign form-control input-lg">
                                                <option></option>
                                                @foreach($campaigns as $campaign)
                                                    <option @isset($contactCampaign) @if($contactCampaign->id == $campaign->id) selected @endif @endisset value="{{$campaign->id}}">{{$campaign->name}}</option>
                                                @endforeach
                                            </select>
                                            <i>campaign</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($errors->has('about'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('about') }}</strong>
                                            </span>
                                        @endif
                                        <div class="has-warning">
                                            <textarea id="about" rows="5" name="about" class="resizable_textarea form-control input-lg" required="required" placeholder="About">{{ old('about') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <hr>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>


                            </form>
                            </div>
                        </div>
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

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<!-- Input Mask-->
<script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Switchery -->
<script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

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
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_title").select2({
            placeholder: "Select Title",
            allowClear: true
        });
        $(".select2_demo_organization").select2({
            placeholder: "Select Organization",
            allowClear: true
        });
        $(".select2_demo_contact_type").select2({
            placeholder: "Select Contact Type",
            allowClear: true
        });
        $(".select2_demo_lead_source").select2({
            placeholder: "Select Lead Source",
            allowClear: true
        });
        $(".select2_demo_campaign").select2({
            placeholder: "Select Campaign",
            allowClear: true
        });


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

@endsection
