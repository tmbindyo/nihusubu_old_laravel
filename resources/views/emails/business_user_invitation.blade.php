@extends('emails.layouts.app')
@section('title', 'Invitation')
@section('content')
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
        <td width="100%" align="center" valign="middle">
            <table class="width_90percent" align="center" border="0" cellpadding="0" cellspacing="0" width="255" style="border-collapse:collapse; max-width:100%; -webkit-border-radius:30px; border-radius:30px;" bgcolor="#ffc600">
                <tbody>
                <tr>
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
@endsection
