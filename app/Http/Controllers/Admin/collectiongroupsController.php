<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\collectiongroup;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class collectiongroupsController extends General
{
   protected $model = collectiongroup::class;
      protected $viewname = 'collectiongroups';
    protected $view_custom = 'admin.';
    protected $path_custom = 'admin/';
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
            $data = collectiongroup::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = collectiongroup::latest()->paginate($perPage);
        }

        return view('admin.collectiongroups.index', compact('data'));
    }



    }
