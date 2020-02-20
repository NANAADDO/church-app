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
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Birthdaynotification::where('message_id', 'LIKE', "%$keyword%")
                ->orWhere('tag_id', 'LIKE', "%$keyword%")
                ->orWhere('state_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Birthdaynotification::latest()->paginate($perPage);
        }

        return view('admin.birthdaynotification.index', compact('data'));
    }



    }
