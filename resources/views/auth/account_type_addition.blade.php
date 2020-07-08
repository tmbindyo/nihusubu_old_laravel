<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>nihusubu | Add Account</title>

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

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="lock-word animated fadeInDown">
    {{--  <span class="first-word">Add</span><span>Account</span>  --}}
</div>
    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
                <img style="height:150px;" src="{{ asset('logo_transparent.png') }}" />
            </div>
            <h3>{{$user->name}}</h3>
            <p>Your are in lock screen. Main app was shut down and you need to select an account to access.</p>
            {{--  @foreach($userAccounts as $userAccount)
                @if($userAccount->userType->name != "Personal")

                @endif
            @endforeach  --}}
            <p><a target="_blank" href="{{route('terms.and.conditions')}}">Terms and Conditions</a></p>
            @if($personalUserAccount)
            @else
                <a href="{{route('add.personal.account')}}" class="btn btn-primary block full-width">Add Personal Account</a>
            @endif
            <br>
            <a href="{{route('business.add')}}" class="btn btn-primary block full-width">Add Business Account</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>

</body>

</html>
