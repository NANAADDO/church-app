<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General;
use App\Role;
use App\Permission as permi;
use Illuminate\Http\Request;

class RolesController extends General
{
    protected $model = Role::class;
    protected $viewname = 'roles';
    protected $view_custom = 'admin.' ;
    protected $path_custom = 'admin/' ;
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [
        'name' => 'required',
        'label' => 'required',
    ];
    protected $imgtostaff ;
    protected $imgtoIDType;
    protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $data = Role::where('name', 'LIKE', "%$keyword%")->orWhere('label', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Role::latest()->paginate($perPage);
        }

        return view('admin.roles.index', compact('data'));
    }


    public function store(Request $request)
    {
        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }

        $role = Role::create($request->all());

        if ($request->has('permissions')) {
            $role->permissions()->detach();
            foreach ($request->permissions as $permissionID) {
                $permission = permi::where('id','=',$permissionID)->first();
                $role->givePermissionTo($permission);
            }
        }
        session()->put('success','Data Created Successful');
        return redirect('admin/roles');
    }





    public function update(Request $request, $id)
    {
        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }

        $role = Role::findOrFail($id);
        $role->update($request->all());

        if ($request->has('permissions')) {
            $role->permissions()->detach();
            foreach ($request->permissions as $permissionID) {
                $permission = permi::where('id', '=', $permissionID)->first();$role->givePermissionTo($permission);
            }
        }
        session()->put('success','Data Updated Successful');
        return redirect('admin/roles');
    }


}
