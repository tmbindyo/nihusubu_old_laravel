<?php

namespace App\Http\Controllers\Landing;

use App\EmailSubscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function landing()
    {
        return view('landing.landing');
    }
    public function about()
    {
        return view('landing.about');
    }
    public function services()
    {
        return view('landing.services');
    }
    public function contacts()
    {
        return view('landing.contacts');
    }
    public function events()
    {
        return view('landing.events');
    }
    public function lawyer()
    {
        return view('landing.lawyer');
    }
    public function event($event_id)
    {
        return view('landing.event');
    }
    public function faq()
    {
        return view('landing.faq');
    }
    public function corporate()
    {
        return view('landing.corporate');
    }
    public function team()
    {
        return view('landing.team');
    }
    public function portfolio()
    {
        return view('landing.portfolio');
    }
    public function comingSoon()
    {
        return view('landing.coming_soon');
    }


    public function emailSubscribe(Request $request)
    {

        $emailSubscription = new EmailSubscribe();
        $emailSubscription->email = $request->email;
        $emailSubscription->status_id = '276b2772-7230-4f83-bbd7-ec45e3da2ae4';
        $emailSubscription->save();
        return back()->withSuccess(__('You have sucessfully been subscribed.'));
    }

    public function emailUnubscribe(Request $request)
    {

        $emailSubscription = EmailSubscribe::where('email',$request->email)->first();
        if($emailSubscription){
            $emailSubscription->status_id = 'e0050238-1d7b-4420-b297-ce4c41c700a3';
            $emailSubscription->save();
            return back()->withSuccess(__('You have sucessfully been subscribed.'));
        }else{
            return back()->withError(__("We don't seem to have a record of this email subscribed."));
        }
    }

    public function contactUs(Request $request)
    {

        $emailSubscription = new EmailSubscribe();
        $emailSubscription->name = $request->name;
        $emailSubscription->email = $request->email;
        $emailSubscription->message = $request->message;
        $emailSubscription->status_id = '8932f8c3-226a-47c9-9796-5ba50662fdea';
        $emailSubscription->save();

        return back()->withSuccess(__('You have sucessfully been subscribed.'));
    }

}
