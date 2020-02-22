<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Textmessage;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class TextmessageController extends General
{
   protected $model = Textmessage::class;
      protected $viewname = 'textmessage';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = ['content' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [
           'title' => 'required|unique:textmessages'
       ];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Textmessage::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Textmessage::latest()->paginate($perPage);
        }

        return view('admin.textmessage.index', compact('data'));
    }



    public function store(Request $request)
    {
        if ($this->checkval($request) == 0) {
            session()->put('error', 'There were validation errors');
            return $this->validateRequestOption($request);
        }

        $data=$request->all();
        $data['branch_id']=$this->getuserspec('branch_id');
        $data['user_id']=$this->getuserid();
        $this->model::create($data);
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
        $data->update($request->all());
        session()->put('success','Data Updated Successful');

        return redirect($this->path_custom.$this->viewname);
    }


}
