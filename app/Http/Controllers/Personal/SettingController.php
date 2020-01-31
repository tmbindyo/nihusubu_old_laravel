<?php

namespace App\Http\Controllers\Personal;

use App\Title;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // titles
    public function titles()
    {
        // User
        $user = $this->getUser();
        // get titles
        $titles = Title::where('is_user',true)->where('user_id',$user->id)->with('user','status')->get();
        // get deleted titles
        $deletedTitles = Title::where('is_user',true)->where('user_id',$user->id)->with('user','status')->onlyTrashed()->get();

        return view('personal.titles',compact('titles','user','titles','deletedTitles'));
    }

    public function titleCreate()
    {
        // User
        $user = $this->getUser();
        return view('personal.title_create',compact('user'));
    }

    public function titleStore(Request $request)
    {
        // User
        $user = $this->getUser();

        $title = new Title();
        $title->name = ($request->name);
        $title->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $title->user_id = $user->id;
        $title->is_user = True;
        $title->is_institution = False;
        $title->save();
        return redirect()->route('personal.title.show',$title->id)->withSuccess(__('Title '.$title->name.' successfully created.'));
    }

    public function titleShow($title_id)
    {
        // User
        $user = $this->getUser();
        // Check if title exists
        $titleExists = Title::findOrFail($title_id);
        $title = Title::with('user','status','contacts')->where('is_user',true)->withCount('contacts')->where('id',$title_id)->first();
        return view('personal.title_show',compact('title','user'));
    }

    public function titleUpdate(Request $request,$title_id)
    {
        // User
        $user = $this->getUser();

        $title = Title::findOrFail($title_id);
        $title->name = ($request->name);
        $title->user_id = $user->id;
        $title->save();

        return redirect()->route('personal.title.show',$title->id)->withSuccess('Title '.$title->name.' updated!');
    }

    public function titleDelete($title_id)
    {

        $title = Title::findOrFail($title_id);
        $title->delete();

        return back()->withSuccess(__('Title '.$title->name.' successfully deleted.'));
    }

    public function titleRestore($title_id)
    {

        $title = Title::withTrashed()->findOrFail($title_id);
        $title->restore();

        return back()->withSuccess(__('Title '.$title->name.' successfully restored.'));
    }


    // Family
    public function family()
    {
        return view('personal.family');
    }
    public function familyCreate()
    {
        return view('personal.family_create');
    }
    public function familyStore()
    {
        return back()->withSuccess(__('Family successfully created.'));
    }
    public function familyMemberShow($family_id)
    {
        return view('personal.family_show');
    }
    public function familyMemberEdit($family_id)
    {
        return view('personal.family_show');
    }
    public function familyMemberUpdate($family_id)
    {
        return back()->withSuccess(__('Family member successfully updated.'));
    }
    public function familyMemberDelete($family_id)
    {
        return back()->withSuccess(__('Family member successfully deleted.'));
    }


    public function commitments()
    {
        return view('personal.commitments');
    }
    public function commitmentCreate()
    {
        return view('personal.commitment_create');
    }
    public function commitmentStore()
    {
        return back()->withSuccess(__('Commitment successfully created.'));
    }
    public function commitmentShow($commitment_id)
    {
        return view('personal.commitment_show');
    }
    public function commitmentEdit($commitment_id)
    {
        return view('personal.commitment_show');
    }
    public function commitmentUpdate($commitment_id)
    {
        return back()->withSuccess(__('Commitment successfully updated.'));
    }
    public function commitmentDelete($commitment_id)
    {
        return back()->withSuccess(__('Commitment successfully deleted.'));
    }
}
