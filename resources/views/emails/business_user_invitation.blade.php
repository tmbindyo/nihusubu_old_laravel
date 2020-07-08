<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
<title>Notification</title>
<style type="text/css">
div, p, a, li, td {
    -webkit-text-size-adjust: none;
    font-family: 'Open Sans', 'Helvetica', Arial, Verdana, sans-serif;
}
body {
    font-family: 'Open Sans', 'Helvetica', Arial, Verdana, sans-serif;
}
table {
    mso-table-lspace: 0pt !important;
    mso-table-rspace: 0pt !important;
}
img {
    display: block;
}
a {
    text-decoration: none;
    font-family: 'Open Sans', 'Helvetica', Arial, Verdana, sans-serif;
    color: inherit !important;
}
p {
    margin: 0px;
    padding: 0px;
    font-family: inherit;
}
.tpl-content {
    padding: 0px !important;
}
.width_100 {
    max-width: 800px;
    width: 100%;
}
img {
    max-width: 100%;
    height: auto;
}

@media only screen and (max-width: 820px) {
.width_100 {
    width: 100%;
}
}

@media only screen and (max-width: 720px) {
.img-center img {
    margin: 0 auto !important;
}
.img-right img {
    float: none !important;
    text-align: right;
    text-align: -webkit-right;
}
.img-left img {
    float: none !important;
    text-align: left;
    text-align: -webkit-left;
}
.erase {
    display: none;
    height: 0px;
}
.text-center {
    float: none !important;
    text-align: center;
    text-align: -webkit-center;
}
.text-left {
    float: none !important;
    text-align: left;
    text-align: -webkit-left;
}
.text-right {
    float: none !important;
    text-align: right;
    text-align: -webkit-right;
}
.padding-top {
    padding-top: 10px;
}
.padding-top-60 {
    padding-top: 60px !important;
    height: auto;
    display: block;
}
.padding-bottom-60 {
    padding-bottom: 60px !important;
    height: auto;
    display: block;
}
}

@media only screen and (max-width: 420px) {
.width_100percent {
    width: 100% !important;
    max-width: 100%;
    margin: 0 auto !important;
    height: auto!important;
}
.width_90percent {
    width: 90% !important;
    max-width: 90%;
    margin: 0 auto !important;
    height: auto!important;
}
.display-block {
    display: block !important;
    height: auto !important;
    margin: 0 auto !important;
    width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
}
.full-width-img img {
    width: 100%;
    height: auto;
}
.logo-icon img {
    max-width: 75%;
    height: auto;
}
.padding {
    padding: 10px 0px;
}
br {
    display: none;
}
}
</style>
</head>

