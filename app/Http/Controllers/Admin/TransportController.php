<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Member;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Transport;
use App\Traits\GeneralProcessTrait;
use App\Traits\GeneralVariables;
use Illuminate\Http\Request;
use App\Http\Controllers\General;

class TransportController extends General

{

    use GeneralProcessTrait;
   protected $model = Transport::class;
      protected $viewname = 'transport';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'amount' => 'required',
			'funeral_date' => 'required',
			'member_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data = Transport::where('amount', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('funeral_date', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data = Transport::latest()->paginate($perPage);
        }

        return view('admin.transport.index', compact('data'));
    }



    public function store(Request $request)
    {
        if($this->checkval($request)==0) {
            session()->put('error','There were validation errors');
            return $this->validateRequest($request);
        }
        $total = Member::get_total_member()  - 1;
         $data = $request->all();
        $data['expected_people']=$total;
        $data['expected_amount']=$total * $request->amount;
        $data['date']= $this->currentdate();
         $data['user_id']=$this->getuserid();
        $this->model::create($data);
        session()->put('success','Data Created Successful');
        return redirect($this->path_custom.$this->viewname);
    }



    }
