<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Paymentplantype;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class PaymentplantypesController extends General
{
   protected $model = Paymentplantype::class;
      protected $viewname = 'paymentplantypes';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
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
            $data = Paymentplantype::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Paymentplantype::latest()->paginate($perPage);
        }

        return view('admin.paymentplantypes.index', compact('data'));
    }



    }
