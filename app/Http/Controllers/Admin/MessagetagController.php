<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Messagetag;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class MessagetagController extends General
{
   protected $model = Messagetag::class;
      protected $viewname = 'messagetag';
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
            $data = Messagetag::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Messagetag::latest()->paginate($perPage);
        }

        return view('admin.messagetag.index', compact('data'));
    }



    }
