<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>nihusubu | Choose Account</title>

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
            <h3>John Smith</h3>
            <p>Your are in lock screen. Main app was shut down and you need to enter your passwor to go back to app.</p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="******" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width">Unlock</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>

</body>

</html>
