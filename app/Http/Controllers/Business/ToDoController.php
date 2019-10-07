<?php

namespace App\Http\Controllers\Business;

use App\Project;
use App\ToDo;
use App\Traits\UserTrait;
use App\Traits\InstitutionTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ToDoController extends Controller
{

    use UserTrait;
    use institutionTrait;

    // Getting all the to dos
    public function toDos()
    {
        // User
        $user = $this->getUser();

        // Institution
        $institution = $this->getInstitution();

        // Pending to dos
        $pendingToDos = ToDo::with('user','status')->where('status_id','f3df38e3-c854-4a06-be26-43dff410a3bc')->where('institution_id',$institution->id)->where('user_id',$user->id)->get();
        // In progress to dos
        $inProgressToDos = ToDo::with('user','status')->where('status_id','2a2d7a53-0abd-4624-b7a1-a123bfe6e568')->where('institution_id',$institution->id)->where('user_id',$user->id)->get();
        // Completed to dos
        $completedToDos = ToDo::with('user','status')->where('status_id','facb3c47-1e2c-46e9-9709-ca479cc6e77f')->where('institution_id',$institution->id)->where('user_id',$user->id)->get();
        // Overdue to dos
        $overdueToDos = ToDo::with('user','status')->where('status_id','99372fdc-9ca0-4bca-b483-3a6c95a73782')->where('institution_id',$institution->id)->where('user_id',$user->id)->get();

        return view('business.to_dos',compact('pendingToDos','inProgressToDos','completedToDos','overdueToDos','user'));
    }

    // Store to do
    public function toDoStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution();
        // parse due date to mysql format
        $due_date = date('Y-m-d', strtotime($request->due_date));
        // date today
        $date_today = date('Y-m-d');

        $todo = new ToDo();
        $todo->task = $request->task;
        $todo->notes = $request->notes;
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));

        // Check if date is overdue to make the status overdue
        // Check and compare if the task is overdue to set the relevant
        if($due_date < $date_today) {
            // overdue status
            $todo->status_id = "99372fdc-9ca0-4bca-b483-3a6c95a73782";
        }else{
            $todo->status_id = "f3df38e3-c854-4a06-be26-43dff410a3bc";
        }

        $todo->user_id = $user->id;
        $todo->institution_id = $institution->id;
        $todo->save();
        return back()->withSuccess(__('To do successfully stored.'));
    }

    // Update to do
    public function toDoUpdate(Request $request, $to_do_id)
    {

        $todo = ToDo::findOrFail($to_do_id);
        $todo->name = $request->name;
        $todo->notes = $request->notes;
        // TODO update todo database to from due to due_date
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        //$todo->user_id = $this->getUser()->id;
        $todo->user_id = 3;
        $todo->save();
        return back()->withSuccess('To do '.$todo->task.' updated!');

    }

    // Update to do status, set to in progress
    public function toDoSetInProgress($to_do_id)
    {

        $todo = ToDo::findOrFail($to_do_id);
        $todo->status_id = '2a2d7a53-0abd-4624-b7a1-a123bfe6e568';
        $todo->save();

        return back()->withSuccess('To do '.$todo->task.' set to in progress');
    }

    // Update to do status, mark as completed
    public function toDoSetCompleted($to_do_id)
    {

        $todo = ToDo::findOrFail($to_do_id);
        $todo->status_id = 'facb3c47-1e2c-46e9-9709-ca479cc6e77f';
        $todo->date_completed = date('Y-m-d');;
        $todo->save();

        return back()->withSuccess('To do '.$todo->task.' status updated to complete.');
    }

    // Delete to do
    public function toDoDelete($to_do_id)
    {

        $todo = ToDo::findOrFail($to_do_id);
        $todo->delete();

        return back()->withStatus(__('To do '.$todo->task.' successfully deleted.'));
    }
}
