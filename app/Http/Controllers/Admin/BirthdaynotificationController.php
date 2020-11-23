<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Birthdaynotification;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class BirthdaynotificationController extends General
{
   protected $model = Birthdaynotification::class;
      protected $viewname = 'birthdaynotification';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'message_id' => 'required',
			'tag_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {


       $data =  Birthdaynotification::where('branch_id','=',auth()->user()->branch_id)->first();
       if($data){
          return  redirect('admin/birthdaynotification/'.$data->id.'/edit');
       }



        return view($this->path_custom.'.'.$this->viewname.'.'.'index');
    }


    public function update(Request $request, $id)
    {

        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }
        $var = $request->all();
        if($request->state_id !=1){
            $var['state_id']=0;
        }

        $data = $this->model::findOrFail($id);
        $data->update($var);
        session()->put('success','Data Updated Successful');

        return redirect($this->path_custom.$this->viewname);


    }


    }
