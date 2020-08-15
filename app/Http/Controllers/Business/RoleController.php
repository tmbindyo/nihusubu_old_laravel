<?php

namespace App\Http\Controllers\Business;

use App\Address;
use App\Currency;
use App\Institution;
use App\Mail\BusinessInviteUser;
use App\Module;
use App\Plan;
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

    public function roleCreate($portal)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);

        return view('business.role_create', compact( 'user', 'institution'));
    }

    public function roleShow($portal, $role_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // get role
        $role = Role::where('id', decrypt($role_id))->where('institution_id', $institution->id)->with('permissions')->first();
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
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // role name
        $roleName = $institution->portal.' '.$request->name;
        // check if role exists
        $roleNameExists = Role::where('name',$roleName)->first();
        if ($roleNameExists){
            return back()->withWarning('Role '.$request->name.' exists!');
        }
        // Create role
        $role = Role::create(['name' => $roleName, 'institution_id' => $institution->id]);

        $active = 'roles';
        return redirect()->route('business.settings',$institution->portal)->withSuccess(__('Role '.str_replace($institution->portal.' ', "", $role->name).' successfully created!'))->with( ['active' => $active] );
    }

    public function roleUpdate(Request $request, $portal, $role_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // role name
        $roleName = $institution->portal.' '.$request->name;
        // check if role exists
        $roleNameExists = Role::where('name',$roleName)->first();
        if ($roleNameExists){
            return back()->withWarning('Role '.$request->name.' exists!');
        }else{
            // update role
            $role = Role::where('id',$role_id)->first();
            $role->name = $roleName;
            $role->save();
        }

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>$role->id])->withSuccess('Role '.str_replace($institution->portal.' ', "", $role->name).' successfully created!');
    }

    public function userRevokeRole($portal, $user_id, $role_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // revoke user
        $revokedUser = User::findOrFail(decrypt($user_id));
        $role = Role::findOrFail(decrypt($role_id));
        $revokedUser->removeRole($role->id);

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>encrypt($role->id)])->withSuccess('User '.$revokedUser->name.' successfully revoked!');
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

        return redirect()->route('business.role.show',['portal'=>$institution->portal, 'id'=>$role_id])->withSuccess('User '.$AddedUser->name.' successfully assigned role '.str_replace($institution->portal.' ', "", $role->name).'!');
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
        $users = UserAccount::where('institution_id',$institution->id)->with('user', 'roles')->get();
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

        // get role
        $role = Role::where('id', decrypt($request->role))->where('institution_id', $institution->id)->with('permissions')->first();

        // role assign permissions based on modules
        $user->assignRole($role);

        return back()->withSuccess(__('User has been invited to your organization!'));
    }

    public function userShow($portal, $user_id){
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // get user
        $userExists = User::findOrFail(decrypt($user_id));
        $institutionUser = User::where('id',$userExists->id)->with('roles')->first();
        // get user account
        $userAccount = UserAccount::where('institution_id',$institution->id)->where('user_type_id','07c99d10-8e09-4861-83df-fdd3700d7e48')->where('is_institution',1)->where('user_id',$userExists->id)->with('registerer')->first();
        // get pending roles
        $userRoles = $institutionUser->getRoleNames();
        $pendingRoles = Role::where('institution_id',$institution->id)->whereNotIn('name',$userRoles)->get();

        return view('business.user_show', compact('user', 'institution', 'institutionUser', 'userAccount', 'pendingRoles'));
    }

    public function userAddRole(Request $request, $portal, $user_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // get user
        $AddedUser = User::findOrFail(decrypt($user_id));
        // get role
        $role = Role::findOrFail(decrypt($request->role));
        $AddedUser->assignRole($role->id);

        return redirect()->route('business.user.show',['portal'=>$institution->portal, 'id'=>encrypt($AddedUser->id)])->withSuccess('User '.$AddedUser->name.' successfully assigned role '.str_replace($institution->portal.' ', "", $role->name).'!');
    }

    public function userDelistRole($portal, $user_id, $role_id)
    {

        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // revoke user
        $revokedUser = User::findOrFail(decrypt($user_id));
        $role = Role::findOrFail(decrypt($role_id));
        $revokedUser->removeRole($role->id);

        return redirect()->route('business.user.show',['portal'=>$institution->portal, 'id'=>encrypt($revokedUser->id)])->withSuccess('User '.$revokedUser->name.' does not have access to '.str_replace($institution->portal.' ', "", $role->name).'!');
    }

    public function userDelete($portal, $user_account_id)
    {

        $userAccount = UserAccount::findOrFail($user_account_id);
        $userAccount->status_id = "d35b4cee-5594-4cfd-ad85-e489c9dcdeff";
        $userAccount->save();
        // Users
        $users = UserAccount::where('id',$userAccount->id)->with('user')->get();

        return back()->withSuccess(__('User '.$userAccount->user->name.' successfully deleted.'));
    }

    public function userRestore($portal, $user_account_id)
    {

        $userAccount = UserAccount::findOrFail($user_account_id);
        $userAccount->status_id = "c670f7a2-b6d1-4669-8ab5-9c764a1e403e";
        $userAccount->restore();
        // Users
        $users = UserAccount::where('id',$userAccount->id)->with('user')->get();

        return back()->withSuccess(__('Brand '.$userAccount->user->name.' successfully restored.'));
    }


    public function institutionShow($portal)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // plans
        $plans = Plan::get();
        // currency
        $currencies = Currency::get();

        return view('business.institution_show', compact('user', 'institution', 'plans', 'currencies'));
    }

    public function institutionUpdate(Request $request, $portal, $role_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);

        // update institution
        $institutionUpdate = Institution::findOrFail($institution->id);
        $institutionUpdate->name = $request->name;
        $institutionUpdate->portal = $request->portal;
        $institutionUpdate->email = $request->email;
        $institutionUpdate->phone_number = $request->phone_number;
        $institutionUpdate->user_id = $user->id;
        $institutionUpdate->plan_id = $request->plan;
        $institutionUpdate->currency_id = $request->currency;
        $institutionUpdate->user_id = $user->id;
        $institutionUpdate->save();

        // address update
        $address = Address::where('id',$institution->address_id)->first();
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->postal_code = $request->postal_code;
        $address->po_box = $request->po_box;
        $address->town = $request->city;
        $address->street = $request->street;
        $address->user_id = $user->id;
        $address->save();

        $active = 'institution';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Role '.$institution->name.' successfully updated!')->with( ['active' => $active] );
    }

    public function moduleSubscribe($portal, $module_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // check if module exists
        $module = Module::findOrFail($module_id);
        // get module institution module record
        $institutionModule = InstitutionModule::where('institution_id',$institution->id)->where('module_id',$module->id)->first();
        if (is_null($institutionModule)){
            // create new record
            $institutionModule = new InstitutionModule();

            $institutionModule->module_id = $module->id;
            $institutionModule->institution_id = $institution->id;

            $institutionModule->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
            $institutionModule->user_id = $user->id;
            $institutionModule->save();
        }
        // remove module permissions from institution roles
        $institutionRoles = Role::where('institution_id',$institution->id)->get();
        // get module permissions
        $permissions = Permission::where('module_id',$module->id)->get();
        // get all roles
        foreach ($institutionRoles as $role){
            foreach ($permissions as $permission){
                $role->givePermissionTo($permission);
            }
        }

        $active = 'modules';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Role '.$module->name.' successfully subscribed!')->with( ['active' => $active] );
    }

    public function moduleUnsubscribe($portal, $module_id)
    {
        // User
        $user = $this->getUser();
        // Get the navbar values
        $institution = $this->getInstitution($portal);
        // check if module exists
        $module = Module::findOrFail($module_id);
        // get module institution module record
        $institutionModule = InstitutionModule::where('institution_id',$institution->id)->where('module_id',$module->id)->first();
        // remove module permissions from institution roles
        $institutionRoles = Role::where('institution_id',$institution->id)->get();
        // get module permissions
        $permissions = Permission::where('module_id',$module->id)->get();
        // get all roles
        foreach ($institutionRoles as $role){
            foreach ($permissions as $permission){
                $role->revokePermissionTo($permission);
            }
        }
        $institutionModuleDelete = InstitutionModule::where('id',$institutionModule->id)->forceDelete();

        $active = 'modules';
        return redirect()->route('business.settings',$institution->portal)->withSuccess('Role '.$module->name.' successfully unsubscribed!')->with( ['active' => $active] );
    }



}
