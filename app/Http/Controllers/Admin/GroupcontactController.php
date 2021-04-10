<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Groupcontact;
use App\Models\Memberdetail;
use App\Models\Smsgroup;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class GroupcontactController extends General
{
   protected $model = Groupcontact::class;
      protected $viewname = 'groupcontact';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'country_id' => 'required',
			'region_id' => 'required',
			'location' => 'required',
			'address' => 'required',
			'phone_numbers' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Smsgroup::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Smsgroup::latest()->paginate($perPage);
        }

        return view('admin.groupcontact.index', compact('data'));
    }


    public function show($id)
    {
        $contact = Memberdetail::select('surname','other_names','phone_numbers','id','new_member_id as member_id')->paginate(5);
        $data = Smsgroup::findOrFail($id);
        $type = 'show';
        if(\Request::ajax()) {

            $mian= 'true';
            return view($this->view_custom.$this->viewname.".".$type)->with(compact('data','mian'))->render();

        }
        return view($this->view_custom.$this->viewname.".".$type)->with(compact('data','contact'));
    }
    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $type = 'edit';
        return $this->displayview($data,$type);


    }


    }
