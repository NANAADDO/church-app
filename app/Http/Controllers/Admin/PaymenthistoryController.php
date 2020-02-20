<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use App\Models\Welfare;
use App\Traits\GeneralProcessTrait;
use App\Traits\GeneralVariables;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PaymenthistoryController extends General
{
    use  GeneralProcessTrait;
    use GeneralVariables;

    protected $model = payment_history::class;
    protected $viewname = '';
    protected $path_custom = 'admin/' ;
    protected $view_custom = 'admin.';
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [
        ];
    protected $imgtostaff ;
    protected $imgtoIDType;
    protected $validoptional = [];


    public function index(Request $request)
    {

        if (\Request::ajax()) {
            $type = $request->type;
            if($type==3){
                $pdetails = explode('-', $request->p_details);
                $p_id =$pdetails[0];
                $memID = $pdetails[1];
            }
            else {
                $pdetails = explode('_', $request->p_details);
                $year = $pdetails[2];
                $memID = $pdetails[0];
            }

         if($type==3){
             $data = payment_history::where('payment_state', 0)->where('collection_id', $type)->where('member_id', $memID)->where('point_sub_id', $p_id)->latest()->get();

         }
         else {


             $data = payment_history::where('payment_state', 0)->where('collection_id', $type)->where('member_id', $memID)->where('year', $year)->latest()->get();

         }
            //return response()->json($data);
             return view('includes.paymenthistorydata')->with(compact('data'))->render();



        }


    }

}
