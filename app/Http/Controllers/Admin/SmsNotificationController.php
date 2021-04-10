<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SmsNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class SmsNotificationController extends General
{
   protected $model = SmsNotification::class;
      protected $viewname = 'smsnotification';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'quantity' => 'required',
			'notification_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $data =  SmsNotification::where('branch_id','=',auth()->user()->branch_id)->first();
        if($data){
            return  redirect('admin/smsnotification/'.$data->id.'/edit');
        }
        return view('admin.smsnotification.index');
    }

    public function update(Request $request, $id)
    {

        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }
        $var = $request->all();
        if($request->notification_state !=1){
            $var['notification_state']=0;
        }

        $data = $this->model::findOrFail($id);
        $data->update($var);
        session()->put('success','Data Updated Successful');

        return redirect($this->path_custom.$this->viewname);


    }


    }
