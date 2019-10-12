<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    // Projects
    public function projectsFeed()
    {
        return view('business.projects_feed');
    }
    public function projects()
    {
        return view('business.projects');
    }
    public function projectCreate()
    {
        return view('business.project_create');
    }
    public function projectStore(Request $request)
    {
        return back()->withSuccess(__('Project successfully stored.'));
    }
    public function projectShow($project)
    {
        return view('business.project_show');
    }
    public function projectEdit($project)
    {
        return view('business.project_edit');
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
