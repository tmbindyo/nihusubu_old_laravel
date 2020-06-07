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

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Projects
    public function projectsFeed($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.projects_feed', compact('user', 'institution'));
    }
    public function projects($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.projects', compact('user', 'institution'));
    }
    public function projectCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.project_create', compact('user', 'institution'));
    }
    public function projectStore(Request $request, $portal)
    {
        return back()->withSuccess(__('Project successfully stored.'));
    }
    public function projectShow($portal, $project_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.project_show', compact('user', 'institution'));
    }
    public function projectEdit($portal, $project_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);

        return view('business.project_edit', compact('user', 'institution'));
    }
    public function projectUpdate(Request $request, $portal)
    {
        return back()->withSuccess(__('Project successfully updated.'));
    }
    public function projectDelete($portal, $product_group_id)
    {
        return back()->withSuccess(__('Project successfully deleted.'));
    }
}
