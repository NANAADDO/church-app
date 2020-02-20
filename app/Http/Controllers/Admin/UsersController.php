<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permissions;
use App\Helpers\Roles;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General;
use App\Invoke_revoke_permissions;
use App\Role;
use App\Traits\GeneralProcessTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends General
{
    use GeneralProcessTrait;
    protected $model = User::class;
    protected $viewname = 'users';
    protected $view_custom = 'admin.';
    protected $path_custom = 'admin/';
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [
        'first_name' => 'required',
        'surname' => 'required',
        'username' => 'required',
        'other_names' => 'required',
        'phone_number' => 'required',
        'roles' => 'required',
        'branch_id' => 'required'
    ];
    protected $imgtostaff;
    protected $imgtoIDType;
    protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        if (!empty($keyword)) {
            $data = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = User::latest()->paginate($perPage);
        }
        return view('admin.users.index', compact('data'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        if ($this->checkval($request) == 0) {
            session()->put('error', 'There were validation errors');
            return $this->validateRequest($request);
        }

        $data = $request->except('password');
        $data['password'] = $this->encryptpassword('password.123');
        $data['name'] = $request->first_name. ' ' . $request->other_name . ' ' .$request->surname;
        $user = User::create($data);
        $userID = $user->id;
        $user->assignRole($request->roles);

        if ($request->has('invoke')) {
            $this->manage_extra_permissions($request->invoke, 1,$userID);
        }
        if ($request->has('revoke')) {
            $this->manage_extra_permissions($request->revoke, 0,$userID);
        }

        session()->put('success', 'Data Created successfully');
        return redirect('admin/users');
    }

    public function show($id)
    {
        $data = $this->model::with('Userroles')->findOrFail($id);
        $type = 'show';
        $user_p = Permissions::get_all_permissions_for_user($data->id,$data->Userroles->role_id);
        $user_r = Permissions::get_all_permissions_for_user_revoke_invoke($data->id,0);
        $user_i = Permissions::get_all_permissions_for_user_revoke_invoke($data->id,1);
        $user_e = Permissions::get_all_extra_permissions_for_user($data->Userroles->role_id,$data->id);
        return view($this->view_custom.$this->viewname.".".$type)->with(compact('data','user_p','user_r','user_i','user_e'));
    }
    public function edit($id)
    {
        $data = $this->model::with('Userroles')->findOrFail($id);
        $type = 'edit';
        $user_p = Permissions::get_all_permissions_for_user($data->id,$data->Userroles->role_id);
        $user_r = Permissions::get_all_permissions_for_user_revoke_invoke($data->id,0);
        $user_i = Permissions::get_all_permissions_for_user_revoke_invoke($data->id,1);
        $user_e = Permissions::get_all_extra_permissions_for_user($data->Userroles->role_id,$data->id);
        return view($this->view_custom.$this->viewname.".".$type)->with(compact('data','user_p','user_r','user_i','user_e'));


        return view('admin.users.edit', compact('user', 'roles', 'user_roles'));
    }


    public function update(Request $request, $id)
    {

        if ($this->checkval($request) == 0) {
            session()->put('error', 'There were validation errors');
            return $this->validateRequest($request);
        }

        $data['name'] = $request->first_name. ' ' . $request->other_name . ' ' .$request->surname;
        $user = User::findOrFail($id);
        $user->update($data);

        $user->roles()->detach();
            $user->assignRole($request->roles);


        if ($request->has('invoke')) {
            $this->delete_extra_permissions(1,$id);
            $this->manage_extra_permissions($request->invoke, 1,$id);
        }
        if ($request->has('revoke')) {
            $this->delete_extra_permissions(0,$id);
            $this->manage_extra_permissions($request->revoke, 0,$id);
        }

        session()->put('success', 'Data updated successfully');
        return redirect('admin/users');
    }

    public function all_role_permisssions(Request $request)
    {
        $permission = Permissions::get_all_in_permissions($request->id);
        $notperm =   Permissions::get_all_not_permissions($request->id);
        return response()->json(['perm' => $permission, 'extraperm' => $notperm]);
    }

    public function all_extra_permisssions(Request $request)
    {

        $permission = Permissions::get_all_in_permissions_array($request->ids);

        return response()->json(['perm' => $permission]);
    }

public function manage_extra_permissions($perm, $action_type,$userID)
{

    foreach ($perm as $permID) {
        $data['permission_id'] = $permID;
        $data['action_type'] = $action_type;
        $data['user_id'] = $userID;
        Invoke_revoke_permissions::create($data);
    }

}
    public function delete_extra_permissions($action_type,$userID)
{

        Invoke_revoke_permissions::where('user_id','=',$userID)->where('action_type','=',$action_type)->delete();
    }

}
