<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class BranchController extends General
{
   protected $model = Branch::class;
      protected $viewname = 'branch';
    protected $view_custom = 'admin.';
    protected $path_custom = 'admin/';
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
           'branch_code' => 'required',
           'branch_size' => 'required',
			'phone_numbers' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Branch::where('name', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->orWhere('region_id', 'LIKE', "%$keyword%")
                ->orWhere('country_id', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('phone_numbers', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Branch::latest()->paginate($perPage);
        }

        return view('admin.branch.index', compact('data'));
    }



    }
