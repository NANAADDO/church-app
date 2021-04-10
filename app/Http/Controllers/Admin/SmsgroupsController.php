<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Memberdetail;
use App\Models\Smsgroup;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class SmsgroupsController extends General
{
   protected $model = Smsgroup::class;
      protected $viewname = 'smsgroups';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'name' => 'required'];
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

        return view('admin.smsgroups.index', compact('data'));
    }

    public function create()
    {
        $contact = Memberdetail::select('surname','other_names','phone_numbers','id')->paginate(3);

        $type = 'create';

        return view($this->view_custom.$this->viewname.".".$type)->with(compact('contact'));
    }


    }
