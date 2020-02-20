<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Churchgroup;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class ChurchgroupsController extends General
{
   protected $model = Churchgroup::class;
      protected $viewname = 'churchgroups';
    protected $view_custom = 'admin.' ;
    protected $path_custom = 'admin/' ;
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'name' => 'required',
			'description' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Churchgroup::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Churchgroup::latest()->paginate($perPage);
        }
        return view('admin.churchgroups.index', compact('data'));
    }



    }
