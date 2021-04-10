<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralVariables;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Birthdaynotification;
use App\Models\Memberdetail;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

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

$data = Memberdetail::where(DB::raw('MONTH(date_of_birth)'),GeneralVariables::currentDateMonth())->paginate(50);

        return view($this->path_custom.'.'.$this->viewname.'.'.'index')->with(compact('data'));
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
