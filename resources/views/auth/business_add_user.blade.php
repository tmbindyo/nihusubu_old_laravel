<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>nihusubu | Register</title>

    {{--  google analytics  --}}
    @include('layouts.google_analytics')

    <!-- Hotjar Tracking Code for http://nihusubu.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1891042,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="text-center loginscreen   animated fadeInDown">
        <div class="col-md-8 col-md-offset-2">
            <div>

                {{--  <span class="logo-name">N</span>  --}}
                <img style="height:150px;" src="{{ asset('logo_transparent.png') }}" />

            </div>
            <div class="ibox-content">
                <h2>
                    Set up your organization profile
                </h2>

                <form id="form" action="{{ route('business.store.user.account',['user_id'=>encrypt($user->id), 'institution_id'=>$institution->id]) }}" method="post" class="wizard-big">
                    @csrf
                    <h1>Account</h1>
                    <fieldset>
                        <h2>User Information</h2>
                        <div class="row">
                            <div class="col-lg-10 col-md-offset-1">
                                <div class="form-group">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <label>Name *</label>
                                    <input id="name" name="name" type="text" placeholder="{{ __('Name') }}" value="{{ $user->name }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <label>Sign Up Email *</label>
                                    <input id="email" name="email" type="email" value="{{ $user->email }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} input-lg required email">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                    <label>Phone Number *</label>
                                    <input id="phone_number" name="phone_number" type="tel" placeholder="{{ __('Phone number') }}" value="{{ $user->phone_number }}" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <label>Password *</label>
                                    <input id="password" name="password" type="password" value="{{ old('password') }}"  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                    <label>Confirm Password *</label>
                                    <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"  type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} input-lg required">
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <h1>Finish</h1>
                    <fieldset>
                        <h2>Terms and Conditions</h2>
                        <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the <a target="_blank" href="{{route('terms.and.conditions')}}">Terms and Conditions</a>.</label>

                        {{-- <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Save') }}</button> --}}
                    </fieldset>
                </form>
            </div>
            <p class="m-t">Copyright &copy; <script>document.write(new Date().getFullYear());</script></p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>
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
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <script>
       function removeSpaces(string){
        string = string.replace(/\ /g,"_");
        return string;
       }
    </script>
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
                    password_confirmation: {
                        equalTo: "#password"
                    }
                }
            });
       });

       // Automatically generate the business portal value based on the business name set
       function businessNameChange (e) {
            var businessName = e.value;
            var portalUrl = businessName.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g, '').split(" ").join("-").toLowerCase()

            var portalInputField = document.getElementById("portal");
            portalInputField.value = portalUrl;
       };
    </script>
</body>

</html>
