<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\General;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Churchgiven;
use Illuminate\Http\Request;

class ChurchgivenController extends General
{
   protected $model = Churchgiven::class;
      protected $viewname = 'churchgiven';
    protected $view_custom = 'admin.' ;
    protected $path_custom = 'admin/' ;
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'name' => 'required',
			'description' => 'required',
           'groups_id' => 'required',
           'payment_types_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Churchgiven::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Churchgiven::latest()->paginate($perPage);
        }

        return view('admin.churchgiven.index', compact('data'));
    }



    }
