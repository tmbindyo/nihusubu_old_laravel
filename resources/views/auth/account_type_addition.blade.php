<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>nihusubu | Add Account</title>

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
            <img alt="image" class="img-circle circle-border" src="https://s3.amazonaws.com/uifaces/faces/twitter/ok/128.jpg">
            </div>
            <h3>{{$user->name}}</h3>
            <p>Your are in lock screen. Main app was shut down and you need to select an account to access.</p>
            @foreach($userAccounts as $userAccount)
                @if($userAccount->user_type->name != "Personal")
                    <a href="{{route('add.personal.account')}}" class="btn btn-primary block full-width">Add Personal Account</a>
                @endif
            @endforeach
            <br>
            <a href="{{route('business.add')}}" class="btn btn-primary block full-width">Add Business Account</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>

</body>

</html>
