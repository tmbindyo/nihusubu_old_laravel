<?php

namespace App\Http\Controllers\Business;

use App\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{

    // feedbacks
    public function feedbacks($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // get feedbacks
        $feedbacks = Feedback::where('institution_id',$institution->id)->with('user','status')->get();
        // get feedbacks
        $deletedFeedbacks = Feedback::where('institution_id',$institution->id)->with('user','status')->onlyTrashed()->get();
        return view('business.feedbacks',compact('feedbacks','user','institution','deletedFeedbacks'));
    }

    public function feedbackCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        return view('business.feedback_create',compact('user','institution'));
    }

    public function feedbackStore(Request $request, $portal)
    {
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);

        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $feedback->user_id = $user->id;
        $feedback->institution_id = $institution->id;
        $feedback->save();

        return redirect()->route('business.campaign.type.show',['portal'=>$institution->portal,'id'=>$feedback->id])->withSuccess('Feedback updated!');
    }

    public function feedbackShow($portal, $feedback_id)
    {
        // Check if feedback exists
        $feedbackExists = Feedback::findOrFail($feedback_id);
        // User
        $user = $this->getUser();
        // Get institutions
        $institution = $this->getInstitution($portal);
        // Get feedback
        $feedback = Feedback::with('user','status','campaigns.user')->where('is_institution',True)->where('id',$feedback_id)->withCount('campaigns')->first();
        return view('business.feedback_show',compact('feedback','user','institution'));
    }

    public function feedbackUpdate(Request $request, $portal, $feedback_id)
    {
        // Get institutions
        $institution = $this->getInstitution($portal);

        $feedback = Feedback::findOrFail($feedback_id);
        $feedback->name = $request->name;
        $feedback->save();

        return redirect()->route('business.campaign.type.show',['portal'=>$institution->portal,'id'=>$feedback->id])->withSuccess('Feedback updated!');
    }

    public function feedbackDelete($portal, $feedback_id)
    {

        $feedback = Feedback::findOrFail($feedback_id);
        $feedback->delete();

        return back()->withSuccess(__('Feedback '.$feedback->name.' successfully deleted.'));
    }
    public function feedbackRestore($portal, $feedback_id)
    {

        $feedback = Feedback::withTrashed()->findOrFail($feedback_id);
        $feedback->restore();

        return back()->withSuccess(__('Feedback '.$feedback->name.' successfully restored.'));
    }

}
