<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nihusubu | Lockscreen</title>

    {{--  google analytics  --}}
    @include('layouts.google_analytics')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="lock-word animated fadeInDown">
    <span class="first-word">LOCKED</span><span>SCREEN</span>
</div>
    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
                <img style="height:150px;" src="{{ asset('logo_transparent.png') }}" />
            </div>
            <h3>{{$user->name}}</h3>
            <p>Your are in lock screen. Main app was shut down and you need to select an account to access.</p>
            @foreach($userAccounts as $userAccount)
                @if($userAccount->user_type->name == "Business")
                    <a href="{{route('activate.user.account',$userAccount->id)}}" class="btn btn-primary block full-width">Access {{$userAccount->institution->name}}</a>
                    <br>
                @endif
                @if($userAccount->user_type->name == "Admin")
                    <a href="{{route('activate.user.account',$userAccount->id)}}" class="btn btn-primary block full-width">Access Admin Account</a>
                    <br>
                @endif
                @if($userAccount->user_type->name == "Personal")
                    <a href="{{route('activate.user.account',$userAccount->id)}}" class="btn btn-primary block full-width">Access Personal Account</a>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>

</body>

</html>
