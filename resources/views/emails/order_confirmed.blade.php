@extends('emails.layouts.app')
@section('title', 'Order Summary')
@section('content')

    <tr>
        <td width="100%" height="76" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle" style="line-height:1px;">
            <img src="{{ $message->embed(public_path().'/emails/Order-Confirmed/images/icon-1.png') }}" width="253" height="133" alt="Icon" border="0" style="display:block;">
        </td>
    </tr>
    <tr>
        <td class="display-block padding" width="100%" height="57" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:28px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold; text-transform:uppercase;">ORDER <br>SUMMARY</td>
    </tr>
    <tr>
        <td class="erase" width="100%" height="20" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle">
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td width="72" height="16" style="line-height:1px; border-bottom:5px solid #387a18;"></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="display-block padding" width="100%" height="30" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle"  style="margin:0px; padding:0px; font-size:20px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold; line-height:30px;">
            Your order summary
        </td>
    </tr>
    <tr>
        <td width="100%" height="20" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td width="100%" height="11" style="line-height:1px; border-bottom:1px solid #cdcdcd;"></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td width="100%" height="21" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td class="erase" width="5%"></td>
                        <td class="display-block padding" width="40%" align="center" valign="middle">
                            <table class="text-center" align="left" border="0" cellpadding="0" cellspacing="0" width="120" style="border-collapse: collapse;">
                                <tbody>
                                    @foreach($data->saleProducts as $saleProduct)
                                        <tr>
                                            <td width="100%" height="80" align="center" valign="middle" style="line-height:1px;">
                                                @if(is_null($saleProduct->productImages))
                                                    <img src="{{ $message->embed(public_path().'/emails/Order-Confirmed/images/placeholder.png') }}" width="136" height="76" alt="Product" border="0" style="display:block;">
                                                @else
                                                    <img src="{{ $message->embed(asset('storage')/$saleProduct->productImages[1]->upload->small_thumbnail) }}" width="136" height="76" alt="Product" border="0" style="display:block;">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>

                        <td class="display-block padding" width="40%" align="center" valign="top">
                            <table class="text-center" align="right" border="0" cellpadding="0" cellspacing="0" width="120" style="border-collapse: collapse;">
                                <tbody>
                                @foreach($data->saleProducts as $saleProduct)
                                    <tr>
                                        <td class="text-center" width="100%" align="right" valign="middle" style="margin:0px; padding:0px; font-size:16px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold;">{{$saleProduct->name}}</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" height="10"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="100%" align="right" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal;">
                                            {{$saleProduct->quantity}}*</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>

                        <td class="display-block padding" width="40%" align="center" valign="top">
                            <table class="text-center" align="right" border="0" cellpadding="0" cellspacing="0" width="120" style="border-collapse: collapse;">
                                <tbody>
                                    @foreach($data->saleProducts as $saleProduct)
                                        <tr>
                                            <td class="text-center" width="100%" align="right" valign="middle" style="margin:0px; padding:0px; font-size:16px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold;">{{$saleProduct->name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="10"></td>
                                        </tr>
                                       <tr>
                                           <td class="text-center" width="100%" align="right" valign="middle" style="margin:0px; padding:0px; padding-top:3px; font-size:12px; color:#969696; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal;">
                                                {{$saleProduct->rate}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="100%" align="right" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal;">
                                                {{$saleProduct->amount}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td class="erase" width="5%"></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td width="100%" height="22" style="line-height:1px; border-bottom:1px solid #cdcdcd;"></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="display-block padding" width="100%" height="31" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:22px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold;">Price : {{$data->total}}</td>
    </tr>
    <tr>
        <td width="100%" height="10" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:14px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:bold;">Order ID #{{$data->reference}} l Date {{$data->date}}</td>
    </tr>
    <tr>
        <td class="display-block padding" width="100%" height="31" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle" style="margin:0px; padding:0px; font-size:12px; color:#000000; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal;"> Shopping Address :<br>200 Broadway, New York, NY 002019, USA.</td>
    </tr>
    <tr>
        <td width="100%" height="32" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td width="100%" align="center" valign="middle">
            <table class="width_90percent" align="center" border="0" cellpadding="0" cellspacing="0" width="255" style="border-collapse:collapse; max-width:100%; -webkit-border-radius:30px; border-radius:30px;" bgcolor="#387a18" >
                <tbody>
                    <tr>
                        <td width="100%" align="center" style="max-width:255px; margin:0px; padding: 8px 20px; font-size:14px; color:#FFFFFF; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; font-weight:normal;">
                             <a href="http://www.nihusubu.com/view/order/{{$data->id}}" target="_blank" style="width:100%; color:#FFFFFF; font-family: 'Open Sans', Helvetica, Arial, Verdana, sans-serif; text-decoration:none; display:block;">View order</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="display-block padding" width="100%" height="28" style="line-height:1px;"></td>
    </tr>
    <tr>
        <td class="display-block padding" width="100%" height="32" style="line-height:1px;"></td>
    </tr>
@endsection

