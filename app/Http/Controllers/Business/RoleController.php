<?php

namespace App\Http\Controllers\Business;

use App\Mail\BusinessInviteUser;
use App\User;
use App\UserAccount;
use App\Traits\UserTrait;
use App\InstitutionModule;
use Illuminate\Http\Request;
use App\Traits\InstitutionTrait;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roles($portal)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // Get roles
        $roles = Role::where('institution_id', $institution->id)->with('permissions')->get();

        return view('business.roles', compact('roles', 'user', 'institution'));
    }

    public function roleShow($portal, $role_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // get role
        $role = Role::where('id', $role_id)->where('institution_id', $institution->id)->with('permissions')->first();
        $rolePermissionNames = $role->getPermissionNames()->toArray();
//        return $rolePermissionNames;
        // role users
        $roleUsers = User::role($role)->with('roles')->get();
        $roleUserIds = User::role($role)->select('id')->get()->toArray();
        // institution modules
        $institutionModules = InstitutionModule::where('institution_id',$institution->id)->with('module.permissions')->get();
        // get permissions
        $institutionModuleIds = InstitutionModule::where('institution_id',$institution->id)->select('module_id')->get()->toArray();
        $permissions = Permission::whereIn('module_id',$institutionModuleIds)->get();

        // get users without role
        $institutionUsers = UserAccount::where('institution_id',$institution->id)->select('user_id')->get()->toArray();
        $pendingUsers = User::whereIn('id',$institutionUsers)->whereNotIn('id',$roleUserIds)->with('roles')->get();
        return view('business.role_show', compact( 'role', 'user', 'institution','roleUsers','institutionModules','rolePermissionNames','pendingUsers'));
    }

    public function roleStore(Request $request, $portal)
    {
        //  return $request;
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // Create role
        $role = Role::create(['name' => $request->name, 'institution_id' => $institution->id]);

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>$role->id])->withSuccess('Role '.$role->name.' successfully created!');
    }

    public function userRevokeRole($portal, $user_id, $role_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // revoke user
        $revokedUser = User::findOrFail(decrypt($user_id));
        $role = Role::findOrFail($role_id);
        $revokedUser->removeRole($role->id);

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>$role_id])->withSuccess('User '.$revokedUser->name.' successfully revoked!');
    }

    public function userAssignRole(Request $request, $portal, $role_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // revoke user
        $AddedUser = User::findOrFail(decrypt($request->user));
        $role = Role::findOrFail($role_id);
        $AddedUser->assignRole($role->id);

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>$role_id])->withSuccess('User '.$AddedUser->name.' successfully assigned role '.$role->name.'!');
    }

    public function updateRolePermission($portal, $role_id, $permission_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // get permission
        $role = Role::findOrFail(decrypt($role_id));
        // get role
        $permission = Permission::findOrFail(decrypt($permission_id));
        // check if role has permission
        $rolePermission = $role->hasPermissionTo($permission->id);

        if($rolePermission == true){
            $role->revokePermissionTo($permission->id);
        }else{
            $role->givePermissionTo($permission->id);
        }

    }

    public function institutionAddUser(Request $request, $portal, $role_id)
    {
        $validatedUserData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // return $validatedData;

        // user account creation
        $newUser = new User();
        $newUser->phone_number = $request->phone_number;
        // $user->timezone = $request->timezone;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);

        // account
        $userAccount = new UserAccount();
        $userAccount->institution_id = $institution->id;
        $userAccount->user_id = $user->id;
        $userAccount->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
        $userAccount->is_institution = true;
        $userAccount->is_active = true;
        $userAccount->is_user = false;
        $userAccount->is_admin = false;
        $userAccount->institution_id = $institution->id;
        $userAccount->user_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
        $userAccount->save();

        // verification email
        $user->sendEmailVerificationNotification();

        // get role
        $role = Role::where('id', $role_id)->where('institution_id', $institution->id)->with('permissions')->first();

        // role assign permissions based on modules
        $newUser->assignRole($role);

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>$role_id])->withSuccess('User '.$request->name.' has been invited to your organization!');
    }

    // users
    public function users($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // Users
        $users = UserAccount::where('institution_id',$institution->id)->with('user')->get();
//        return $user;
//        return $user->activeUserAccount->userType->name;
        return view('business.users', compact('user', 'institution', 'users'));
    }

    public function userCreate($portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        return view('business.user_create', compact('user', 'institution'));
    }

    public function userStore(Request $request, $portal)
    {

        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // check if user exists
        $user = User::where('email',$request->email)->first();
        if($user){
            // check if user has an account
            $userAccount = UserAccount::where('user_id',$user->id)->first();
            if ($userAccount){
                return back()->withWarning(__('This user already has an account!'));
            }else{
                // add user account
                $newUserAccount = new UserAccount();
                $newUserAccount->is_institution = true;
                $newUserAccount->is_active = false;
                $newUserAccount->is_user = false;
                $newUserAccount->is_admin = false;
                $newUserAccount->user_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
                $newUserAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $newUserAccount->institution_id = $institution->id;
                $newUserAccount->user_id = $user->id;
                $newUserAccount->save();

                // send email to inform
            }

        }else{

            // create user
            // user account creation
            $user = new User();
            $user->name = $request->first_name.' '.$request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make('pending');
            $user->save();

            // create user account
            $newUserAccount = new UserAccount();
            $newUserAccount->is_institution = true;
            $newUserAccount->is_active = false;
            $newUserAccount->is_user = false;
            $newUserAccount->is_admin = false;
            $newUserAccount->user_type_id = '07c99d10-8e09-4861-83df-fdd3700d7e48';
            $newUserAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $newUserAccount->institution_id = $institution->id;
            $newUserAccount->user_id = $user->id;
            $newUserAccount->save();
            $userAccount = UserAccount::where('id',$newUserAccount->id)->with('user','institution')->first();

            // send user email
            Mail::to($request->email)->send(new BusinessInviteUser($userAccount));
        }
        return back()->withSuccess(__('User has been invited to your organization!'));
    }

}
