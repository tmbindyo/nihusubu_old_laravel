<?php

namespace App\Http\Controllers;

use Auth;
use App\Traits\UserTrait;
use App\UserAccount;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    use UserTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // check if numerous accounts
        $user = $this->getUser();
        if($user->user_accounts_count == 1){
            // check account type
            switch ($user->user_accounts[0]->user_type->name){
                // admin
                case "Admin":
                    return redirect()->route('');
                    break;
                // personal
                case "Personal":
                    return redirect()->route('');
                    break;
                // business
                case "Business":
                    return redirect()->route('business.calendar',$user->user_accounts[0]->institution->portal);
                    break;
                default:
                    echo "Your favorite color is neither red, blue, nor green!";
            }
        }
        return view('auth.account');
        // choose account

    }

    public function activeUserAccount()
    {
        return view('dashboard');
    }

    public function viewUserAccounts()
    {

        // User
        $user = Auth::user();
        // get user accountsupdate user_accounts set
        $userAccounts = UserAccount::where('user_id',$user->id)->with('institution','user_type')->get();
        return view('auth.business.lockscreen',compact('userAccounts'));
    }

    public function activateUserAccount($user_account_id)
    {
        // User
        $user = Auth::user();
        // update all user accounts as false
        $userAccounts = UserAccount::where('user_id',$user->id)->update(['is_active' => False]);
        // activate user account
        $userAccounts = UserAccount::where('id',$user_account_id)->update(['is_active' => True]);
        return redirect()->route('home');
    }

    public function deactivateUserAccounts()
    {
        // User
        $user = Auth::user();
        // get user accounts
        $userAccounts = UserAccount::where('user_id',$user->id)->update(['is_active' => 'false']);
        return $user;
    }



    public function admin()
    {
        return view('dashboard');
    }
    public function investor()
    {
        return view('investor.dashboard');
    }
    public function projectmanager()
    {
        return view('project.manager.dashboard');
    }
}
