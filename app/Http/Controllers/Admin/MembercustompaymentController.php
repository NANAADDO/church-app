<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Membercustompayment;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class MembercustompaymentController extends General
{
   protected $model = Membercustompayment::class;
      protected $viewname = 'membercustompayment';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'amount' => 'required',
			'year' => 'required',
			'collection_id' => 'required',
			'member_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Membercustompayment::where('amount', 'LIKE', "%$keyword%")
                ->orWhere('year', 'LIKE', "%$keyword%")
                ->orWhere('amount_paid', 'LIKE', "%$keyword%")
                ->orWhere('collection_id', 'LIKE', "%$keyword%")
                ->orWhere('member_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Membercustompayment::latest()->paginate($perPage);
        }

        return view('admin.membercustompayment.index', compact('data'));
    }



    }
