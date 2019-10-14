<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    use UserTrait;
    use institutionTrait;

    // Projects
    public function projectsFeed()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.projects_feed',compact('user','institution'));
    }
    public function projects()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.projects',compact('user','institution'));
    }
    public function projectCreate()
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.project_create',compact('user','institution'));
    }
    public function projectStore(Request $request)
    {
        return back()->withSuccess(__('Project successfully stored.'));
    }
    public function projectShow($project)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.project_show',compact('user','institution'));
    }
    public function projectEdit($project)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();

        return view('business.project_edit',compact('user','institution'));
    }
    public function projectUpdate(Request $request)
    {
        return back()->withSuccess(__('Project successfully updated.'));
    }
    public function projectDelete($product_group_id)
    {
        return back()->withSuccess(__('Project successfully deleted.'));
    }
}
