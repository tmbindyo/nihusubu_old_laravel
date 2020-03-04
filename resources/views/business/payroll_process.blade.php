@extends('business.layouts.app')

@section('title', 'Products')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">


    <style>

        .wizard > .content > .body  position: relative; }

    </style>


@endsection
@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Process Payroll</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li>
                <a>Forms</a>
            </li>
            <li>
                <a>Forms</a>
            </li>
            <li class="active">
                <strong>Wizard</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-5">
            <div class="jumbotron">
                <h1>Steps</h1>
                <p>Smart UI component which allows you to easily create wizard-like interfaces.</p>
                <p><a href="http://www.jquery-steps.com/GettingStarted" target="_blank" class="btn btn-primary btn-lg" role="button">Learn more about jQuery Steps</a>
                </p>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic Wizzard</h5>

                </div>
                <div class="ibox-content">
                    <p>
                        This is basic example of Step
                    </p>
                    <div id="wizard">
                        <h1>First Step</h1>
                        <div class="step-content">
                            <div class="text-center m-t-md">
                                <h2>Hello in Step 1</h2>
                                <p>
                                    This is the first content.
                                </p>
                            </div>
                        </div>

                        <h1>Second Step</h1>
                        <div class="step-content">
                            <div class="text-center m-t-md">
                                <h2>This is step 2</h2>
                                <p>
                                    This content is diferent than the first one.
                                </p>
                            </div>
                        </div>

                        <h1>Third Step</h1>
                        <div class="step-content">
                            <div class="text-center m-t-md">
                                <h2>This is step 3</h2>
                                <p>
                                    This is last content.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Wizard with Validation</h5>

                </div>
                <div class="ibox-content">
                    <h2>
                        Validation Wizard Form
                    </h2>
                    <p>
                        This example show how to use Steps with jQuery Validation plugin.
                    </p>

                    <form id="form" action="#" class="wizard-big">
                        <h1>Choose Period</h1>
                        <fieldset>
                            <h2>Payroll Period</h2>
                            <div class="row">
                                <div class="col-lg-8">
                                    {{--  payment type  --}}
                                    <div class="has-warning">
                                        <label>  </label>
                                        <select class="select2_demo_3 form-control input-lg">
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Semi-Monthly</option>
                                            <option>Bi-Monthly</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" value="07/01/2014">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                        <input id="confirm" name="confirm" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-center">
                                        <div style="margin-top: 20px">
                                            <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <h1>Profile</h1>
                        <fieldset>
                            <h2>Profile Information</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First name *</label>
                                        <input id="name" name="name" type="text" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <label>Last name *</label>
                                        <input id="surname" name="surname" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input id="email" name="email" type="text" class="form-control required email">
                                    </div>
                                    <div class="form-group">
                                        <label>Address *</label>
                                        <input id="address" name="address" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h1>Warning</h1>
                        <fieldset>
                            <div class="text-center" style="margin-top: 120px">
                                <h2>You did it Man :-)</h2>
                            </div>
                        </fieldset>

                        <h1>Finish</h1>
                        <fieldset>
                            <h2>Terms and Conditions</h2>
                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                        </fieldset>
                    </form>
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

<!-- Steps -->
<script src="{{ asset('inspinia') }}/js/plugins/staps/jquery.steps.min.js"></script>

<!-- Jquery Validate -->
<script src="{{ asset('inspinia') }}/js/plugins/validate/jquery.validate.min.js"></script>


<script>
    $(document).ready(function(){
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex)
                {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18)
                {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex)
            {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18)
                {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3)
                {
                    $(this).steps("previous");
                }
            },
            onFinishing: function (event, currentIndex)
            {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        }).validate({
            errorPlacement: function (error, element)
            {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });
</script>

@endsection