<body style="margin:0px; padding:0px;">
<!--Welcome 1 Start-->
<table class="width_100" align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border-collapse:collapse;">
    <tbody>
        <tr>
        	<td width="100%" align="center" valign="middle" background="{{ asset('emails') }}/Welcome/images/bg-image-1.png" style="background-image:url({{ asset('emails') }}/Welcome/images/bg-image-1.png); background-position:center center; background-repeat:repeat; background-size:cover;" bgcolor="#53599A">
            	<table align="center" border="0" cellpadding="0" width="100%" cellspacing="0" style="border-collapse: collapse;">
                	<tbody>
                        <tr>
                            <td width="100%" height="53" style="line-height:1px;"></td>
                        </tr>
                    	<tr>
                        	<td width="100%" align="center" valign="middle" style="line-height:1px;">
                            	<a href="http://www.nihusubu.com/" target="_blank" style="display:inline-block;"><img src="{{ $message->embed(public_path().'/logo_transparent.png') }}" width="164" height="29" alt="Logo" border="0" style="display:block;"></a>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" height="51" style="line-height:1px;"></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle">
                            	<table class="width_90percent" align="center" border="0" cellpadding="0" width="400" cellspacing="0" style="border-collapse: collapse; max-width:90%; -webkit-border-radius: 10px; border-radius: 10px;" bgcolor="#FFFFFF">
                                    <tbody>
                                        <tr>
                                        	<td width="100%" align="center" valign="middle">
                                                <table class="width_90percent" align="center" border="0" cellpadding="0" width="327" cellspacing="0" style="border-collapse: collapse; max-width:90%;">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="54" style="line-height:1px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" align="center" valign="middle" style="line-height:1px;">
                                                                <img src="{{ $message->embed(public_path().'/emails/Welcome/images/icon-1.png') }}" width="253" height="133" alt="Icon" border="0" style="display:block;">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="display-block padding" width="100%" height="48" style="line-height:1px;"></td>
                                                        </tr>
                                        				<tr>
                                                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:28px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold; text-transform:uppercase;">Welcome</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="18" style="line-height:1px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" align="center" valign="middle">
                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="72" height="15" style="line-height:1px; border-bottom:5px solid #ffc600;"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="display-block padding" width="100%" height="33" style="line-height:1px;"></td>
                                                        </tr>
                                        				<tr>
                                                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:18px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold; line-height:30px;">You have been invited to {{$userAccount->institution->name}} <br>on Nihusubu</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="display-block padding" width="100%" height="29" style="line-height:1px;"></td>
                                                        </tr>
                                        				<tr>
                                                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#111111; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal; line-height:24px;">Lorem ipsum dolor sit amet, consectetur <br>adipisicing elit, sed do eiusmod.</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="display-block padding" width="100%" height="22" style="line-height:1px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" align="center" valign="middle">
                                                                <table class="width_90percent" align="center" border="0" cellpadding="0" cellspacing="0" width="255" style="border-collapse:collapse; max-width:100%; -webkit-border-radius:30px; border-radius:30px;" bgcolor="#ffc600">
                                                                    <tbody>
                                                                        <tr>
{{--                                                                            /user/{user_id}/institution/{institution_id}/invitation--}}
                                                                            <td width="100%" align="center" style="max-width:255px; margin:0px; padding: 8px 40px; font-size:14px; color:#FFFFFF; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal; text-transform:capitalize;">
                                                                                 <a href="http://localhost:8080/user/{{encrypt($userAccount->user->id)}}/institution/{{$userAccount->institution->id}}/invitation" target="_blank" style="width:100%; color:#FFFFFF; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; text-decoration:none; display:block;">View Now</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
																</table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="22" style="line-height:1px;"></td>
                                                        </tr>
                                        				<tr>
                                                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal; line-height:24px;">For your reference, your email is</td>
                                                        </tr>
                                        				<tr>
                                                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal; line-height:24px;">{{$userAccount->user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="display-block padding" width="100%" height="24" style="line-height:1px;"></td>
                                                        </tr>
                                                        <tr>
                                                        	<td width="100%" align="center" valign="middle">
                                                            	<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="25" align="center" valign="middle" style="line-height:1px;">
                                                                                <a href="http://www.facebook.com/nihusubu" target="_blank" style="display:block;"><img src="{{ $message->embed(public_path().'/emails/Welcome/images/facebook.png') }}" width="25" height="25" alt="Facebook" border="0" style="display:block"></a>
                                                                            </td>
                                                                            <td width="20" style="line-height:1px;"></td>
                                                                            <td width="25" align="center" valign="middle" style="line-height:1px;">
                                                                                <a href="https://twitter.com/nihusubu" target="_blank" style="display:block;"><img src="{{ $message->embed(public_path().'/emails/Welcome/images/twitter.png') }}" width="25" height="25" alt="Twitter" border="0" style="display:block"></a>
                                                                            </td>
                                                                            <td width="20" style="line-height:1px;"></td>
                                                                            <td width="25" align="center" valign="middle" style="line-height:1px;">
                                                                                <a href="https://www.instagram.com/nihusubu" target="_blank" style="display:block;"><img src="{{ $message->embed(public_path().'/emails/Welcome/images/instagram.png') }}" width="25" height="25" alt="Instagram" border="0" style="display:block"></a>
                                                                            </td>
                                                                            <td width="20" style="line-height:1px;"></td>
                                                                            <td width="25" align="center" valign="middle" style="line-height:1px;">
                                                                                <a href="https://www.youtube.com/nihusubu" target="_blank" style="display:block;"><img src="{{ $message->embed(public_path().'/emails/Welcome/images/youtube.png') }}" width="25" height="25" alt="Youtube" border="0" style="display:block"></a>
                                                                            </td>
                                                                            <td width="20" style="line-height:1px;"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="54" style="line-height:1px;"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                   </tbody>
                               </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="100%" height="39" style="line-height:1px;"></td>
                        </tr>
                        <tr>
                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal; line-height:24px;">&copy; <script>document.write(new Date().getFullYear());</script> Nihusubu.</td>
                        </tr>
                        <tr>
                            <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal; line-height:24px;">Ralph Bunche Rd, General Accident House. 2nd Floor.</td>
                        </tr>
                        <tr>
                            <td width="100%" height="43" style="line-height:1px;"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!--Welcome 1 End-->

<!--Welcome 5 End-->
</body>
</html>
