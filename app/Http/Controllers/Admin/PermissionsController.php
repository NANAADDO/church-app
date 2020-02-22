<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permissions;
use App\Http\Controllers\Controller;

use App\Http\Controllers\General;
use App\Models\Parent_module;
use App\Permission as Apppermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionsController extends General
{
    protected $model = Apppermission::class;
    protected $viewname = 'permission';
    protected $view_custom = 'admin.' ;
    protected $path_custom = 'admin/' ;
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [
        'label' => 'required',
        'group_name' => 'required'];
    protected $imgtostaff ;
    protected $imgtoIDType;
    protected $validoptional = ['path_name' => 'required|unique:parent_module',
        'name' => 'required|unique:parent_module'];



    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $dat= Apppermission::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
            $sql = "select distinct(path_name) , id,name,event_id,parent_id from  (select p.name,p.path_name,pr.id,pr.event_id,pr.parent_id from parent_module p left join permissions pr on  p.id = pr.parent_id where p.name like '%$keyword%') as t group by parent_id order  by parent_id desc ";
            $data = DB::select($sql);

        } else {

            $sql = "select distinct(path_name) , id,name,event_id,parent_id from  (select p.name,p.path_name,pr.id,pr.event_id,pr.parent_id from parent_module p left join permissions pr on  p.id = pr.parent_id) as t group by parent_id order  by parent_id desc";
            $data = DB::select($sql);
            //$data= Apppermission::distinct()->paginate($perPage);
        }
       // dd($data);;

        return view('admin/'.$this->viewname.'.index', compact('data'));
    }

    public function store(Request $request)
    {

        if ($this->checkval($request) == 0) {
            session()->put('error', 'There were validation errors');
            return $this->validateRequestOption($request);
        }
        $data = $request->all();
        $module =  $this->manage_module($request,1,[]);
        $data['parent_id'] = $module->id;

        if (!empty($request->events)) {

        foreach ($request->events as $key => $value) {
    $this->manage_permissions($request,$value,1,[], $module->id);

        }
    }
        session()->put('success','Data Created Successful');
        return redirect($this->path_custom.$this->viewname);
    }




    public function update(Request $request, $id)
    {
        if($this->checkvalsingle($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }
        $data = $this->model::findOrFail($id);
        $parent = Parent_module::findorfail($data->parent_id);

        $this->manage_module($request,2,$parent);
        $new = array_diff_assoc($request->events,Permissions::get_all_actions($data->parent_id));
        $notexistanddelete = array_diff_assoc(Permissions::get_all_actions($data->parent_id),$request->events);
        //dd($notexistanddelete);

        if(!empty($notexistanddelete)) {
            $this->manage_permissions($request, null, 2, $notexistanddelete, $data->parent_id);

        }
        if(!empty($new)) {

            foreach ($new as $key => $value) {
                $this->manage_permissions($request,$value,1,[], $data->parent_id);
            }

            }


        session()->put('success','Data Updated Successful');

        return redirect($this->path_custom.$this->viewname);
    }




    public function manage_module($request,$event,$updated){


        $data['name'] = $request->name;
        $data['group_type_id'] = $request->group_name;
        $data['path_name'] = strtolower($request->path_name);
        $data['aliases'] = $request->label;

        if($event==1) {
            $module = Parent_module::create($data);
        }
        else{
            $module = $updated->update($data);
        }

        return $module;

    }


    public function manage_permissions($request,$value,$event,$array,$pid){




        if($event==1) {
            $data['parent_id'] = $pid;
            $data['event_id'] = $value;
            $data['name'] = $request->name;
            $resp = Apppermission::create($data);
        }
        else{

            $resp = Apppermission::whereIn('event_id',$array)->where('parent_id','=',$pid)->delete();
        }

        return $resp;

    }


}
