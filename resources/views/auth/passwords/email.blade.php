<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>nihusubu | Reset password</title>

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="font-bold">Forgot password</h2>

                    <p>
                        Enter your email address and your password will be reset and emailed to you.
                    </p>

                    <div class="row">



                        <div class="col-lg-12">
                            <form role="form" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Send Password Reset Link</button>

                                {{--  <a class="btn btn-sm btn-white btn-block" href="{{route('login')}}">Login</a>  --}}
                                {{--  <a class="btn btn-sm btn-white btn-block" href="{{route('register')}}">Create an account</a>  --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright nihusubu
            </div>
            <div class="col-md-6 text-right">
               <small>© <script>document.write(new Date().getFullYear());</script></small>
            </div>
        </div>
    </div>

</body>

</html>
