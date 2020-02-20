<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use App\Models\Rollbackpayment;
use App\Traits\GeneralProcessTrait;
use App\Traits\GeneralVariables;
use App\Traits\PaymentHistoryTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class RollbackpaymentController extends General
{
    use GeneralProcessTrait;
    use PaymentHistoryTrait;
   protected $model = payment_history::class;
      protected $viewname = 'rollbackpayment';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'password' => 'required',
			'password_confirmation' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;


        if(\Request::ajax()) {


            $data = payment_history::where('receipt_id',$keyword)->first();
            if(!empty($data)) {
                $related = payment_history::WhereNotIn('id', [$data->id])->where('collection_id', $data->collection_id)
                    ->where('year', $data->year)->where('member_id', $data->member_id)
                    ->where('created_at', '>=', $data->created_at)
                    ->where('created_at', '<=', $this->addsecondstotimestamp($data->created_at, 30))->get();
            }
            else{
                $related = [];
            }
            $item = $data;
            return view($this->view_custom.$this->viewname.".".'searchmember')->with(compact('related','data','item'))->render();


        }

        if (!empty($keyword)) {

            $data = payment_history::where('receipt_id', $keyword)->paginate($perPage);

        } else {
            $data =payment_history::where('receipt_id', '04223')->paginate($perPage);;
        }

        return view('admin.rollbackpayment.index', compact('data'));


    }

    public function store(Request $request)
    {

         $allm = $this->implodearray($request->m_selected);

                foreach($this->explodearray(',',$allm) as $id) {
                  $phreversal =  payment_history::find($id);
                  $data['payment_state']=1;
                    $data['comment']=$request->comment;
                    $data['reversed_by']=$this->getuserid();
                  $phreversal->update($data);
                }
                $resp='<p class="text-center text-success"><b>Payment Reversal successful!!!.</b></p>';
        return response()->json(['data'=>$resp]);
    }

    }
