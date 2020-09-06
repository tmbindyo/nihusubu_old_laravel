<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserAccount;
use App\Traits\UserTrait;
use App\InstitutionModule;
use Illuminate\Http\Request;
use App\Mail\AdminInviteUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{


    use UserTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roles()
    {
        // User
        $user = $this->getUser();
        // Get roles
        $roles = Role::whereNull('institution_id')->with('permissions')->get();

        return view('admin.roles', compact('roles', 'user'));
    }

    public function roleCreate()
    {
        // User
        $user = $this->getUser();

        return view('admin.role_create', compact( 'user'));
    }

    public function roleStore(Request $request)
    {

        // validation
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        // User
        $user = $this->getUser();
        // Create role
        $role = Role::create(['name' => $request->name]);

        $active = 'roles';
        return redirect()->route('admin.role.show',encrypt($role->id))->withSuccess(__('Role '.$role->name.' successfully created!'))->with( ['active' => $active] );
    }

    public function roleShow($role_id)
    {
        // User
        $user = $this->getAdmin();
        // get role
        $roleExists = Role::where('id', decrypt($role_id))->whereNull('institution_id')->first();
        $role = Role::where('id', decrypt($role_id))->whereNull('institution_id')->with('permissions')->first();
        $rolePermissionNames = $role->getPermissionNames()->toArray();
        // get all roles
        $roles = Role::whereNull('institution_id')->get();
        // role users
        $roleUsers = User::role($role)->with('adminRoles')->get();
        $roleUserIds = User::role($role)->select('id')->get()->toArray();
        // get permissions
        $permissions = Permission::whereNull('module_id')->get();
        // get users without role
        $institutionUsers = UserAccount::where('is_admin', true)->select('user_id')->get()->toArray();
        $pendingUsers = User::whereIn('id',$institutionUsers)->whereNotIn('id',$roleUserIds)->with('adminRoles')->get();
        return view('admin.role_show', compact( 'role', 'user', 'roleUsers', 'rolePermissionNames', 'pendingUsers', 'permissions', 'roles', 'roleExists'));
    }

    public function roleUpdate(Request $request, $role_id)
    {
        // User
        $user = $this->getUser();
        // check if role exists
        $roleNameExists = Role::where('name',$request->name)->first();
        if ($roleNameExists){
            return back()->withWarning('Role '.$request->name.' exists!');
        }else{
            // update role
            $role = Role::where('id',$role_id)->first();
            $role->name = $request->name;
            $role->save();
        }

        return redirect()->route('admin.role.show',$role->id)->withSuccess('Role '.$role->name.' successfully created!');
    }

    public function userRevokeRole($user_id, $role_id)
    {

        // User
        $user = $this->getUser();
        // revoke user
        $revokedUser = User::findOrFail(decrypt($user_id));
        $role = Role::findOrFail(decrypt($role_id));
        $revokedUser->removeRole($role->id);

        // update user account
        $userAccount = UserAccount::where('user_id', $revokedUser->id)->where('is_admin', true)->first();
        $userAccount->forceDelete();

        return redirect()->route('admin.role.show',encrypt($role->id))->withSuccess('User '.$revokedUser->name.' successfully revoked!');
    }

    public function userAssignRole(Request $request, $role_id)
    {

        // User
        $user = $this->getUser();
        // revoke user
        $AddedUser = User::findOrFail(decrypt($request->user));
        $role = Role::findOrFail(decrypt($role_id));
        $AddedUser->assignRole($role->id);

        return redirect()->route('admin.role.show', $role_id)->withSuccess('User '.$AddedUser->name.' successfully assigned role '.$role->name.'!');
    }

    public function updateRolePermission($role_id, $permission_id)
    {

        // User
        $user = $this->getUser();
        // get permission
        $role = Role::findOrFail(decrypt($role_id));
        // return $role;
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

    // users
    public function users()
    {
        // User
        $user = $this->getUser();
        // Get roles
        $roles = Role::whereNull('institution_id')->with('permissions')->get();
        // Users
        $users = UserAccount::where('status_id', "c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('is_admin',true)->with('user.adminRoles')->get();
        return view('admin.users', compact('user', 'users', 'roles'));
    }

    public function userCreate()
    {

        // User
        $user = $this->getUser();
        return view('admin.user_create', compact('user'));
    }

    public function userStore(Request $request)
    {

        // User
        $user = $this->getUser();
        // check if user exists
        $userReg = User::where('email',$request->email)->first();
        if($userReg){
            // get role
            $role = Role::where('id', decrypt($request->role))->with('permissions')->first();
            // assign role
            $userReg->assignRole($role);
            // check if user has an account
            $userAccount = UserAccount::where('user_id',$userReg->id)->where('is_admin', true)->first();
            if ($userAccount){
                return back()->withWarning(__('This user already has an account!'));
            }else{
                // add user account
                $newUserAccount = new UserAccount();
                $newUserAccount->is_user = false;
                $newUserAccount->is_admin = true;
                $newUserAccount->is_active = false;
                $newUserAccount->is_institution = false;
                $newUserAccount->user_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
                $newUserAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
                $newUserAccount->user_id = $userReg->id;
                $newUserAccount->registerer_id = $user->id;
                $newUserAccount->save();

                // send email to inform
            }

        }else{

            // create user
            // user account creation
            $userReg = new User();
            $userReg->name = $request->first_name.' '.$request->last_name;
            $userReg->email = $request->email;
            $userReg->phone_number = $request->phone_number;
            $userReg->password = Hash::make('pending');
            $userReg->save();

            // create user account
            $newUserAccount = new UserAccount();
            $newUserAccount->is_user = false;
            $newUserAccount->is_admin = true;
            $newUserAccount->is_active = false;
            $newUserAccount->is_institution = false;
            $newUserAccount->user_type_id = '4be20a9a-aee3-414c-b8ba-dcacf859cc9c';
            $newUserAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
            $newUserAccount->user_id = $userReg->id;
            $newUserAccount->save();
            $userAccount = UserAccount::where('id',$newUserAccount->id)->with('user','institution')->first();

            // send user email
            Mail::to($request->email)->send(new AdminInviteUser($userAccount));
        }

        // get role
        $role = Role::where('id', decrypt($request->role))->with('permissions')->first();

        // role assign permissions based on modules
        $userReg->assignRole($role);

        return back()->withSuccess(__('User has been invited to Nihusubu!'));
    }

    public function userShow($user_id){
        // User
        $user = $this->getUser();
        // get user
        $userExists = User::findOrFail(decrypt($user_id));
        $institutionUser = User::where('id',$userExists->id)->with('adminRoles')->first();
        // get user account
        $userAccount = UserAccount::where('user_type_id','4be20a9a-aee3-414c-b8ba-dcacf859cc9c')->where('is_admin',1)->where('user_id',$userExists->id)->with('registerer')->first();
        // get roles
        $roles = Role::whereNull('institution_id')->get();
        // $pendingRoles = Role::whereNull('institution_id')->whereNotIn('name',$userRoles)->get();
        // get pending roles
        $userRoles = $institutionUser->getAdminRoleNames();
        $pendingRoles = Role::whereNull('institution_id')->whereNotIn('name',$userRoles)->get();

        return view('admin.user_show', compact('user', 'institutionUser', 'userAccount', 'pendingRoles'));
    }

    public function userAddRole(Request $request, $user_id)
    {

        // User
        $user = $this->getUser();
        // get user
        $AddedUser = User::findOrFail(decrypt($user_id));
        // get role
        $role = Role::findOrFail(decrypt($request->role));
        $AddedUser->assignRole($role->id);

        return redirect()->route('admin.user.show',encrypt($AddedUser->id))->withSuccess('User '.$AddedUser->name.' successfully assigned role '.$role->name.'!');
    }

    public function userDelistRole($user_id, $role_id)
    {

        // User
        $user = $this->getUser();
        // revoke user
        $revokedUser = User::findOrFail(decrypt($user_id));
        $role = Role::findOrFail(decrypt($role_id));
        $revokedUser->removeRole($role->id);

        return redirect()->route('admin.user.show', encrypt($revokedUser->id))->withSuccess('User '.$revokedUser->name.' does not have access to '.$role->name.'!');
    }

    public function userDelete($user_account_id)
    {

        $userAccount = UserAccount::findOrFail($user_account_id);
        $userAccount->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $userAccount->save();
        // Users
        $users = UserAccount::where('id',$userAccount->id)->with('user')->get();

        return back()->withSuccess(__('User '.$userAccount->user->name.' successfully deleted.'));
    }

    public function userRestore($user_account_id)
    {

        $userAccount = UserAccount::findOrFail($user_account_id);
        $userAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $userAccount->restore();
        // Users
        $users = UserAccount::where('id',$userAccount->id)->with('user')->get();

        return back()->withSuccess(__('Brand '.$userAccount->user->name.' successfully restored.'));
    }
}
